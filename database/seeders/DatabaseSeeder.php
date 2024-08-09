<?php

namespace Database\Seeders;

use App\Models\EducationExperience;
use App\Models\PortfolioProject;
use App\Models\ProfessionalExperience;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'dev@applicy.com',
        ]);

        EducationExperience::factory()->for($user)->create();

        ProfessionalExperience::factory()->for($user)->create();

        PortfolioProject::factory()->for($user)->create();
    }
}
