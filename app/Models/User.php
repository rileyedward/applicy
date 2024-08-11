<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'location',
        'password',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'tokens',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'initials'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getInitialsAttribute(): string
    {
        return ucfirst($this->first_name[0].$this->last_name[0]);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function educationExperiences(): HasMany
    {
        return $this->hasMany(EducationExperience::class);
    }

    public function professionalExperiences(): HasMany
    {
        return $this->hasMany(ProfessionalExperience::class);
    }

    public function portfolioProjects(): HasMany
    {
        return $this->hasMany(PortfolioProject::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }

    public function coverLetterTemplates(): HasMany
    {
        return $this->hasMany(CoverLetterTemplate::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function buildAIContextString(): string
    {
        return '(User) ' . $this->first_name . ' ' . $this->last_name . ' - ' . $this->email . ' - ' . $this->phone_number . ', located in ' . $this->location;
    }
}
