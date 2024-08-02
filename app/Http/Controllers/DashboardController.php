<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $needToApply = Application::query()
            ->where('user_id', $user->id)
            ->where('status', 'need_to_apply')
            ->get();

        $interviewsScheduled = Application::query()
            ->where('user_id', $user->id)
            ->where('status', 'interview_scheduled')
            ->get();

        $offeredExtended = Application::query()
            ->where('user_id', $user->id)
            ->where('status', 'offer_extended')
            ->get();

        return inertia('Dashboard/Index', [
            'needToApply' => $needToApply,
            'interviewsScheduled' => $interviewsScheduled,
            'interviewScheduled' => $offeredExtended,
        ]);
    }
}
