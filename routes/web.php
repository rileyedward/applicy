<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

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
