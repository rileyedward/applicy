<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return inertia('Welcome');
    })->name('dashboard');
});

Route::prefix('/register')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('register.index');
    Route::post('/', [RegistrationController::class, 'store'])->name('register.store');
});

Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/', [LoginController::class, 'store'])->name('login.store');
});
