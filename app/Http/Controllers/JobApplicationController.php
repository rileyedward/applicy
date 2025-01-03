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

        return inertia('Applications/Index/Page', [
            'environmentSelections' => $environmentSelections,
            'statusSelections' => $statusSelections,
            'locationSelections' => $locationSelections,
        ]);
    }

    public function store(JobApplicationRequest $request): RedirectResponse
    {
        $jobApplication = $this->jobApplicationService->createJobApplication(
            $request->user(),
            $request->input('job_url'),
            $request->input('company_url'),
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

        $jobApplication->addAction(
            $jobApplication->status_pretty,
            $jobApplication->status
        );

        $request->session()->flash('message', 'Job application created successfully!');

        return back();
    }

    public function show(Request $request, JobApplication $jobApplication): Response
    {
        $jobApplication->append('last_update');

        $actions = $jobApplication->actions()->orderBy('created_at', 'desc')->get();

        $environmentSelections = config('applications.environments');
        $statusSelections = config('applications.statuses');
        $locationSelections = $request->user()->jobApplications()->distinct('location')->pluck('location');

        $coverLetterTemplateSelections = $request->user()->coverLetterTemplates->map(function ($coverLetterTemplate) {
            return [
                'value' => $coverLetterTemplate->id,
                'label' => $coverLetterTemplate->title,
            ];
        });

        $resumeSelections = $request->user()->resumes->map(function ($resume) {
            return [
                'value' => $resume->id,
                'label' => $resume->title,
            ];
        });

        return inertia('Applications/Show/Page', [
            'jobApplication' => $jobApplication,
            'actions' => $actions,
            'environmentSelections' => $environmentSelections,
            'statusSelections' => $statusSelections,
            'locationSelections' => $locationSelections,
            'coverLetterTemplateSelections' => $coverLetterTemplateSelections,
            'resumeSelections' => $resumeSelections,
        ]);
    }

    public function update(JobApplicationRequest $request, JobApplication $jobApplication): RedirectResponse
    {
        Gate::authorize('isOwner', $jobApplication);

        $this->jobApplicationService->updateJobApplication(
            $jobApplication,
            $request->input('job_url'),
            $request->input('company_url'),
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
        );

        $request->session()->flash('message', 'Job application updated successfully!');

        return back();
    }

    public function destroy(JobApplication $jobApplication): RedirectResponse
    {
        Gate::authorize('isOwner', $jobApplication);

        $jobApplication->delete();

        return to_route('applications.index');
    }
}
