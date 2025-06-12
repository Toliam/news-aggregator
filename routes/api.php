<?php

use App\Http\Controllers\Auth\ConfirmCodeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware(['guest', 'throttle:6,1'])->group(function () {
    Route::post('/register', RegisterController::class)
        ->name('auth.register');

    Route::post('/confirm-registration', ConfirmCodeController::class)
        ->name('auth.confirm');

    Route::post('/login',  LoginController::class)
        ->name('auth.login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', LogoutController::class)
        ->name('auth.logout');

    // Route::get('/sse/stream', StreamController::class);
});
