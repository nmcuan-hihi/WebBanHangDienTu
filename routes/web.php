<?php

use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\CartController;
Route::get('addmanufacturers', [ManufacturersController::class, 'showAddForm'])->name('add.manufacturer');
Route::post('addmanufacturers', [ManufacturersController::class, 'store'])->name('store.manufacturer');

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');

Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');

Route::get('home', [ProductController::class, 'index'])->name('home');

Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');

Route::get('addproduct', [ProductController::class, 'showAddForm'])->name('addproduct');
Route::post('addproduct', [ProductController::class, 'store'])->name('store.product');
Route::get('product/image/{id}', [ProductController::class, 'getProductImage'])->name('get.product.image');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');



Route::post('cart', [CartController::class, 'addToCart'])->name('cart');
Route::get('cart', [CartController::class, 'index'])->name('add.cart');
Route::post('cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');


Route::get('/', function () {
    return redirect()->route('login');
});
