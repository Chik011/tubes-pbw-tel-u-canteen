<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/location', function () {
    return view('location');
})->name('location');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin/dashboard');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
