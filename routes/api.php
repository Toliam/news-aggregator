<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware(['guest', 'throttle:10,1'])->group(function () {
    Route::post('/register', [RegisterController::class, 'handle'])->name('auth.register');
});
