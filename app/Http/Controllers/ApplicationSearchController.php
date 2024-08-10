<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationSearchRequest;
use App\Models\JobApplication;
use Illuminate\Http\JsonResponse;

class ApplicationSearchController extends Controller
{
    public function __invoke(ApplicationSearchRequest $request): JsonResponse
    {
        $user = $request->user();
        $environments = $request->input('environments');
        $statuses = $request->input('statuses');
        $locations = $request->input('locations');

        $jobApplications = JobApplication::query()
            ->where('user_id', $user->id)
            ->when($environments, fn ($query, $environments) => $query->whereIn('environment', $environments))
            ->when($statuses, fn ($query, $statuses) => $query->whereIn('status', $statuses))
            ->when($locations, fn ($query, $locations) => $query->whereIn('location', $locations))
            ->get()
            ->append('last_update');

        return response()->json($jobApplications);
    }
}
