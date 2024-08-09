<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(
            Skill::class,
            'education_skills',
            'education_experience_id',
            'skill_id'
        )->withPivot('id');
    }
}
