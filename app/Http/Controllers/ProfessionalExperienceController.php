<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfessionalExperienceRequest;
use App\Models\ProfessionalExperience;
use App\Services\ProfessionalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfessionalExperienceController extends Controller
{
    public function __construct(protected ProfessionalService $professionalService) {}

    public function store(ProfessionalExperienceRequest $request): RedirectResponse
    {
        $this->professionalService->createProfessionalExperience(
            $request->user(),
            $request->input('position'),
            $request->input('company_name'),
            $request->input('location'),
            $request->input('start_date'),
            $request->input('end_date'),
            $request->input('description')
        );

        $request->session()->flash('message', 'Professional experience added successfully!');

        return back();
    }

    public function update(ProfessionalExperienceRequest $request, ProfessionalExperience $professionalExperience): RedirectResponse
    {
        Gate::authorize('isOwner', $professionalExperience);

        $this->professionalService->updateProfessionalExperience(
            $professionalExperience,
            $request->input('position'),
            $request->input('company_name'),
            $request->input('location'),
            $request->input('start_date'),
            $request->input('end_date'),
            $request->input('description')
        );

        $request->session()->flash('message', 'Professional experience updated successfully!');

        return back();
    }

    public function destroy(Request $request, ProfessionalExperience $professionalExperience): RedirectResponse
    {
        Gate::authorize('isOwner', $professionalExperience);

        $this->professionalService->deleteProfessionalExperience($professionalExperience);

        $request->session()->flash('message', 'Professional experience deleted successfully!');

        return back();
    }
}
