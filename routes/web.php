<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminDashboardController;
use \App\Http\Controllers\Admin\AdminBanknotesController;
use \App\Http\Controllers\Admin\AdminUsersController;
use \App\Http\Controllers\Admin\AdminBankNoteLogsController;
use \App\Http\Controllers\Admin\AdminAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(['prefix'=>'admin','middleware'=>'auth:admin'], function (){
    Route::get('/dashboard',[AdminDashboardController::class,'home']);
    Route::resource('/banknotes',AdminBanknotesController::class);
    Route::resource('/users',AdminUsersController::class);
    Route::resource('/logs',AdminBankNoteLogsController::class);
    Route::post('/logout',[AdminAuthController::class,'logout'])->name('admin.logout');
});


Route::group(['prefix'=>'admin'], function (){
    Route::get('/login',[AdminAuthController::class,'showAdminLoginForm'])->name('admin.login-view');
    Route::post('/login',[AdminAuthController::class,'adminLogin'])->name('admin.login');
});



