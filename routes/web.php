<?php

use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotController;


Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');


Route::get('/pasword/forgot', [ForgotController::class, 'showForgotForm'])->name('forgot.password.form');
Route::post('/pasword/forgot', [ForgotController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('/pasword/reset/{token}', [ForgotController::class, 'resetPassword'])->name('reset.password.form');
Route::post('/pasword/reset/', [ForgotController::class, 'resetPasswordPost'])->name('reset.password.post');



Route::get('/', function () {
    return view('auth.login');
});
