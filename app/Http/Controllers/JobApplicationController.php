<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationRequest;
use App\Models\JobApplication;
use App\Services\JobApplicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class JobApplicationController extends Controller
{
    public function __construct(protected JobApplicationService $jobApplicationService) {}

    public function index(Request $request): Response
    {
        $environmentSelections = config('applications.environments');
        $statusSelections = config('applications.statuses');
        $locationSelections = $request->user()->jobApplications()->distinct('location')->pluck('location');

        return inertia('Applications/Index', [
            'environmentSelections' => $environmentSelections,
            'statusSelections' => $statusSelections,
            'locationSelections' => $locationSelections,
        ]);
    }

    public function store(JobApplicationRequest $request): RedirectResponse
    {
        $this->jobApplicationService->createJobApplication(
            $request->user(),
            $request->input('job_url'),
            $request->input('position'),
            $request->input('company_name'),
            $request->input('location'),
            $request->input('environment'),
            $request->input('salary_range'),
            $request->input('contact_name'),
            $request->input('contact_email'),
            $request->input('contact_phone'),
            $request->input('description'),
            $request->input('notes'),
            $request->input('status')
        );

        return back();
    }

    public function update(JobApplicationRequest $request, JobApplication $jobApplication): RedirectResponse
    {
        Gate::authorize('isOwner', $jobApplication);

        $this->jobApplicationService->updateJobApplication(
            $jobApplication,
            $request->input('job_url'),
            $request->input('position'),
            $request->input('company_name'),
            $request->input('location'),
            $request->input('environment'),
            $request->input('salary_range'),
            $request->input('contact_name'),
            $request->input('contact_email'),
            $request->input('contact_phone'),
            $request->input('description'),
            $request->input('notes'),
            $request->input('status')
        );

        return back();
    }

    public function destroy(JobApplication $jobApplication): RedirectResponse
    {
        Gate::authorize('isOwner', $jobApplication);

        $jobApplication->delete();

        return back();
    }
}
