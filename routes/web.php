<?php

use Illuminate\Support\Facades\Route;

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





Route::get('/admin/dashboard',[\App\Http\Controllers\Admin\AdminDashboardController::class,'home']);
Route::resource('/admin/banknotes',\App\Http\Controllers\Admin\AdminBanknotesController::class);
Route::resource('/admin/users',\App\Http\Controllers\Admin\AdminUsersController::class);
Route::resource('/admin/logs',\App\Http\Controllers\Admin\AdminBankNoteLogsController::class);




Route::get('/admin/login',[\App\Http\Controllers\Admin\AdminAuthController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin/login',[\App\Http\Controllers\Admin\AdminAuthController::class,'adminLogin'])->name('admin.login');
Route::post('/admin/logout',[\App\Http\Controllers\Admin\AdminAuthController::class,'logout'])->name('admin.logout');


