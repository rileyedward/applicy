<?php

namespace App\Services;

use App\Models\User;

class AuthenticationService
{
    public function registerUser(
        string $firstName,
        ?string $middleName,
        string $lastName,
        string $email,
        string $phoneNumber,
        string $location,
        string $password
    ): User {
        return User::query()->create([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'location' => $location,
            'password' => bcrypt($password),
        ]);
    }
}
