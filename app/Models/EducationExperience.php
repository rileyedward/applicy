<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationExperience extends Model
{
    protected $table = 'education_experiences';

    protected $fillable = [
        'user_id',
        'degree',
        'field_of_study',
        'institution_name',
        'location',
        'start_date',
        'end_date',
        'description',
        'skills',
    ];

    public function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
