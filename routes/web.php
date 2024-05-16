<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomAuthController;
<<<<<<< HEAD
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
=======
use App\Http\Controllers\UserController;

>>>>>>> origin/26-Thu-Danh_Sach_User
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

Route::get('tocken', [CustomAuthController::class, 'tochecktocken'])->name('token');
use App\Http\Controllers\ForgotController;


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


Route::get('/pasword/forgot', [ForgotController::class, 'showForgotForm'])->name('forgot.password.form');
Route::post('/pasword/forgot', [ForgotController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('/pasword/reset/{token}', [ForgotController::class, 'resetPassword'])->name('reset.password.form');
Route::post('/pasword/reset/', [ForgotController::class, 'resetPasswordPost'])->name('reset.password.post');


=======
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');

Route::get('manageruser', [UserController::class, 'listuser'])->name('manageruser');
Route::get('itemuser', [UserController::class, 'showinfouser'])->name('user.showitem');
Route::get('edituser', [UserController::class, 'editUser'])->name('user.edit');
Route::post('edituser', [UserController::class, 'cfeditUser'])->name('user.update');
Route::get('deleteuser', [UserController::class, 'deleteUser'])->name('user.delete');
>>>>>>> origin/26-Thu-Danh_Sach_User

Route::get('/', function () {
    return view('auth.login');
});
