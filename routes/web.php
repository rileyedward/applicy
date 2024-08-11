<?php

use App\Http\Controllers\ApplicationActionController;
use App\Http\Controllers\ApplicationSearchController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\EducationExperienceController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PortfolioProjectController;
use App\Http\Controllers\ProfessionalExperienceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResumeController;
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

/** Professional Experience */
Route::prefix('/professional')->middleware('auth')->group(function () {
    Route::post('/', [ProfessionalExperienceController::class, 'store'])->name('professional.store');
    Route::put('/{professionalExperience}', [ProfessionalExperienceController::class, 'update'])->name('professional.update');
    Route::delete('/{professionalExperience}', [ProfessionalExperienceController::class, 'destroy'])->name('professional.destroy');
});

/** Portfolio Projects */
Route::prefix('/portfolio')->middleware('auth')->group(function () {
    Route::post('/', [PortfolioProjectController::class, 'store'])->name('portfolio.store');
    Route::put('/{portfolioProject}', [PortfolioProjectController::class, 'update'])->name('portfolio.update');
    Route::delete('/{portfolioProject}', [PortfolioProjectController::class, 'destroy'])->name('portfolio.destroy');
});

/** Cover Letter Templates */
Route::prefix('/cover-letters')->middleware('auth')->group(function () {
    Route::get('/', [CoverLetterController::class, 'index'])->name('cover-letter.index');
    Route::get('/new', [CoverLetterController::class, 'create'])->name('cover-letter.create');
    Route::post('/', [CoverLetterController::class, 'store'])->name('cover-letter.store');
    Route::get('/{coverLetterTemplate}', [CoverLetterController::class, 'show'])->name('cover-letter.show');
    Route::put('/{coverLetterTemplate}', [CoverLetterController::class, 'update'])->name('cover-letter.update');
    Route::delete('/{coverLetterTemplate}', [CoverLetterController::class, 'destroy'])->name('cover-letter.destroy');
});

/** Resumes */
Route::prefix('/resumes')->middleware('auth')->group(function () {
    Route::get('/', [ResumeController::class, 'index'])->name('resumes.index');
    Route::post('/', [ResumeController::class, 'store'])->name('resumes.store');
    Route::get('/{resume}', [ResumeController::class, 'show'])->name('resumes.show');
    Route::get('/{resume}/view', [ResumeController::class, 'view'])->name('resumes.view');
    Route::get('/{resume}/download', [ResumeController::class, 'download'])->name('resumes.download');
});

/** Applications */
Route::prefix('/applications')->middleware('auth')->group(function () {
    Route::get('/', [JobApplicationController::class, 'index'])->name('applications.index');
    Route::post('/', [JobApplicationController::class, 'store'])->name('applications.store');
    Route::get('/search', ApplicationSearchController::class)->name('applications.search');

    Route::prefix('/{jobApplication}')->group(function () {
        Route::get('/', [JobApplicationController::class, 'show'])->name('applications.show');
        Route::put('/', [JobApplicationController::class, 'update'])->name('applications.update');
        Route::delete('/', [JobApplicationController::class, 'destroy'])->name('applications.destroy');

        Route::post('/actions', [ApplicationActionController::class, 'store'])->name('applications.actions.store');
        Route::put('/actions/{jobApplicationAction}', [ApplicationActionController::class, 'update'])->name('applications.actions.update');
        Route::delete('/actions/{jobApplicationAction}', [ApplicationActionController::class, 'destroy'])->name('applications.actions.destroy');
    });
});

/** Profile */
Route::prefix('/profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
});
