<?php

namespace App\Observers;

use App\Models\JobApplication;

class JobApplicationObserver
{
    /**
     * Handle the JobApplication "created" event.
     */
    public function created(JobApplication $jobApplication): void
    {
        //
    }

    /**
     * Handle the JobApplication "updated" event.
     */
    public function updated(JobApplication $jobApplication): void
    {
        //
    }

    /**
     * Handle the JobApplication "deleted" event.
     */
    public function deleted(JobApplication $jobApplication): void
    {
        //
    }

    /**
     * Handle the JobApplication "restored" event.
     */
    public function restored(JobApplication $jobApplication): void
    {
        //
    }

    /**
     * Handle the JobApplication "force deleted" event.
     */
    public function forceDeleted(JobApplication $jobApplication): void
    {
        //
    }
}
