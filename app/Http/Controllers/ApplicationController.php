<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\ApplicationAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class ApplicationController extends Controller
{
    public function index(Request $request): Response
    {
        $applications = Application::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('updated_at', 'desc')
            ->orderBy('status', 'desc')
            ->get();

        $statusFilters = [
            [
                'value' => null,
                'label' => 'All',
            ],
            [
                'value' => 'need_to_apply',
                'label' => 'Need to Apply',
            ],
            [
                'value' => 'applied',
                'label' => 'Applied',
            ],
            [
                'value' => 'in_review',
                'label' => 'In Review',
            ],
            [
                'value' => 'coding_challenge',
                'label' => 'Coding Challenge',
            ],
            [
                'value' => 'interview_scheduled',
                'label' => 'Interview Scheduled',
            ],
            [
                'value' => 'interviewed',
                'label' => 'Interviewed',
            ],
            [
                'value' => 'offer_extended',
                'label' => 'Offer Extended',
            ],
            [
                'value' => 'offer_accepted',
                'label' => 'Offer Accepted',
            ],
            [
                'value' => 'offer_declined',
                'label' => 'Offer Declined',
            ],
            [
                'value' => 'rejected',
                'label' => 'Rejected',
            ],
            [
                'value' => 'withdrawn',
                'label' => 'Withdrawn',
            ],
        ];

        $environmentFilters = [
            [
                'value' => null,
                'label' => 'All',
            ],
            [
                'value' => 'remote',
                'label' => 'Remote',
            ],
            [
                'value' => 'on-site',
                'label' => 'On-Site',
            ],
            [
                'value' => 'hybrid',
                'label' => 'Hybrid',
            ],
        ];

        $locationFilters = $applications->pluck('location')->unique()->map(function ($location) {
            return [
                'value' => $location,
                'label' => $location,
            ];
        })->prepend([
            'value' => null,
            'label' => 'All',
        ]);

        return inertia('Applications/Index', [
            'applications' => $applications,
            'statusFilters' => $statusFilters,
            'environmentFilters' => $environmentFilters,
            'locationFilters' => $locationFilters,
        ]);
    }

    public function create(): Response
    {
        $statusFilters = [
            [
                'value' => 'applied',
                'label' => 'Applied',
            ],
            [
                'value' => 'need_to_apply',
                'label' => 'Need to Apply',
            ],
            [
                'value' => 'in_review',
                'label' => 'In Review',
            ],
            [
                'value' => 'coding_challenge',
                'label' => 'Coding Challenge',
            ],
            [
                'value' => 'interview_scheduled',
                'label' => 'Interview Scheduled',
            ],
            [
                'value' => 'interviewed',
                'label' => 'Interviewed',
            ],
            [
                'value' => 'offer_extended',
                'label' => 'Offer Extended',
            ],
            [
                'value' => 'offer_accepted',
                'label' => 'Offer Accepted',
            ],
            [
                'value' => 'offer_declined',
                'label' => 'Offer Declined',
            ],
            [
                'value' => 'rejected',
                'label' => 'Rejected',
            ],
            [
                'value' => 'withdrawn',
                'label' => 'Withdrawn',
            ],
        ];

        return inertia('Applications/Create', [
            'statusFilters' => $statusFilters,
        ]);
    }

    public function store(ApplicationRequest $request): RedirectResponse
    {
        $application = $request->user()->applications()->create($request->all());

        ApplicationAction::query()->create([
            'user_id' => $request->user()->id,
            'application_id' => $application->id,
            'title' => $request->input('status') === 'need_to_apply' ? 'Needs to Apply' : 'Applied',
            'new_status' => $request->input('status'),
        ]);

        return redirect()->route('application.show', $application);
    }

    public function show(Application $application): Response
    {
        $application->load('actions');

        $statusFilters = [
            [
                'value' => null,
                'label' => 'All',
            ],
            [
                'value' => 'need_to_apply',
                'label' => 'Need to Apply',
            ],
            [
                'value' => 'applied',
                'label' => 'Applied',
            ],
            [
                'value' => 'in_review',
                'label' => 'In Review',
            ],
            [
                'value' => 'coding_challenge',
                'label' => 'Coding Challenge',
            ],
            [
                'value' => 'interview_scheduled',
                'label' => 'Interview Scheduled',
            ],
            [
                'value' => 'interviewed',
                'label' => 'Interviewed',
            ],
            [
                'value' => 'offer_extended',
                'label' => 'Offer Extended',
            ],
            [
                'value' => 'offer_accepted',
                'label' => 'Offer Accepted',
            ],
            [
                'value' => 'offer_declined',
                'label' => 'Offer Declined',
            ],
            [
                'value' => 'rejected',
                'label' => 'Rejected',
            ],
            [
                'value' => 'withdrawn',
                'label' => 'Withdrawn',
            ],
        ];

        return inertia('Applications/Show', [
            'application' => $application,
            'statusFilters' => $statusFilters,
        ]);
    }

    public function update(ApplicationRequest $request, Application $application): RedirectResponse
    {
        $application->update($request->all());

        return back();
    }

    public function destroy(Application $application): RedirectResponse
    {
        $application->delete();

        return to_route('application.index');
    }
}
