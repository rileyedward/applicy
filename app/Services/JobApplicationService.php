<?php

namespace App\Services;

use App\Models\JobApplication;
use App\Models\User;

class JobApplicationService
{
    public function createJobApplication(
        User $user,
        ?string $jobUrl,
        ?string $companyUrl,
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
            'company_url' => $companyUrl,
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
        ?string $companyUrl,
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
    ): JobApplication {
        $jobApplication->update([
            'job_url' => $jobUrl,
            'company_url' => $companyUrl,
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
        ]);

        return $jobApplication;
    }

    public function deleteJobApplication(JobApplication $jobApplication): void
    {
        $jobApplication->delete();
    }

    public function getReminder(JobApplication $jobApplication): array
    {
        if ($jobApplication->interviews()->exists()) {
            $interview = $jobApplication->interviews->first();

            return [
                'color' => 'blue',
                'message' => 'You have an interview scheduled for '.$interview->interview_date.' at '.$interview->interview_time,
            ];
        }

        if ($jobApplication->status === 'challenge_sent') {
            return [
                'color' => 'orange',
                'message' => 'You have a coding challenge due soon',
            ];
        }

        if ($jobApplication->status === 'offered') {
            return [
                'color' => 'green',
                'message' => 'You have an offer from '.$jobApplication->company_name,
            ];
        }

        return [];
    }
}
