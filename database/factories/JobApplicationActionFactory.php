<?php

namespace Database\Factories;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationActionFactory extends Factory
{
    public function definition(): array
    {
        $statuses = config('applications.statuses');
        $statusEnums = array_map(fn ($status) => $status['value'], $statuses);

        return [
            'job_application_id' => JobApplication::factory(),
            'title' => $this->faker->sentence,
            'previous_status' => $this->faker->randomElement($statusEnums),
            'new_status' => $this->faker->randomElement($statusEnums),
            'notes' => $this->faker->paragraph,
        ];
    }
}
