<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'user_id',
        'job_url',
        'position',
        'company_name',
        'location',
        'environment',
        'description',
        'status',
        'contact_name',
        'contact_email',
        'contact_phone',
        'interview_date',
        'interview_time',
    ];

    public function getEnvironmentAttribute($value): string
    {
        return ucfirst($value);
    }

    public function getStatusAttribute($value): string
    {
        return ucfirst($value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(ApplicationAction::class)->orderBy('created_at', 'desc');
    }
}
