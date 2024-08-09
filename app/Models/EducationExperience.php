<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationExperience extends Model
{
    use HasFactory;

    protected $table = 'education_experiences';

    protected $fillable = [
        'user_id',
        'institution_name',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
