<?php

use App\Http\Controllers\ApplicationActionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationExperienceController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\PortfolioProjectController;
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
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

/** Work Experiences */
Route::middleware('auth')->prefix('work-experiences')->group(function () {
    Route::get('/', [WorkExperienceController::class, 'index'])->name('work-experience.index');
    Route::get('/create', [WorkExperienceController::class, 'create'])->name('work-experience.create');
    Route::post('/', [WorkExperienceController::class, 'store'])->name('work-experience.store');
    Route::get('/{workExperience}', [WorkExperienceController::class, 'show'])->name('work-experience.show');
    Route::put('/{workExperience}', [WorkExperienceController::class, 'update'])->name('work-experience.update');
    Route::delete('/{workExperience}', [WorkExperienceController::class, 'destroy'])->name('work-experience.destroy');
});

/** Education Experiences */
Route::middleware('auth')->prefix('education-experiences')->group(function () {
    Route::get('/', [EducationExperienceController::class, 'index'])->name('education-experience.index');
    Route::get('/create', [EducationExperienceController::class, 'create'])->name('education-experience.create');
    Route::post('/', [EducationExperienceController::class, 'store'])->name('education-experience.store');
    Route::get('/{educationExperience}', [EducationExperienceController::class, 'show'])->name('education-experience.show');
    Route::put('/{educationExperience}', [EducationExperienceController::class, 'update'])->name('education-experience.update');
    Route::delete('/{educationExperience}', [EducationExperienceController::class, 'destroy'])->name('education-experience.destroy');
});

/** Portfolio Projects */
Route::middleware('auth')->prefix('portfolio-projects')->group(function () {
    Route::get('/', [PortfolioProjectController::class, 'index'])->name('portfolio-project.index');
    Route::get('/create', [PortfolioProjectController::class, 'create'])->name('portfolio-project.create');
    Route::post('/', [PortfolioProjectController::class, 'store'])->name('portfolio-project.store');
    Route::get('/{portfolioProject}', [PortfolioProjectController::class, 'show'])->name('portfolio-project.show');
    Route::put('/{portfolioProject}', [PortfolioProjectController::class, 'update'])->name('portfolio-project.update');
    Route::delete('/{portfolioProject}', [PortfolioProjectController::class, 'destroy'])->name('portfolio-project.destroy');
});

/** Applications */
Route::middleware('auth')->prefix('applications')->group(function () {
    Route::get('/', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/{application}', [ApplicationController::class, 'show'])->name('application.show');
    Route::put('/{application}', [ApplicationController::class, 'update'])->name('application.update');
    Route::delete('/{application}', [ApplicationController::class, 'destroy'])->name('application.destroy');

    /** Actions */
    Route::post('/{application}/favorite', [ApplicationController::class, 'favorite'])->name('application.favorite');
    Route::get('/{application}/cover-letter', CoverLetterController::class)->name('application.cover-letter');
    Route::get('/{application}/application-follow-up', [FollowUpController::class, 'application'])->name('application.application-follow-up');
    Route::get('/{application}/interview-follow-up', [FollowUpController::class, 'interview'])->name('application.interview-follow-up');

    /** Progress Actions */
    Route::post('/{application}/actions', [ApplicationActionController::class, 'store'])->name('application-action.store');
    Route::put('/{application}/actions/{applicationAction}', [ApplicationActionController::class, 'update'])->name('application-action.update');
    Route::delete('/{application}/actions/{applicationAction}', [ApplicationActionController::class, 'destroy'])->name('application-action.destroy');
});

require __DIR__.'/auth.php';
