<?php

namespace Database\Factories;

use App\Models\EducationExperience;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationSkillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'education_experience_id' => EducationExperience::factory(),
            'skill_id' => Skill::factory(),
        ];
    }
}
