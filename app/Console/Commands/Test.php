<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Test extends Command
{
    protected $signature = 'app:test';

    protected $description = 'Used as a scratch pad for testing code.';

    public function handle(): void
    {
        $user = User::query()->where('id', 1)->first();

        logger($user->first_name);

        $educationExperiences = $user->educationExperiences;
        $educationOutput = '';
        foreach ($educationExperiences as $educationExperience) {
            $educationOutput .= $educationExperience->institution_name . ', ' . $educationExperience->degree . ', ' . $educationExperience->field_of_study . ', ' . $educationExperience->start_date . ' - ' . $educationExperience->end_date . PHP_EOL;
            $educationOutput .= $educationExperience->description . PHP_EOL;
            $educationOutput .= 'Skills: ' . $educationExperience->skills . PHP_EOL;
        }

        logger($educationOutput);

        $workExperience = $user->workExperiences;
        $workOutput = '';
        foreach ($workExperience as $work) {
            $workOutput .= $work->company_name . ', ' . $work->position . ', ' . $work->start_date . ' - ' . $work->end_date . PHP_EOL;
            $workOutput .= $work->description . PHP_EOL;
            $workOutput .= 'Skills: ' . $work->skills . PHP_EOL;
        }

        logger($workOutput);

        $portfolioProjects = $user->portfolioProjects;
        $projectsOutput = '';
        foreach ($portfolioProjects as $portfolioProject) {
            $projectsOutput .= $portfolioProject->project_name . PHP_EOL;
            $projectsOutput .= $portfolioProject->description . PHP_EOL;
            $projectsOutput .= $portfolioProject->skils . PHP_EOL;
        }

        logger($projectsOutput);
    }
}
