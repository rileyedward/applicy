<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkExperienceRequest;
use App\Models\WorkExperience;
use Illuminate\Http\RedirectResponse;

class WorkExperienceController extends Controller
{
    public function store(WorkExperienceRequest $request): RedirectResponse
    {
        $request->user()->workExperiences()->create($request->validated());

        return back();
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
