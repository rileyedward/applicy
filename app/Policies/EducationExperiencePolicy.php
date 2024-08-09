<?php

namespace App\Policies;

use App\Models\EducationExperience;
use App\Models\User;

class EducationExperiencePolicy
{
    public function isOwner(User $user, EducationExperience $educationExperience): bool
    {
        return $user->id === $educationExperience->user_id;
    }
}
