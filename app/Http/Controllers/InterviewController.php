<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewRequest;
use App\Models\Interview;
use App\Services\InterviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InterviewController extends Controller
{
    public function __construct(protected InterviewService $interviewService) {}

    public function update(InterviewRequest $request, Interview $interview): RedirectResponse
    {
        Gate::authorize('isOwner', $interview);

        $this->interviewService->updateInterview(
            $interview,
            $request->input('interview_date'),
            $request->input('interview_time'),
            $request->input('interview_url'),
            $request->input('notes')
        );

        return back();
    }

    public function destroy(Request $request, Interview $interview): RedirectResponse
    {
        Gate::authorize('isOwner', $interview);

        $this->interviewService->deleteInterview($interview);

        return back();
    }

    public function complete(Request $request, Interview $interview): RedirectResponse
    {
        Gate::authorize('isOwner', $interview);

        $this->interviewService->completeInterview($interview);

        $jobApplication = $interview->jobApplication;

        $jobApplication->addAction(
            'Interview completed',
            'in_review',
        );

        $jobApplication->update([
            'status' => 'in_review',
        ]);

        return back();
    }
}
