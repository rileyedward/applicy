<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationExperienceRequest;
use App\Models\EducationExperience;
use Illuminate\Http\RedirectResponse;

class EducationExperienceController extends Controller
{
    public function store(EducationExperienceRequest $request): RedirectResponse
    {
        $request->user()->educationExperiences()->create($request->validated());

        return back();
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
