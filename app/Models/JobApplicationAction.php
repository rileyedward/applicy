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

    protected $appends = [
        'new_status_pretty',
        'last_update',
    ];

    public function jobApplication(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class);
    }

    public function getNewStatusPrettyAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->new_status));
    }

    public function getLastUpdateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
