<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PortfolioProject extends Model
{
    use HasFactory;

    protected $table = 'portfolio_projects';

    protected $fillable = [
        'user_id',
        'name',
        'url',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'project_skill', 'portfolio_project_id', 'skill_id');
    }

    public function buildAIContextString(): string
    {
        return '(Portfolio) - '.$this->name.' '.$this->description;
    }
}
