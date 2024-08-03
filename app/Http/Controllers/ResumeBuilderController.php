<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class ResumeBuilderController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('ResumeBuilder/Index');
    }
}
