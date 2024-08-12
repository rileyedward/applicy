<?php

namespace App\Policies;

use App\Models\Interview;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterviewPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, Interview $interview): bool
    {
        return $user->id === $interview->user_id;
    }
}
