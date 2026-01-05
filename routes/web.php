<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;

// landing page
Route::get('/', function () {
    return view('landingPage');
})->name('home');

// order/menu
Route::get('/order', [OrderController::class, 'index'])
    ->name('order');
Route::post('/payment/callback', [OrderController::class, 'callback'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/payment/return', [OrderController::class, 'paymentReturn'])
    ->name('payment.return');


// keranjang
Route::post('/cart/add/{menu}', [OrderController::class, 'addToCart'])
    ->name('cart.add');

Route::post('/cart/plus/{item}', [OrderController::class, 'plusQty'])
    ->name('cart.plus');

Route::post('/cart/minus/{item}', [OrderController::class, 'minusQty'])
    ->name('cart.minus');

// lokasi
Route::get('/location', function () {
    return view('location');
})->name('location');

// auth guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

// auth user
Route::middleware('auth')->group(function () {

    Route::post('/checkout', [OrderController::class, 'checkout'])
        ->name('checkout');

    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history');

    Route::post('/order/{order}/payment', [OrderController::class, 'generatePaymentUrl'])
        ->name('order.payment');

    // Check payment status dari Midtrans
    Route::get('/order/{order}/check-status', [OrderController::class, 'manualCheckStatus'])
        ->name('order.check-status');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

// auth admin
Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        // MENU
        Route::get('/menus', [AdminController::class, 'menus'])
            ->name('admin.menus');

        Route::get('/menus/create', [AdminController::class, 'createMenu'])
            ->name('admin.menus.create');

        Route::post('/menus', [AdminController::class, 'storeMenu'])
            ->name('admin.menus.store');

        Route::get('/menus/{menu}/edit', [AdminController::class, 'editMenu'])
            ->name('admin.menus.edit');

        Route::put('/menus/{menu}', [AdminController::class, 'updateMenu'])
            ->name('admin.menus.update');

        Route::delete('/menus/{menu}', [AdminController::class, 'destroyMenu'])
            ->name('admin.menus.destroy');

        // HISTORY ADMIN
        Route::get('/history', [AdminController::class, 'history'])
            ->name('admin.history');

        // Export orders
        Route::get('/orders/export', [AdminController::class, 'exportOrders'])
            ->name('admin.orders.export');

        // Complete order
        Route::post('/order/{order}/complete', [OrderController::class, 'completeOrder'])
            ->name('order.complete');
});
