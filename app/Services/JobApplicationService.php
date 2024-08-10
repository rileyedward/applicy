<?php

namespace App\Services;

use App\Models\JobApplication;
use App\Models\User;

class JobApplicationService
{
    public function createJobApplication(
        User $user,
        ?string $jobUrl,
        string $position,
        string $companyName,
        string $location,
        string $environment,
        ?string $salaryRange,
        ?string $contactName,
        ?string $contactEmail,
        ?string $contactPhone,
        ?string $description,
        ?string $notes,
        string $status
    ): JobApplication {
        return JobApplication::query()->create([
            'user_id' => $user->id,
            'job_url' => $jobUrl,
            'position' => $position,
            'company_name' => $companyName,
            'location' => $location,
            'environment' => $environment,
            'salary_range' => $salaryRange,
            'contact_name' => $contactName,
            'contact_email' => $contactEmail,
            'contact_phone' => $contactPhone,
            'description' => $description,
            'notes' => $notes,
            'status' => $status,
        ]);
    }

    public function updateJobApplication(
        JobApplication $jobApplication,
        ?string $jobUrl,
        string $position,
        string $companyName,
        string $location,
        string $environment,
        ?string $salaryRange,
        ?string $contactName,
        ?string $contactEmail,
        ?string $contactPhone,
        ?string $description,
        ?string $notes,
        string $status
    ): JobApplication {
        $jobApplication->update([
            'job_url' => $jobUrl,
            'position' => $position,
            'company_name' => $companyName,
            'location' => $location,
            'environment' => $environment,
            'salary_range' => $salaryRange,
            'contact_name' => $contactName,
            'contact_email' => $contactEmail,
            'contact_phone' => $contactPhone,
            'description' => $description,
            'notes' => $notes,
            'status' => $status,
        ]);

        return $jobApplication;
    }

    public function deleteJobApplication(JobApplication $jobApplication): void
    {
        $jobApplication->delete();
    }
}
