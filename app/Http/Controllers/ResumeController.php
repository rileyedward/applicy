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
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        $slug = str()->slug($validatedData['title']);
        $filename = $slug.'.pdf';

        $filepath = $request->file('file')->storeAs('users/'.$request->user()->id.'/resumes', $filename, 'public');

        $this->resumeService->createResume(
            $request->user(),
            $validatedData['title'],
            $slug,
            $filepath
        );

        $request->session()->flash('message', 'Resume uploaded successfully!');

        return back()->with('success', 'File uploaded successfully!');
    }

    public function show(Resume $resume): Response
    {
        Gate::authorize('isOwner', $resume);

        return inertia('Resumes/Show', [
            'resume' => $resume,
        ]);
    }

    public function view(Resume $resume): StreamedResponse
    {
        Gate::authorize('isOwner', $resume);

        $filename = $resume->slug.'.pdf';
        $filepath = 'users/'.$resume->user_id.'/resumes/'.$filename;

        return Storage::disk('public')->response($filepath);
    }

    public function destroy(Request $request, Resume $resume): RedirectResponse
    {
        Gate::authorize('isOwner', $resume);

        $filename = $resume->slug.'.pdf';
        $filepath = 'users/'.$resume->user_id.'/resumes/'.$filename;

        Storage::disk('public')->delete($filepath);

        $resume->delete();

        return to_route('resumes.index');
    }
}
