<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class DashboardRepository
{
    public function fetchUpcomingInterviews(User $user): Collection
    {
        return $user->interviews()
            ->with('jobApplication')
            ->where('interview_date', '>=', now())
            ->where('is_completed', false)
            ->orderBy('interview_date')
            ->get();
    }

    public function fetchUpcomingReminders(User $user): Collection
    {
        $applicationsToApplyTo = $this->fetchApplicationsToApplyTo($user);
        $challengesToComplete = $this->fetchChallengesToComplete($user);

        return $applicationsToApplyTo->merge($challengesToComplete)->sortBy('created_at')->values();
    }

    protected function fetchApplicationsToApplyTo(User $user): Collection
    {
        return $user->jobApplications()
            ->where('status', 'not_applied')
            ->get();
    }

    protected function fetchChallengesToComplete(User $user): Collection
    {
        return $user->jobApplications()
            ->where('status', 'challenge_sent')
            ->get();
    }
}
