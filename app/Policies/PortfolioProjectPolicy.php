<?php

namespace App\Policies;

use App\Models\PortfolioProject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfolioProjectPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, PortfolioProject $portfolioProject): bool
    {
        return $user->id === $portfolioProject->user_id;
    }
}
