<?php

namespace App\Models;

use App\Traits\HasActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    use HasFactory, HasActions;

    protected $table = 'job_applications';

    protected $fillable = [
        'user_id',
        'job_url',
        'position',
        'company_name',
        'location',
        'environment',
        'salary_range',
        'contact_name',
        'contact_email',
        'contact_phone',
        'description',
        'notes',
        'status',
    ];

    protected $appends = [
        'status_pretty',
        'last_update',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(JobApplicationAction::class);
    }

    public function getStatusPrettyAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    public function getLastUpdateAttribute(): string
    {
        // TODO: come back to this later once actions are implemented
        return $this->updated_at->diffForHumans();
    }
}
