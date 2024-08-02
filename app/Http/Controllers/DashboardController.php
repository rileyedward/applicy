<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $statusRankings = [
            'offer_accepted',
            'offer_extended',
            'interview_scheduled',
            'coding_challenge',
            'need_to_apply',
        ];

        $applications = Application::query()
            ->where('user_id', $request->user()->id)
            ->whereIn('status', $statusRankings)
            ->orderByRaw('FIELD(status, '.implode(',', array_map(function ($status) {
                return "'$status'";
            }, $statusRankings)).')')
            ->orderBy('updated_at', 'asc')
            ->get();

        return inertia('Dashboard/Index', [
            'applications' => $applications,
        ]);
    }
}
