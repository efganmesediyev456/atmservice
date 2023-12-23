<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuthLogin;
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
        return view('admin.admin_login');
    }

    public function adminlogout(){
        Auth::logout();
        Auth::guard('admin')->logout();
        return redirect(url('admin'));
    }


    public function adminLogin(AdminAuthLogin $request)
    {

        try {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = ['secret'   => config('app.RECAPTCHA_SECRET'),
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
