<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'location',
    ];

    protected $appends = [
        'initials',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getInitialsAttribute(): string
    {
        return collect([
            $this->first_name,
            $this->last_name,
        ])->map(function ($name) {
            return strtoupper($name[0]);
        })->implode('');
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
