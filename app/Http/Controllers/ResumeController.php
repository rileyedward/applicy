<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Services\ResumeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResumeController extends Controller
{
    public function __construct(protected ResumeService $resumeService) {}

    public function index(Request $request): Response
    {
        $resumes = $request->user()->resumes;

        return inertia('Resumes/Index', [
            'resumes' => $resumes,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        $slug = str()->slug($request->title);
        $filepath = storage_path('app/public/resumes/'.$slug.'.pdf');

        Storage::put($filepath, $request->file('file')->getContent());

        $this->resumeService->createResume(
            $request->user(),
            $request->title,
            $slug,
            $filepath
        );

        return back();
    }

    public function download(Resume $resume): StreamedResponse
    {
        Gate::authorize('isOwner', $resume);

        $filepath = storage_path('app/public/resumes/'.$resume->slug.'.pdf');

        return Storage::download($filepath);
    }
}
