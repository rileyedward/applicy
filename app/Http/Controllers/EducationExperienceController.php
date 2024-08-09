<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationExperienceRequest;
use App\Models\EducationExperience;
use App\Services\EducationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationExperienceController extends Controller
{
    public function __construct(protected EducationService $educationService) {}

    public function store(EducationExperienceRequest $request): RedirectResponse
    {
        $this->educationService->createEducationExperience(
            $request->user(),
            $request->input('institution_name'),
            $request->input('location'),
            $request->input('degree'),
            $request->input('field_of_study'),
            $request->input('start_date'),
            $request->input('end_date'),
            $request->input('description')
        );

        return back();
    }

    public function update(EducationExperienceRequest $request, EducationExperience $educationExperience): RedirectResponse
    {
        $this->educationService->updateEducationExperience(
            $educationExperience,
            $request->input('institution_name'),
            $request->input('location'),
            $request->input('degree'),
            $request->input('field_of_study'),
            $request->input('start_date'),
            $request->input('end_date'),
            $request->input('description')
        );

        return back();
    }

    public function destroy(Request $request, EducationExperience $educationExperience): RedirectResponse
    {
        $this->educationService->deleteEducationExperience($educationExperience);

        return back();
    }
}
