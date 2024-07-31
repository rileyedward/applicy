<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationExperienceRequest;
use App\Models\EducationExperience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class EducationExperienceController extends Controller
{
    public function index(Request $request): Response
    {
        $educationExperiences = $request->user()
            ->educationExperiences()
            ->orderBy('end_date', 'desc')
            ->get();

        return inertia('EducationExperience/Index', [
            'educationExperiences' => $educationExperiences,
        ]);
    }

    public function create(): Response
    {
        return inertia('EducationExperience/Create');
    }

    public function store(EducationExperienceRequest $request): RedirectResponse
    {
        $educationExperience = $request->user()->educationExperiences()->create($request->validated());

        return to_route('education-experience.show', $educationExperience);
    }

    public function show(EducationExperience $educationExperience): Response
    {
        return inertia('EducationExperience/Show', [
            'educationExperience' => $educationExperience,
        ]);
    }

    public function update(EducationExperienceRequest $request, EducationExperience $educationExperience): RedirectResponse
    {
        $educationExperience->update($request->validated());

        return back();
    }

    public function destroy(EducationExperience $educationExperience): RedirectResponse
    {
        $educationExperience->delete();

        return back();
    }
}
