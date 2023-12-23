<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\BankNote;
use App\Models\BankNoteLog;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function atmRemoveBankAccount($withdraw){
        $user=User::find(auth('api')->user()->id);
        $user->balance-=$withdraw;
        $user->save();

    }

    public function index(){
        return new UserResource(auth('api')->user());
    }

    public function removeWithdrawFromAtm($banknotes){
       foreach ($banknotes as $val){

           $banknote=BankNote::find($val['id']);
           $banknote->count=$banknote->count-$val['count'];
           $banknote->save();
       }
    }


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






    public function withdraw(Request $request){
        $request->validate([
           'money'=>'required'
        ]);
        $money=$request->money;



        if(auth('api')->user()->balance<$money){
            return response()->json([
                'message'=>'there is not enough money in the account'
            ], 422);
        }

        $banknotes=BankNote::all();

        $banknotes->transform(function ($i){
            return [
                'count'=>$i->count,
                'banknote'=>$i->price,
                'id'=>$i->id
            ];
        });

        return $this->atmWithdraw($request->money, $banknotes->toArray());




    }


}
