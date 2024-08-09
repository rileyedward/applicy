<?php

namespace App\Policies;

use App\Models\CoverLetterTemplate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoverLetterTemplatePolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, CoverLetterTemplate $coverLetterTemplate): bool
    {
        return $user->id === $coverLetterTemplate->user_id;
    }
}
