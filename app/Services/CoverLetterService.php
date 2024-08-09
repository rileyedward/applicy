<?php

namespace App\Services;

use App\Models\CoverLetterTemplate;
use App\Models\User;

class CoverLetterService
{
    public function createCoverLetterTemplate(User $user, string $title, string $body): CoverLetterTemplate
    {
        return CoverLetterTemplate::query()->create([
            'user_id' => $user->id,
            'title' => $title,
            'body' => $body,
        ]);
    }

    public function updateCoverLetterTemplate(CoverLetterTemplate $coverLetterTemplate, string $title, string $body): CoverLetterTemplate
    {
        $coverLetterTemplate->update([
            'title' => $title,
            'body' => $body,
        ]);

        return $coverLetterTemplate;
    }

    public function deleteCoverLetterTemplate(CoverLetterTemplate $coverLetterTemplate): void
    {
        $coverLetterTemplate->delete();
    }
}
