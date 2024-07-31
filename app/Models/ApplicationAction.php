<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationAction extends Model
{
    protected $table = 'application_actions';

    protected $fillable = [
        'user_id',
        'application_id',
        'title',
        'previous_status',
        'new_status',
        'notes',
    ];

    public function getPreviousStatusAttribute($value): string
    {
        return ucfirst($value);
    }

    public function getNewStatusAttribute($value): string
    {
        return ucfirst($value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
