<?php

use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');
Route::get('register', [CustomAuthController::class, 'toRegister'])->name('register');
Route::post('register', [CustomAuthController::class, 'createUser'])->name('user.createUser');
Route::get('/', function () {
    return view('auth.login');
});
