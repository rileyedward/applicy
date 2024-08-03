<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioProjectRequest;
use App\Models\PortfolioProject;
use Illuminate\Http\RedirectResponse;

class PortfolioProjectController extends Controller
{
    public function store(PortfolioProjectRequest $request): RedirectResponse
    {
        $request->user()->portfolioProjects()->create($request->all());

        return back();
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
