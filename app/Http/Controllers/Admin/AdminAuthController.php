<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->only('showAdminLoginForm');
    }
    public function showAdminLoginForm()
    {
        return view('admin.admin_login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminlogout(){
        Auth::logout();
        Auth::guard('admin')->logout();

        return redirect(url('admin'));
    }


    public function adminLogin(Request $request)
    {



        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
            'token'=>'required'
        ]);



        try {

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = ['secret'   => env('RECAPTCHA_SECRET'),
                'response' => $request->token,
                'remoteip' => $_SERVER['REMOTE_ADDR']];

            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                ]
            ];

            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);


        }
        catch (Exception $e) {
            return null;
        }

        if(!json_decode($result)->success){
            return response()->json([
                'email'=>'Recaptcha Error'
            ], 422);
        }




        if (\Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            return 'ok';
        }

        return response()->json([
            'email'=>'Authentication Failed'
        ], 422);
    }



    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
