<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $repository = new DashboardRepository;
        $upcomingInterviews = $repository->fetchUpcomingInterviews($request->user());
        $upcomingReminders = $repository->fetchUpcomingReminders($request->user());

        return inertia('Dashboard/Index', [
            'upcomingInterviews' => $upcomingInterviews,
            'upcomingReminders' => $upcomingReminders,
        ]);
    }
}
