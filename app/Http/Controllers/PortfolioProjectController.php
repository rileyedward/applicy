<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioProjectRequest;
use App\Models\PortfolioProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class PortfolioProjectController extends Controller
{
    public function index(Request $request): Response
    {
        $portfolioProjects = $request->user()
            ->portfolioProjects()
            ->get();

        return inertia('PortfolioProjects/Index', [
            'portfolioProjects' => $portfolioProjects,
        ]);
    }

    public function create(): Response
    {
        return inertia('PortfolioProjects/Create');
    }

    public function store(PortfolioProjectRequest $request): RedirectResponse
    {
        $portfolioProject = $request->user()->portfolioProjects()->create($request->all());

        return redirect()->route('portfolio-project.show', $portfolioProject);
    }

    public function show(PortfolioProject $portfolioProject): Response
    {
        return inertia('PortfolioProjects/Show', [
            'portfolioProject' => $portfolioProject,
        ]);
    }

    public function update(PortfolioProjectRequest $request, PortfolioProject $portfolioProject): RedirectResponse
    {
        $portfolioProject->update($request->all());

        return back();
    }

    public function destroy(PortfolioProject $portfolioProject): RedirectResponse
    {
        $portfolioProject->delete();

        return back();
    }
}
