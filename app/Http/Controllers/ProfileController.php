<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService) {}

    public function index(Request $request): Response
    {
        $user = $request->user();

        $educationExperiences = $user->educationExperiences()->orderBy('end_date', 'desc')->get();
        $professionalExperiences = $user->professionalExperiences()->orderBy('end_date', 'desc')->get();
        $portfolioProjects = $user->portfolioProjects()->orderBy('created_at', 'desc')->get();

        return inertia('Profile/Index', [
            'educationExperiences' => $educationExperiences,
            'professionalExperiences' => $professionalExperiences,
            'portfolioProjects' => $portfolioProjects,
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $this->profileService->updateProfile(
            $request->user(),
            $request->input('first_name'),
            $request->input('middle_name'),
            $request->input('last_name'),
            $request->input('email'),
            $request->input('phone_number'),
            $request->input('location')
        );

        $request->session()->flash('message', 'Profile updated successfully!');

        return back();
    }
}
