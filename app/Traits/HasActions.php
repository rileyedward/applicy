<?php

namespace App\Traits;

use App\Models\JobApplicationAction;

trait HasActions
{
    public function addAction(
        string $title,
        string $newStatus,
        ?string $notes = null,
    ): JobApplicationAction {
        return JobApplicationAction::query()->create([
            'job_application_id' => $this->id,
            'title' => $title,
            'previous_status' => $this->status ?? null,
            'new_status' => $newStatus,
            'notes' => $notes,
        ]);
    }
}
