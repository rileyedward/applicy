<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProfessionalExperience extends Model
{
    use HasFactory;

    protected $table = 'professional_experiences';

    protected $fillable = [
        'position',
        'company_name',
        'location',
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
            'professional_skill',
            'professional_experience_id',
            'skill_id'
        )->withPivot('id');
    }
}
