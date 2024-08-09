<?php

namespace App\Providers;

use App\Models\EducationExperience;
use App\Policies\EducationExperiencePolicy;
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
    }
}
