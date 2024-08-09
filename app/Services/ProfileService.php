<?php

namespace App\Services;

use App\Models\User;

class ProfileService
{
    public function updateProfile(
        User $user,
        string $firstName,
        ?string $middleName,
        string $lastName,
        ?string $phoneNumber,
        string $location
    ): User {
        $user->update([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'phone_number' => $phoneNumber,
            'location' => $location,
        ]);

        return $user;
    }
}
