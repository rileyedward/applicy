<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserContextRepository
{
    public function __construct(protected User $user) {}

    public function buildContext(): array
    {
        return Cache::remember('user_context_'.$this->user->id, 60 * 60 * 24 * 5, function () {
            $context = [
                [
                    'role' => 'system',
                    'content' => $this->user->ai_context_string,
                ],
            ];

            $this->buildEducationContext($context);
            $this->buildProfessionalContext($context);
            $this->buildPortfolioContext($context);

            return $context;
        });
    }

    protected function buildEducationContext(&$context)
    {
        foreach ($this->user->educationExperiences as $educationExperience) {
            $context[] = [
                'role' => 'system',
                'content' => $educationExperience->ai_context_string,
            ];
        }
    }

    protected function buildProfessionalContext(&$context)
    {
        foreach ($this->user->professionalExperiences as $professionalExperience) {
            $context[] = [
                'role' => 'system',
                'content' => $professionalExperience->ai_context_string,
            ];
        }
    }

    protected function buildPortfolioContext(&$context)
    {
        foreach ($this->user->portfolioProjects as $portfolioProject) {
            $context[] = [
                'role' => 'system',
                'content' => $portfolioProject->ai_context_string,
            ];
        }
    }
}
