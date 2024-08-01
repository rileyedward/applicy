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

        $application->update([
            'status' => $request->input('status'),
        ]);
        $application->refresh();

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

    public function update(ApplicationActionRequest $request, Application $application, ApplicationAction $applicationAction): RedirectResponse
    {
        if ($application->actions()->latest()->first()->id === $applicationAction->id) {
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

        $applicationAction->update([
            'title' => $request->input('title'),
            'new_status' => strtolower($application->status),
            'notes' => $request->input('notes'),
        ]);

        return back();
    }

    public function destroy(Application $application, ApplicationAction $applicationAction): RedirectResponse
    {
        if ($application->actions()->latest()->first()->id === $applicationAction->id) {
            $application->update([
                'status' => $applicationAction->previous_status,
            ]);
        }

        if ($applicationAction->new_status === 'interview_scheduled') {
            $application->update([
                'interview_date' => null,
                'interview_time' => null,
            ]);
        }

        $applicationAction->delete();

        return back();
    }
}
