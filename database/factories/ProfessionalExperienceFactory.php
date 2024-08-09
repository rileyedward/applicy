<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionalExperienceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'position' => $this->faker->jobTitle,
            'company_name' => $this->faker->company,
            'location' => $this->faker->city,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->optional()->date(),
            'description' => $this->faker->paragraph,
        ];
    }
}
