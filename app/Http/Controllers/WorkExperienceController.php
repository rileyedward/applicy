<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkExperienceRequest;
use App\Models\WorkExperience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class WorkExperienceController extends Controller
{
    public function index(Request $request): Response
    {
        $workExperiences = $request->user()
            ->workExperiences()
            ->orderBy('end_date', 'desc')
            ->get();

        return inertia('WorkExperience/Index', [
            'workExperiences' => $workExperiences,
        ]);
    }

    public function create(): Response
    {
        return inertia('WorkExperience/Create');
    }

    public function store(WorkExperienceRequest $request): RedirectResponse
    {
        $workExperience = $request->user()->workExperiences()->create($request->validated());

        return to_route('work-experience.show', $workExperience);
    }

    public function show(WorkExperience $workExperience): Response
    {
        return inertia('WorkExperience/Show', [
            'workExperience' => $workExperience,
        ]);
    }

    public function update(WorkExperienceRequest $request, WorkExperience $workExperience): RedirectResponse
    {
        $workExperience->update($request->validated());

        return back();
    }

    public function destroy(WorkExperience $workExperience): RedirectResponse
    {
        $workExperience->delete();

        return back();
    }
}
