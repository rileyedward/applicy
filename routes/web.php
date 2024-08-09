<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Landing/Index'))->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => inertia('Dashboard/Index'))->name('dashboard');
});

Route::prefix('/register')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('register.index');
    Route::post('/', [RegistrationController::class, 'store'])->name('register.store');
});

Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'store'])->name('login.store');
});

Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
