<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class ResumeBuilderController extends Controller
{
    public function index(Request $request): Response
    {
        $educationExperiences = $request->user()
            ->educationExperiences()
            ->orderBy('end_date', 'desc')
            ->get();

        $workExperiences = $request->user()
            ->workExperiences()
            ->orderBy('end_date', 'desc')
            ->get();

        $portfolioProjects = $request->user()
            ->portfolioProjects()
            ->get();

        return inertia('ResumeBuilder/Index', [
            'educationExperiences' => $educationExperiences,
            'workExperiences' => $workExperiences,
            'portfolioProjects' => $portfolioProjects,
        ]);
    }
}
