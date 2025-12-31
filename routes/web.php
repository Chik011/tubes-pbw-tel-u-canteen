<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


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

Route::post('/cart/plus/{item}', [OrderController::class, 'plusQty'])
    ->name('cart.plus');

Route::post('/cart/minus/{item}', [OrderController::class, 'minusQty'])
    ->name('cart.minus');


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

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/menus', [AdminController::class, 'menus'])->name('admin.menus');
    Route::get('/admin/menus/create', [AdminController::class, 'createMenu'])->name('admin.menus.create');
    Route::post('/admin/menus', [AdminController::class, 'storeMenu'])->name('admin.menus.store');
    Route::get('/admin/menus/{menu}/edit', [AdminController::class, 'editMenu'])->name('admin.menus.edit');
    Route::put('/admin/menus/{menu}', [AdminController::class, 'updateMenu'])->name('admin.menus.update');
    Route::delete('/admin/menus/{menu}', [AdminController::class, 'destroyMenu'])->name('admin.menus.destroy');
    Route::get('/admin/history', [AdminController::class, 'history'])->name('admin.history');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
