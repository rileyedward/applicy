<?php

namespace App\Services;

use App\Models\EducationExperience;
use App\Models\User;

class EducationService
{
    public function createEducationExperience(
        User $user,
        string $institutionName,
        string $location,
        string $degree,
        string $fieldOfStudy,
        string $startDate,
        string $endDate,
        string $description
    ): EducationExperience {
        return EducationExperience::query()->create([
            'user_id' => $user->id,
            'institution_name' => $institutionName,
            'location' => $location,
            'degree' => $degree,
            'field_of_study' => $fieldOfStudy,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $description,
        ]);
    }

    public function updateEducationExperience(
        EducationExperience $educationExperience,
        string $institutionName,
        string $location,
        string $degree,
        string $fieldOfStudy,
        string $startDate,
        string $endDate,
        string $description
    ): EducationExperience {
        $educationExperience->update([
            'institution_name' => $institutionName,
            'location' => $location,
            'degree' => $degree,
            'field_of_study' => $fieldOfStudy,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $description,
        ]);

        return $educationExperience;
    }

    public function deleteEducationExperience(EducationExperience $educationExperience): void
    {
        $educationExperience->delete();
    }
}
