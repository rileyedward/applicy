<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalSkill extends Model
{
    use HasFactory;

    protected $table = 'professional_skill';

    protected $fillable = [
        'professional_experience_id',
        'skill_id',
    ];

    public function professionalExperience(): BelongsTo
    {
        return $this->belongsTo(ProfessionalExperience::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
