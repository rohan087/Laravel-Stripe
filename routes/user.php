<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;

// User authentication routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User dashboard route
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('index');
    });
});
