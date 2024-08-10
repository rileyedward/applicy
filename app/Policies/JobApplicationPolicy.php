<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobApplicationPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, JobApplication $jobApplication): bool
    {
        return $user->id === $jobApplication->user_id;
    }
}
