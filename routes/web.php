<?php

use Illuminate\Support\Facades\Route;

// Welcome page route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Include user and admin route files
require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
