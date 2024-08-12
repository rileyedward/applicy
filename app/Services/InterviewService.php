<?php

namespace App\Services;

use App\Models\Interview;
use App\Models\JobApplication;
use App\Models\JobApplicationAction;
use App\Models\User;

class InterviewService
{
    public function scheduleInterview(
        User $user,
        JobApplication $jobApplication,
        JobApplicationAction $jobApplicationAction,
        string $interviewDate,
        string $interviewTime,
        ?string $interviewUrl,
        ?string $notes
    ): Interview {
        return Interview::query()->create([
            'user_id' => $user->id,
            'job_application_id' => $jobApplication->id,
            'job_application_action_id' => $jobApplicationAction->id,
            'interview_date' => $interviewDate,
            'interview_time' => $interviewTime,
            'interview_url' => $interviewUrl,
            'is_completed' => false,
            'notes' => $notes,
        ]);
    }

    public function updateInterview(
        Interview $interview,
        string $interviewDate,
        string $interviewTime,
        ?string $interviewUrl,
        ?string $notes
    ): Interview {
        $interview->update([
            'interview_date' => $interviewDate,
            'interview_time' => $interviewTime,
            'interview_url' => $interviewUrl,
            'notes' => $notes,
        ]);

        return $interview;
    }

    public function deleteInterview(Interview $interview): void
    {
        $interview->delete();
    }

    public function completeInterview(Interview $interview): Interview
    {
        $interview->update([
            'is_completed' => true,
        ]);

        return $interview;
    }
}
