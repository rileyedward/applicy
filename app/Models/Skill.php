<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function educationExperiences(): BelongsToMany
    {
        return $this->belongsToMany(
            EducationExperience::class,
            'education_skills',
            'skill_id',
            'education_experience_id'
        )->withPivot('id');
    }

    public function professionalExperiences(): BelongsToMany
    {
        return $this->belongsToMany(
            ProfessionalExperience::class,
            'professional_skill',
            'skill_id',
            'professional_experience_id'
        )->withPivot('id');
    }

    public function portfolioProjects(): BelongsToMany
    {
        return $this->belongsToMany(
            PortfolioProject::class,
            'project_skill',
            'skill_id',
            'portfolio_project_id'
        )->withPivot('id');
    }
}
