<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\User;

class ResumeService
{
    public function createResume(
        User $user,
        string $title,
        string $slug,
        string $file,
    ): Resume {
        return Resume::query()->create([
            'user_id' => $user->id,
            'title' => $title,
            'slug' => $slug,
            'file' => $file,
        ]);
    }
}
