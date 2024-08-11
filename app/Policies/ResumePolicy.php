<?php

namespace App\Policies;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResumePolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, Resume $resume): bool
    {
        return $user->id === $resume->user_id;
    }
}
