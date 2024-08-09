<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'stripe_id',
        'amount',
        'tokens_purchased',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
