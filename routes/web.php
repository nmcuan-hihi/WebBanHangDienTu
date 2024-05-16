<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');

Route::get('addcategory', [CategoryController::class, 'toAddCategory'])->name('addcategory');
Route::post('addcategory', [CategoryController::class, 'addCategory'])->name('category.add');

Route::get('/category/edit/{category}', [CategoryController::class, 'editCategory'])->name('edit.category');
Route::post('/category/update/{category}', [CategoryController::class, 'updateCategory'])->name('update.category');
Route::get('/', function () {
    return view('auth.login');
});
