<?php

namespace App\Http\Controllers;

use App\Models\CoverLetterTemplate;
use App\Services\CoverLetterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CoverLetterController extends Controller
{
    public function __construct(protected CoverLetterService $coverLetterService) {}

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);

        $this->coverLetterService->createCoverLetterTemplate(
            $request->user(),
            $request->input('title'),
            $request->input('body')
        );

        return back();
    }

    public function update(Request $request, CoverLetterTemplate $coverLetterTemplate): RedirectResponse
    {
        Gate::authorize('isOwner', $coverLetterTemplate);

        $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);

        $this->coverLetterService->updateCoverLetterTemplate(
            $coverLetterTemplate,
            $request->input('title'),
            $request->input('body')
        );

        return back();
    }

    public function destroy(Request $request, CoverLetterTemplate $coverLetterTemplate): RedirectResponse
    {
        Gate::authorize('isOwner', $coverLetterTemplate);

        $this->coverLetterService->deleteCoverLetterTemplate($coverLetterTemplate);

        return back();
    }
}
