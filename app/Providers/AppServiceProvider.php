<?php

namespace App\Providers;

use App\Models\CoverLetterTemplate;
use App\Models\EducationExperience;
use App\Models\Interview;
use App\Models\PortfolioProject;
use App\Models\ProfessionalExperience;
use App\Models\Resume;
use App\Policies\CoverLetterTemplatePolicy;
use App\Policies\EducationExperiencePolicy;
use App\Policies\InterviewPolicy;
use App\Policies\PortfolioProjectPolicy;
use App\Policies\ProfessionalExperiencePolicy;
use App\Policies\ResumePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /** Policies */
        Gate::policy(EducationExperience::class, EducationExperiencePolicy::class);
        Gate::policy(ProfessionalExperience::class, ProfessionalExperiencePolicy::class);
        Gate::policy(PortfolioProject::class, PortfolioProjectPolicy::class);
        Gate::policy(CoverLetterTemplate::class, CoverLetterTemplatePolicy::class);
        Gate::policy(Resume::class, ResumePolicy::class);
        Gate::policy(Interview::class, InterviewPolicy::class);
    }
}
