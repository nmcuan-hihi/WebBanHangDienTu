<?php

use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');
Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');
Route::get('addcategory', [CustomAuthController::class, 'toAddCategory'])->name('addcategory');
Route::post('addcategory', [CustomAuthController::class, 'addCategory'])->name('category.add');
Route::get('editcategory/{id}', [CustomAuthController::class, 'toEditCategory'])->name('category.edit');
Route::post('editcategory/{id}', [CustomAuthController::class, 'editCategory'])->name('category.edit.post');


//Route::delete('categories/{id}', [CustomAuthController::class, 'deleteCategory'])->name('category.delete');
Route::post('deleteCategory',[CustomAuthController::class, 'deleteCategorys'] )->name('deleteCategory');
Route::get('/', function () {
    return view('auth.login');
});
