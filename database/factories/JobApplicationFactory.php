<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_url' => $this->faker->url,
            'position' => $this->faker->jobTitle,
            'company_name' => $this->faker->company,
            'location' => $this->faker->city,
            'environment' => 'remote',
            'salary_range' => $this->faker->randomElement(['$50,000 - $70,000', '$70,000 - $90,000', '$90,000 - $110,000', '$110,000 - $130,000', '$130,000 - $150,000']),
            'description' => $this->faker->paragraph,
        ];
    }
}
