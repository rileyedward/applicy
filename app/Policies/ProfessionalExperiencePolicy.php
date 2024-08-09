<?php

namespace App\Policies;

use App\Models\ProfessionalExperience;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessionalExperiencePolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, ProfessionalExperience $professionalExperience): bool
    {
        return $user->id === $professionalExperience->user_id;
    }
}
