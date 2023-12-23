<?php
namespace App\Services;

use App\Models\BankNote;
use App\Models\BankNoteLog;
use App\Models\User;

class AtmService{



    public function atmWithdraw($amount, $banknotes)
    {
        $withdraw=$amount;
        usort($banknotes, function ($a, $b) {
            return $b['banknote'] - $a['banknote'];
        });

        if ($amount <= 0) {
            $this->statusFailed($withdraw);
            return [
                'success'=>false,
                'message'=>"Invalid Amount",
            ];
        }

        if ($amount > array_sum(array_map(function ($banknote) {
                return $banknote['count'] * $banknote['banknote'];
            }, $banknotes))) {

            $this->statusFailed($withdraw);

            return response()->json([
                'success'=>false,
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
            $this->statusSuccess($withdraw, $withdrawnNotes);
            return [
                'success'=>true,
                'withdrawnNotes'=>$withdrawnNotes
            ];
        } else {
            return [
                'success'=>false,
                'message'=>"The pull operation failed. Please try a lower amount."
            ];
        }
    }



    public function atmRemoveBankAccount($withdraw){
        $user=User::find(auth('api')->user()->id);
        $user->balance-=$withdraw;
        $user->save();
    }



    public function removeWithdrawFromAtm($banknotes){
        foreach ($banknotes as $val){
            $banknote=BankNote::find($val['id']);
            $banknote->count=$banknote->count-$val['count'];
            $banknote->save();
        }
    }


    public function statusFailed($withdraw){
        BankNoteLog::create([
            'user_name'=>auth('api')->user()->name,
            'email'=>auth('api')->user()->email,
            'amount'=>$withdraw,
            'status'=>BankNoteLog::STATUS_FAILED,
            'additional_data'=>'',
        ]);
    }

    public function statusSuccess($withdraw, $withdrawnNotes){
        BankNoteLog::create([
            'user_name'=>auth('api')->user()->name,
            'email'=>auth('api')->user()->email,
            'amount'=>$withdraw,
            'status'=>BankNoteLog::STATUS_SUCCESS,
            'additional_data'=>json_encode($withdrawnNotes),
        ]);
    }
}
