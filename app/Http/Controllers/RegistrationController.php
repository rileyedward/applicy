<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\AuthenticationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class RegistrationController extends Controller
{
    public function __construct(protected AuthenticationService $authenticationService) {}

    public function index(): Response
    {
        return inertia('Register/Index');
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $user = $this->authenticationService->registerUser(
            $request->input('first_name'),
            $request->input('middle_name'),
            $request->input('last_name'),
            $request->input('email'),
            $request->input('phone_number'),
            $request->input('location'),
            $request->input('password')
        );

        event(new Registered($user));
        auth()->login($user);

        $this->authenticationService->createStripeCustomer($user);

        return to_route('profile.index');
    }
}
