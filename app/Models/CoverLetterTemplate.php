<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoverLetterTemplate extends Model
{
    use HasFactory;

    protected $table = 'cover_letter_templates';

    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    protected $appends = [
        'ai_context_string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAiContextStringAttribute(): string
    {
        return '(Cover Letter Template) '.$this->title.' - '.$this->body;
    }
}
