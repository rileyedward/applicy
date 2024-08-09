<?php

namespace Database\Factories;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_application_id' => JobApplication::factory(),
            'interview_date' => $this->faker->date(),
            'interview_time' => $this->faker->time(),
            'interview_url' => $this->faker->url(),
        ];
    }
}
