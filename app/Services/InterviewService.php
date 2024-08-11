<?php

namespace App\Services;

use App\Models\Interview;
use App\Models\JobApplication;
use App\Models\User;

class InterviewService
{
    public function scheduleInterview(
        User $user,
        JobApplication $jobApplication,
        string $interviewDate,
        string $interviewTime,
        string $interviewUrl,
        ?string $notes
    ): Interview {
        return Interview::query()->create([
            'user_id' => $user->id,
            'job_application_id' => $jobApplication->id,
            'interview_date' => $interviewDate,
            'interview_time' => $interviewTime,
            'interview_url' => $interviewUrl,
            'is_completed' => false,
            'notes' => $notes,
        ]);
    }
}
