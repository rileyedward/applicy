<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationSkill extends Model
{
    use HasFactory;

    protected $table = 'education_skill';

    protected $fillable = [
        'education_experience_id',
        'skill_id',
    ];

    public function educationExperience(): BelongsTo
    {
        return $this->belongsTo(EducationExperience::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
