<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class ApplicationController extends Controller
{
    public function index(Request $request): Response
    {
        $applications = $request->user()->applications()->get();

        $statusFilters = [
            [
                'value' => null,
                'label' => 'All',
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

        logger($locationFilters);

        return inertia('Applications/Index', [
            'applications' => $applications,
            'statusFilters' => $statusFilters,
            'environmentFilters' => $environmentFilters,
            'locationFilters' => $locationFilters,
        ]);
    }

    public function create(): Response
    {
        return inertia('Applications/Create');
    }

    public function store(ApplicationRequest $request): RedirectResponse
    {
        $application = $request->user()->applications()->create($request->all());

        return redirect()->route('application.show', $application);
    }

    public function show(Application $application): Response
    {
        return inertia('Applications/Show', [
            'application' => $application,
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
