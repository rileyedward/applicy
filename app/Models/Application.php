<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
