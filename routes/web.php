<?php

use App\Http\Controllers\EducationExperienceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Landing/Index'))->name('index');

/** Authentication */
Route::prefix('/register')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('register.index');
    Route::post('/', [RegistrationController::class, 'store'])->name('register.store');
});

Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'store'])->name('login.store');
});

Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');

/** Dashboard */
Route::get('/dashboard', fn () => inertia('Dashboard/Index'))->middleware('auth')->name('dashboard');

/** Education Experience */
Route::prefix('/education')->middleware('auth')->group(function () {
    Route::post('/', [EducationExperienceController::class, 'store'])->name('education.store');
    Route::put('/{educationExperience}', [EducationExperienceController::class, 'update'])->name('education.update');
    Route::delete('/{educationExperience}', [EducationExperienceController::class, 'destroy'])->name('education.destroy');
});

/** Profile */
Route::prefix('/profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
});
