<?php

namespace App\Repositories;

use App\Models\User;

class UserContextRepository
{
    public function __construct(protected User $user) {}

    public function buildContext(): array
    {
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
