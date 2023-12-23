<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function login(UserLoginRequest $request){
        if(!Auth::attempt($request->all())){
            return response()->json(['message'=>'Invalid login credentials']);
        }
        $accesToken=Auth::user()->createToken('authToken')->accessToken;

        return response()->json([
            'user'=>Auth::user(),
            'access_token'=>$accesToken
        ]);
    }


    public function logout(Request  $request){
        auth('api')->user()->token()->revoke();
        return response()->json([
           'message'=>'Logged out successfully!'
        ]);
    }
}
