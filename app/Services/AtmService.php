<?php
namespace App\Services;

use App\Models\BankNoteLog;

class AtmService{




    public function atmWithdraw($amount, $banknotes)
    {
        $withdraw=$amount;
        usort($banknotes, function ($a, $b) {
            return $b['banknote'] - $a['banknote'];
        });

        if ($amount <= 0) {


            BankNoteLog::create([
                'user_name'=>auth('api')->user()->name,
                'email'=>auth('api')->user()->email,
                'amount'=>$withdraw,
                'status'=>BankNoteLog::STATUS_FAILED,
                'additional_data'=>'',
            ]);

            return response()->json([
                'message'=>"Invalid Amount"
            ]);




        }

        if ($amount > array_sum(array_map(function ($banknote) {
                return $banknote['count'] * $banknote['banknote'];
            }, $banknotes))) {

            BankNoteLog::create([
                'user_name'=>auth('api')->user()->name,
                'email'=>auth('api')->user()->email,
                'amount'=>$withdraw,
                'status'=>BankNoteLog::STATUS_FAILED,
                'additional_data'=>'',
            ]);

            return response()->json([
                'message'=>"Please try a lower amount!"
            ]);
        }

        $withdrawnNotes = [];
        foreach ($banknotes as $note) {
            $count = min($note['count'], intdiv($amount, $note['banknote']));
            if ($count > 0) {
                $withdrawnNotes[] = [
                    'count' => $count,
                    'banknote' => $note['banknote'],
                    'id'=>$note['id']
                ];
                $amount -= $count * $note['banknote'];
            }
        }

        if ($amount == 0) {

            $this->atmRemoveBankAccount($withdraw);
            $this->removeWithdrawFromAtm($withdrawnNotes);

            BankNoteLog::create([
                'user_name'=>auth('api')->user()->name,
                'email'=>auth('api')->user()->email,
                'amount'=>$withdraw,
                'status'=>BankNoteLog::STATUS_SUCCESS,
                'additional_data'=>json_encode($withdrawnNotes),
            ]);

            return response()->json([
                'success'=>'ok',
                "money"=>$withdraw,
                "data"=>$withdrawnNotes,
            ]);
        } else {
            echo "The pull operation failed. Please try a lower amount.";
        }
    }


}
