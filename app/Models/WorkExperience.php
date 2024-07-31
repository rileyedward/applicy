<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkExperience extends Model
{
    protected $table = 'work_experiences';

    protected $fillable = [
        'user_id',
        'position',
        'company_name',
        'location',
        'start_date',
        'end_date',
        'description',
        'skills',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
