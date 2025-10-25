<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PaymentController;

// User authentication routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // User login route
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User dashboard routes
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard'); // User dashboard route
        Route::get('/', [UserController::class, 'index'])->name('index');
    });

    // Invoices
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
});
