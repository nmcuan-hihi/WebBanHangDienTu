<?php
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\CartController;

// Route đến form thêm mới nhà sản xuất
Route::get('addmanufacturers', [ManufacturersController::class, 'showAddForm'])->name('add.manufacturer');
Route::post('addmanufacturers', [ManufacturersController::class, 'store'])->name('store.manufacturer');

// Route đến form chỉnh sửa nhà sản xuất
Route::get('/edit/manufacturer/{manufacturer_id}',[ManufacturersController::class, 'edit'])->name('edit.manufacturer');
Route::put('/update/manufacturer/{manufacturer_id}',[ManufacturersController::class, 'update'])->name('update.manufacturer');

// Route đến trang đăng nhập
Route::get('login', [CustomAuthController::class, 'toLogin'])->name('login');
Route::post('login', [CustomAuthController::class, 'checkUser'])->name('user.checkUser');

// Route đến trang chính (Home)
Route::get('home', [ProductController::class, 'index'])->name('home');

// Route đăng xuất
Route::get('signout', [CustomAuthController::class, 'signout'])->name('signout');

// Route đến trang tìm kiếm nhà sản xuất
Route::get('/search/manufacturers', [ManufacturersController::class, 'search'])->name('manufacturer.search');

// Route đến trang quản lý
Route::get('manager', [CustomAuthController::class, 'gomanager'])->name('manager');

// Route đến form thêm mới sản phẩm
Route::get('addproduct', [ProductController::class, 'showAddForm'])->name('addproduct');
Route::post('addproduct', [ProductController::class, 'store'])->name('store.product');

// Route để lấy hình ảnh sản phẩm
Route::get('product/image/{id}', [ProductController::class, 'getProductImage'])->name('get.product.image');

// Route đến trang tìm kiếm sản phẩm
Route::get('/search/products', [ProductController::class, 'search'])->name('product.search');

// Route thêm sản phẩm vào giỏ hàng
Route::post('cart', [CartController::class, 'addToCart'])->name('cart');
Route::get('cart', [CartController::class, 'index'])->name('add.cart');
Route::post('cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');

// Route mặc định, chuyển hướng đến trang đăng nhập
Route::get('/', function () {
    return redirect()->route('login');
});
