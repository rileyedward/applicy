<?php

namespace App\Models;

use App\Traits\HasActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    use HasActions, HasFactory;

    protected $table = 'job_applications';

    protected $fillable = [
        'user_id',
        'job_url',
        'company_url',
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
        'ai_context_string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(JobApplicationAction::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function getStatusPrettyAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    public function getLastUpdateAttribute(): string
    {
        return $this->actions->sortByDesc('created_at')->first()->created_at->diffForHumans();
    }

    public function getAiContextStringAttribute(): string
    {
        return '(Job Application) '.$this->position.' at '.$this->company_name.' - '.$this->description;
    }
}
