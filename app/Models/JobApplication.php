<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    use HasFactory;

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
        'applied_at',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(JobApplicationAction::class);
    }
}
