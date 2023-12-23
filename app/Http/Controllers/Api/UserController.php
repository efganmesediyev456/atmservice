<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserMoneyWithDraw;
use App\Http\Resources\AtmWithdrawResource;
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

    public function user(){
        return new UserResource(auth('api')->user());
    }

    public function withdraw(UserMoneyWithDraw $money){

        $money=$money->get('money');

        $banknotes=BankNote::all();

        $banknotes->transform(function ($item){
            return [
                'count'=>$item->count,
                'banknote'=>$item->price,
                'id'=>$item->id
            ];
        });
        $response=$this->atmservice->atmWithdraw($money, $banknotes->toArray());

        if($response['success']){
            $response=$response['withdrawnNotes'];
            $response=array_map( function ($item){
                return [
                    'count'=>$item['count'],
                    'banknote'=>$item['banknote'],
                    'title'=>BankNote::find($item['id'])->title,
                ] ;
            }, $response);

            return AtmWithdrawResource::make([
                'success'=>true,
                'money'=>$money,
                'data'=>$response
            ]);
        }

        return $response;
    }
}
