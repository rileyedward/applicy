<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationExperienceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'institution_name' => $this->faker->company,
            'degree' => $this->faker->word,
            'field_of_study' => $this->faker->word,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'description' => $this->faker->sentence,
        ];
    }
}
