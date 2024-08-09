<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'stripe_id' => $this->faker->uuid,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
