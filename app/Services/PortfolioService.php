<?php

namespace App\Services;

use App\Models\PortfolioProject;
use App\Models\User;

class PortfolioService
{
    public function createPortfolioProject(
        User $user,
        string $name,
        ?string $url,
        ?string $description
    ): PortfolioProject {
        return PortfolioProject::query()->create([
            'user_id' => $user->id,
            'name' => $name,
            'url' => $url,
            'description' => $description,
        ]);
    }

    public function updatePortfolioProject(
        PortfolioProject $portfolioProject,
        string $name,
        ?string $url,
        ?string $description
    ): PortfolioProject {
        $portfolioProject->update([
            'name' => $name,
            'url' => $url,
            'description' => $description,
        ]);

        return $portfolioProject;
    }

    public function deletePortfolioProject(PortfolioProject $portfolioProject): void
    {
        $portfolioProject->delete();
    }
}
