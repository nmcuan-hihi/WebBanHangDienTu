<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');

Route::get('manageruser', [UserController::class, 'listuser'])->name('manageruser');
Route::get('itemuser', [UserController::class, 'showinfouser'])->name('user.showitem');
Route::get('edituser', [UserController::class, 'editUser'])->name('user.edit');
Route::post('edituser', [UserController::class, 'cfeditUser'])->name('user.update');
Route::get('deleteuser', [UserController::class, 'deleteUser'])->name('user.delete');

Route::get('/', function () {
    return view('auth.login');
});
