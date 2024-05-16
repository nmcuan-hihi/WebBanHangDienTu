<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

Route::get('tocken', [CustomAuthController::class, 'tochecktocken'])->name('token');
use App\Http\Controllers\ForgotController;

use App\Http\Controllers\ManufacturersController;

use App\Http\Controllers\InvoiceController;

//Route::post('/send-invoice', [InvoiceController::class, 'sendInvoice'])->name('send.invoice');

Route::get('addmanufacturers', [ManufacturersController::class, 'showAddForm'])->name('add.manufacturer');
Route::post('addmanufacturers', [ManufacturersController::class, 'store'])->name('store.manufacturer');
Route::get('/edit/manufacturer/{manufacturer_id}', [ManufacturersController::class, 'edit'])->name('edit.manufacturer');
Route::put('/update/manufacturer/{manufacturer_id}', [ManufacturersController::class, 'update'])->name('update.manufacturer');

Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');
Route::get('register', [CustomAuthController::class, 'toRegister'])->name('register');
Route::post('register', [CustomAuthController::class, 'createUser'])->name('user.createUser');
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');

Route::get('home', [CustomAuthController::class, 'gohome'])->name('home');
Route::post('manager', [CustomAuthController::class, 'gomanager'])->name('manager');

Route::get('manager', [CustomAuthController::class, 'backmanager'])->name('backmanager');




Route::get('filter-products', [ProductController::class, 'index'])->name('filterProducts');
//Route::get('home', [ProductController::class, 'index'])->name('filterProducts');
Route::get('product', [ProductController::class, 'toproductedit'])->name('product.edit');
Route::post('product', [ProductController::class, 'productedit'])->name('conflim.edit.product');
// delete product
Route::get('deleteProduct',[ProductController:: class, 'delete'])->name('deleteProduct');
Route::get('showProductDetail',[ProductController:: class, 'show'])->name('showProductDetail');
// cart
Route::post('cart', [CartController::class, 'addToCart'])->name('cart');
Route::get('cart', [CartController::class, 'tocart'])->name('add.cart');
Route::post('removecart', [CartController::class, 'removetocart'])->name('remove.cart');


Route::get('/pasword/forgot', [ForgotController::class, 'showForgotForm'])->name('forgot.password.form');
Route::post('/pasword/forgot', [ForgotController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('/pasword/reset/{token}', [ForgotController::class, 'resetPassword'])->name('reset.password.form');
Route::post('/pasword/reset/', [ForgotController::class, 'resetPasswordPost'])->name('reset.password.post');


Route::get('manageruser', [UserController::class, 'listuser'])->name('manageruser');
Route::get('itemuser', [UserController::class, 'showinfouser'])->name('user.showitem');
Route::get('edituser', [UserController::class, 'editUser'])->name('user.edit');
Route::post('edituser', [UserController::class, 'cfeditUser'])->name('user.update');
Route::get('deleteuser', [UserController::class, 'deleteUser'])->name('user.delete');
Route::get('home', [ProductController::class, 'index'])->name('home');
Route::get('addproduct', [ProductController::class, 'showAddForm'])->name('addproduct');
Route::post('addproduct', [ProductController::class, 'store'])->name('store.product');
Route::get('product/image/{id}', [ProductController::class, 'getProductImage'])->name('get.product.image');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

Route::post('cart', [CartController::class, 'addToCart'])->name('cart');
Route::get('cart', [CartController::class, 'index'])->name('add.cart');
Route::post('cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
Route::get('/purchase-history', [CartController::class, 'purchaseHistory'])->name('purchase.history');

Route::post('/finalize-purchase', [CartController::class, 'finalizePurchase'])->name('finalize.purchase');
Route::get('/invoice/{id}', [CartController::class, 'viewInvoice'])->name('invoice.detail');

Route::get('/', function () {
    return redirect()->route('login');
});
