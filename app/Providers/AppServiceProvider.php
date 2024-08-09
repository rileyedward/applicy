<?php

namespace App\Providers;

use App\Models\EducationExperience;
use App\Models\ProfessionalExperience;
use App\Policies\EducationExperiencePolicy;
use App\Policies\ProfessionalExperiencePolicy;
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
    }
}
