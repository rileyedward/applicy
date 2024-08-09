<?php

namespace Database\Factories;

use App\Models\ProfessionalExperience;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionalSkillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'professional_experience_id' => ProfessionalExperience::factory(),
            'skill_id' => Skill::factory(),
        ];
    }
}
