<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplicationAction extends Model
{
    use HasFactory;

    protected $table = 'job_application_actions';

    protected $fillable = [
        'job_application_id',
        'title',
        'previous_status',
        'new_status',
        'notes',
    ];

    public function jobApplication(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class);
    }
}
