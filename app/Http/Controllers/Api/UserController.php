<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\BankNote;
use App\Models\BankNoteLog;
use App\Models\User;
use App\Services\AtmService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected  $atmservice;


    public function __construct()
    {
        $this->atmservice=new AtmService();
    }



    public function index(){
        return new UserResource(auth('api')->user());
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

        return $this->atmservice->atmWithdraw($request->money, $banknotes->toArray());





    }


}
