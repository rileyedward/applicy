<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationActionRequest;
use App\Models\JobApplication;
use App\Models\JobApplicationAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ApplicationActionController extends Controller
{
    public function store(ApplicationActionRequest $request, JobApplication $jobApplication): RedirectResponse
    {
        Gate::authorize('isOwner', $jobApplication);

        $jobApplication->addAction(
            $request->input('title'),
            $request->input('new_status'),
            $request->input('notes')
        );

        $jobApplication->update([
            'status' => $request->input('new_status'),
        ]);

        return back();
    }

    public function update(ApplicationActionRequest $request, JobApplication $jobApplication, JobApplicationAction $jobApplicationAction): RedirectResponse
    {
        Gate::authorize('isOwner', $jobApplication);

        $jobApplicationAction->update([
            'title' => $request->input('title'),
            'new_status' => $request->input('new_status'),
            'notes' => $request->input('notes'),
        ]);

        return back();
    }

    public function destroy(JobApplication $jobApplication, JobApplicationAction $jobApplicationAction): RedirectResponse
    {
        Gate::authorize('isOwner', $jobApplication);

        if ($jobApplication->actions()->latest()->first()->id === $jobApplicationAction->id) {
            $jobApplication->update([
                'status' => $jobApplicationAction->previous_status,
            ]);
        }

        $jobApplicationAction->delete();

        return back();
    }
}
