<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $upcomingInterviews = $request->user()
            ->interviews()
            ->with('jobApplication')
            ->where('interview_date', '>=', now())
            ->where('is_completed', false)
            ->orderBy('interview_date')
            ->get();

        return inertia('Dashboard/Index', [
            'upcomingInterviews' => $upcomingInterviews,
        ]);
    }
}
