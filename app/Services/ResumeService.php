<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ResumeService
{
    public function uploadResume(
        User $user,
        string $title,
        string $file,
    ): Resume {
        $slug = str()->slug($title);
        $filepath = storage_path('app/public/resumes/'.$slug);

        File::put($filepath, $file);

        return $this->createResume(
            $user,
            $title,
            $slug,
            $filepath,
        );
    }

    protected function createResume(
        User $user,
        string $title,
        string $slug,
        string $filepath,
    ): Resume {
        return Resume::query()->create([
            'user_id' => $user->id,
            'title' => $title,
            'slug' => $slug,
            'file' => $filepath,
        ]);
    }
}
