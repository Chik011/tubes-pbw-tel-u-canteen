<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landingPage');
});

/*
|--------------------------------------------------------------------------
| Order / Menu
|--------------------------------------------------------------------------
*/
Route::get('/order', [OrderController::class, 'index'])
    ->name('order');

/*
|--------------------------------------------------------------------------
| Cart (Tambah ke Keranjang)
|--------------------------------------------------------------------------
*/
Route::post('/cart/add/{menu}', [OrderController::class, 'addToCart'])
    ->name('cart.add');

/*
|--------------------------------------------------------------------------
| Location
|--------------------------------------------------------------------------
*/
Route::get('/location', function () {
    return view('location');
})->name('location');

/*
|--------------------------------------------------------------------------
| Auth (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated User
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/checkout', [OrderController::class, 'checkout'])
        ->name('checkout');

    Route::get('/admin', function () {
        return view('admin/dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
