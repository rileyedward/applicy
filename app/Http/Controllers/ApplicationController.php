<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class ApplicationController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('Applications/Index', [
            'applications' => $request->user()->applications()->get(),
        ]);
    }

    public function create(): Response
    {
        return inertia('Applications/Create');
    }

    public function store(ApplicationRequest $request): RedirectResponse
    {
        $application = $request->user()->applications()->create($request->all());

        return redirect()->route('application.show', $application);
    }

    public function show(Application $application): Response
    {
        return inertia('Applications/Show', [
            'application' => $application,
        ]);
    }

    public function update(ApplicationRequest $request, Application $application): RedirectResponse
    {
        $application->update($request->all());

        return back();
    }

    public function destroy(Application $application): RedirectResponse
    {
        $application->delete();

        return back();
    }
}
