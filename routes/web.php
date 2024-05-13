<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');


Route::get('home', [ProductController::class, 'index'])->name('filterProducts');
Route::get('home', [ProductController::class, 'toproductedit'])->name('product.edit');
Route::get('product', [ProductController::class, 'productedit'])->name('conflim.edit.product');

Route::get('/', function () {
    return view('auth.login');
});
