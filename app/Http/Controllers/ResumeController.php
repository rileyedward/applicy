<?php

namespace App\Http\Controllers;

use App\Services\ResumeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class ResumeController extends Controller
{
    public function __construct(protected ResumeService $resumeService) {}

    public function index(Request $request): Response
    {
        return inertia('Resumes/Index');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,txt'],
        ]);

        try {
            $this->resumeService->uploadResume(
                $request->user(),
                $request->input('title'),
                $request->file('file')->get(),
            );
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back();
    }
}
