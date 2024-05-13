<?php

use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');
Route::get('manageruser', [CustomAuthController::class, 'listuser'])->name('manageruser');
Route::get('deleteuser', [CustomAuthController::class, 'deleteUser'])->name('user.delete');
Route::get('/', function () {
    return view('auth.login');
});
