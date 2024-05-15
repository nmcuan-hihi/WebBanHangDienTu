<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');


Route::get('home', [ProductController::class, 'index'])->name('filterProducts');
Route::get('product', [ProductController::class, 'toproductedit'])->name('product.edit');
Route::post('product', [ProductController::class, 'productedit'])->name('conflim.edit.product');

// cart
Route::post('cart', [CartController::class, 'addToCart'])->name('cart');
Route::get('cart', [CartController::class, 'tocart'])->name('add.cart');
Route::post('removecart', [CartController::class, 'removetocart'])->name('remove.cart');


// comment
Route::get('comment', [CommentController::class, 'toviewcomment'])->name('view.comment');

Route::get('/', function () {
    return view('auth.login');
});
