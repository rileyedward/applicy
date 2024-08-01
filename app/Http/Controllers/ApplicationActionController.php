<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationActionRequest;
use App\Models\Application;
use App\Models\ApplicationAction;
use Illuminate\Http\RedirectResponse;

class ApplicationActionController extends Controller
{
    public function store(ApplicationActionRequest $request, Application $application): RedirectResponse
    {
        $oldStatus = strtolower($application->status);

        if ($request->has('status')) {
            $application->update([
                'status' => $request->input('status'),
            ]);
            $application->refresh();
        }

        if ($request->has('interview_date')) {
            $application->update([
                'interview_date' => $request->input('interview_date'),
                'interview_time' => $request->input('interview_time'),
            ]);
        }

        ApplicationAction::query()->create([
            'user_id' => $request->user()->id,
            'application_id' => $application->id,
            'title' => $request->input('title'),
            'previous_status' => $oldStatus,
            'new_status' => strtolower($application->status),
            'notes' => $request->input('notes'),
        ]);

        return back();
    }
}
