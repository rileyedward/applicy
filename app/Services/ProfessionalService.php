<?php

namespace App\Services;

use App\Models\ProfessionalExperience;
use App\Models\User;

class ProfessionalService
{
    public function createProfessionalExperience(
        User $user,
        string $position,
        string $companyName,
        string $location,
        string $startDate,
        string $endDate,
        string $description
    ): ProfessionalExperience {
        return ProfessionalExperience::query()->create([
            'user_id' => $user->id,
            'position' => $position,
            'company_name' => $companyName,
            'location' => $location,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $description,
        ]);
    }

    public function updateProfessionalExperience(
        ProfessionalExperience $professionalExperience,
        string $position,
        string $companyName,
        string $location,
        string $startDate,
        string $endDate,
        string $description
    ): ProfessionalExperience {
        $professionalExperience->update([
            'position' => $position,
            'company_name' => $companyName,
            'location' => $location,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $description,
        ]);

        return $professionalExperience;
    }

    public function deleteProfessionalExperience(ProfessionalExperience $professionalExperience): void
    {
        $professionalExperience->delete();
    }
}
