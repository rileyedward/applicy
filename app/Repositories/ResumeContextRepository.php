<?php

namespace App\Repositories;

use App\Models\Resume;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class ResumeContextRepository
{
    public function __construct(protected Resume $resume) {}

    public function buildContext(): string
    {
        return Cache::remember('resume_context_'.$this->resume->id, 60 * 60 * 24, function () {
            $filepath = $this->getFilePath();

            if (! Storage::disk('public')->exists($filepath)) {
                return '';
            }

            $fullPath = Storage::disk('public')->path($filepath);

            $parser = new Parser;
            $pdf = $parser->parseFile($fullPath);

            $text = $pdf->getText();

            return preg_replace('/\s+/', ' ', trim($text));
        });
    }

    protected function getFilePath(): string
    {
        $filename = $this->resume->slug.'.pdf';

        return 'users/'.$this->resume->user_id.'/resumes/'.$filename;
    }
}
