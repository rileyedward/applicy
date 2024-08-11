<?php

namespace App\Http\Controllers;

use App\Models\CoverLetterTemplate;
use App\Services\CoverLetterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class CoverLetterController extends Controller
{
    public function __construct(protected CoverLetterService $coverLetterService) {}

    public function index(Request $request): Response
    {
        $coverLetterTemplates = $request->user()->coverLetterTemplates;

        return inertia('CoverLetters/Index', [
            'coverLetterTemplates' => $coverLetterTemplates,
        ]);
    }

    public function create(Request $request): Response
    {
        return inertia('CoverLetters/Create');
    }

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

        return to_route('cover-letter.index');
    }

    public function show(Request $request, CoverLetterTemplate $coverLetterTemplate): Response
    {
        Gate::authorize('isOwner', $coverLetterTemplate);

        return inertia('CoverLetters/Show', [
            'coverLetterTemplate' => $coverLetterTemplate,
        ]);
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

        return to_route('cover-letter.index');
    }
}
