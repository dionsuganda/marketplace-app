<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [\App\Http\Controllers\GuestController::class, 'index'])->name('guestIndex');
Route::prefix('website')->group(function () {
    Route::post('/register', [\App\Http\Controllers\GuestController::class, 'register'])->name('guestRegister');
    Route::post('/login', [\App\Http\Controllers\GuestController::class, 'login'])->name('guestLogin');
});
Route::middleware(['isCustomer'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/{id}/addToCart', [\App\Http\Controllers\UserController::class, 'addToCart'])->name('addToCart');
        Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('userLogout');
        Route::get('/listCart', [\App\Http\Controllers\UserController::class, 'listCart'])->name('listCart');
        Route::post('/cart/{id}', [\App\Http\Controllers\UserController::class, 'deleteCart'])->name('deleteCart');
        Route::post('/checkout', [\App\Http\Controllers\UserController::class, 'checkout'])->name('checkoutCart');
    });
});

Auth::routes();
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('product')->group(function () {
        Route::get('/create',[\App\Http\Controllers\ProductController::class, 'index'])->name('createProduct');
        Route::post('/add',[\App\Http\Controllers\ProductController::class, 'create'])->name('postCreateProduct');
        Route::post('/delete/{id}',[\App\Http\Controllers\ProductController::class, 'delete'])->name('deleteProduct');
        Route::get('/detail/{id}',[\App\Http\Controllers\ProductController::class, 'detail'])->name('detailProduct');
        Route::get('/update/{id}',[\App\Http\Controllers\ProductController::class, 'updateView'])->name('updateViewProduct');
        Route::post('/update/{id}',[\App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');
    });
});


