<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login'); // Updated to use a single method for both login and dashboard
    Route::post('/', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin dashboard routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Invoices
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

        // Payments
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    });
});