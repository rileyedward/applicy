<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationExperienceRequest;
use App\Models\EducationExperience;
use App\Services\EducationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        $request->session()->flash('message', 'Education experience added successfully!');

        return back();
    }

    public function update(EducationExperienceRequest $request, EducationExperience $educationExperience): RedirectResponse
    {
        Gate::authorize('isOwner', $educationExperience);

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

        $request->session()->flash('message', 'Education experience updated successfully!');

        return back();
    }

    public function destroy(Request $request, EducationExperience $educationExperience): RedirectResponse
    {
        $this->educationService->deleteEducationExperience($educationExperience);

        $request->session()->flash('message', 'Education experience deleted successfully!');

        return back();
    }
}
