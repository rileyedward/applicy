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

        foreach ($educationExperiences as $educationExperience) {

        }

        logger($educationExperiences);
    }
}
