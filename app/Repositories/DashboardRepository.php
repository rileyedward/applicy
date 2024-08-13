<?php

namespace App\Repositories;

use App\Models\JobApplicationAction;
use App\Models\User;
use Illuminate\Support\Collection;

class DashboardRepository
{
    public function fetchRecentActivity(User $user): Collection
    {
        return JobApplicationAction::query()
            ->whereHas('jobApplication', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with('jobApplication')
            ->where('created_at', '>=', now()->subDays(3))
            ->limit(5)
            ->get();
    }

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
