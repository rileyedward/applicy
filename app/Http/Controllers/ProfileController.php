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

        return inertia('Profile/Index', [
            'educationExperiences' => $user->educationExperiences,
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

        return back();
    }
}
