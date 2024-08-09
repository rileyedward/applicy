<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioProjectRequest;
use App\Models\PortfolioProject;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PortfolioProjectController extends Controller
{
    public function __construct(protected PortfolioService $portfolioService) {}

    public function store(PortfolioProjectRequest $request): RedirectResponse
    {
        $this->portfolioService->createPortfolioProject(
            $request->user(),
            $request->input('name'),
            $request->input('url'),
            $request->input('description')
        );

        return back();
    }

    public function update(PortfolioProjectRequest $request, PortfolioProject $portfolioProject): RedirectResponse
    {
        Gate::authorize('isOwner', $portfolioProject);

        $this->portfolioService->updatePortfolioProject(
            $portfolioProject,
            $request->input('name'),
            $request->input('url'),
            $request->input('description')
        );

        return back();
    }

    public function destroy(Request $request, PortfolioProject $portfolioProject): RedirectResponse
    {
        Gate::authorize('isOwner', $portfolioProject);

        $this->portfolioService->deletePortfolioProject($portfolioProject);

        return back();
    }
}
