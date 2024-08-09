<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class LoginController extends Controller
{
    public function index(): Response
    {
        return inertia('Login/Index');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return to_route('dashboard');
    }
}
