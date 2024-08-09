<?php

namespace App\Policies;

use App\Models\EducationExperience;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationExperiencePolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, EducationExperience $educationExperience): bool
    {
        return $user->id === $educationExperience->user_id;
    }
}
