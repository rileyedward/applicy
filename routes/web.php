<?php

use App\Http\Controllers\EducationExperienceController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/** Landing Page */
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/** Dashboard */
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/** Work Experiences */
Route::middleware('auth')->prefix('work-experiences')->group(function () {
    Route::get('/', [WorkExperienceController::class, 'index'])->name('work-experience.index');
    Route::post('/', [WorkExperienceController::class, 'store'])->name('work-experience.store');
    Route::get('/{workExperience}', [WorkExperienceController::class, 'show'])->name('work-experience.show');
    Route::put('/{workExperience}', [WorkExperienceController::class, 'update'])->name('work-experience.update');
    Route::delete('/{workExperience}', [WorkExperienceController::class, 'destroy'])->name('work-experience.destroy');
});

/** Education Experiences */
Route::middleware('auth')->prefix('education-experiences')->group(function () {
    Route::get('/', [EducationExperienceController::class, 'index'])->name('education-experience.index');
    Route::post('/', [EducationExperienceController::class, 'store'])->name('education-experience.store');
    Route::get('/{educationExperience}', [EducationExperienceController::class, 'show'])->name('education-experience.show');
    Route::put('/{educationExperience}', [EducationExperienceController::class, 'update'])->name('education-experience.update');
    Route::delete('/{educationExperience}', [EducationExperienceController::class, 'destroy'])->name('education-experience.destroy');
});

require __DIR__.'/auth.php';
