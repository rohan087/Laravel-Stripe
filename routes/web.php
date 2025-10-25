<?php

use Illuminate\Support\Facades\Route;

// Landing page route
Route::get('/', function () {
    return view('landing');
});

// User section route
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PaymentController;

Route::get('/user', [DashboardController::class, 'index'])->name('user.dashboard');

// User invoices
Route::get('/user/invoices', [InvoiceController::class, 'index'])->name('user.invoices.index');
Route::get('/user/invoices/{id}', [InvoiceController::class, 'show'])->name('user.invoices.show');
Route::get('/user/invoices/pay/{id?}', [InvoiceController::class, 'pay'])->name('user.invoices.pay');

// User payments
Route::get('/user/payments', [PaymentController::class, 'index'])->name('user.payments.index');
Route::get('/user/payments/{id}', [PaymentController::class, 'show'])->name('user.payments.show');

// Admin section route
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
