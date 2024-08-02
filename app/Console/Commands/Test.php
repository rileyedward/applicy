<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\ApplicationAction;
use App\Models\User;
use Illuminate\Console\Command;

class Test extends Command
{
    protected $signature = 'app:test';

    protected $description = 'Used as a scratch pad for testing code.';

    public function handle(): void
    {
        $user = User::query()->where('id', 1)->first();

        $applications = Application::query()
            ->where('user_id', $user->id)
            ->whereDoesntHave('actions')
            ->get();

        foreach ($applications as $application) {
            ApplicationAction::query()->create([
                'user_id' => $user->id,
                'application_id' => $application->id,
                'title' => $application->status === 'need_to_apply' ? 'Needs to Apply' : 'Applied',
                'new_status' => $application->status,
            ]);
        }
    }
}
