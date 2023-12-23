<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserLoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UserLoginController::class,'login']);

Route::group(['prefix'=>'user', 'middleware'=>'auth:api'], function (){
    Route::post('logout', [UserLoginController::class,'logout']);
    Route::get('/', [UserController::class,'index']);
    Route::post('/withdraw', [UserController::class,'withdraw']);
});
