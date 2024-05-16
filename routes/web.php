<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

Route::get('tocken', [CustomAuthController::class, 'tochecktocken'])->name('token');
=======
use App\Http\Controllers\ForgotController;

>>>>>>> origin/28-Thu-Quen_MK

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');

Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');

Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
<<<<<<< HEAD
Route::post('manager', [CustomAuthController::class, 'gomanager'])->name('manager');


Route::get('home', [ProductController::class, 'index'])->name('filterProducts');
Route::get('product', [ProductController::class, 'toproductedit'])->name('product.edit');
Route::post('product', [ProductController::class, 'productedit'])->name('conflim.edit.product');

// cart
Route::post('cart', [CartController::class, 'addToCart'])->name('cart');
Route::get('cart', [CartController::class, 'tocart'])->name('add.cart');
Route::post('removecart', [CartController::class, 'removetocart'])->name('remove.cart');
=======
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');


Route::get('/pasword/forgot', [ForgotController::class, 'showForgotForm'])->name('forgot.password.form');
Route::post('/pasword/forgot', [ForgotController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('/pasword/reset/{token}', [ForgotController::class, 'resetPassword'])->name('reset.password.form');
Route::post('/pasword/reset/', [ForgotController::class, 'resetPasswordPost'])->name('reset.password.post');

>>>>>>> origin/28-Thu-Quen_MK


Route::get('/', function () {
    return view('auth.login');
});
