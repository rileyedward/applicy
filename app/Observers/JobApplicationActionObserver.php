<?php

namespace App\Observers;

use App\Models\JobApplicationAction;
use App\Services\InterviewService;

class JobApplicationActionObserver
{
    public function __construct(protected InterviewService $interviewService) {}

    public function created(JobApplicationAction $jobApplicationAction): void
    {
        $user = $jobApplicationAction->jobApplication->user;

        if ($jobApplicationAction->new_status === 'interview_scheduled') {
            $this->interviewService->scheduleInterview(
                $user,
                $jobApplicationAction->jobApplication,
                $jobApplicationAction->interview_date,
                $jobApplicationAction->interview_time,
                $jobApplicationAction->interview_url,
                $jobApplicationAction->notes
            );
        }
    }
}
