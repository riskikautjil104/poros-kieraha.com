<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'email_verification_token',
        'email_verification_token_expires_at',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'email_verification_token_expires_at' => 'datetime',
            'is_verified' => 'boolean',
        ];
    }

    // Relationships
    public function news()
    {
        return $this->hasMany(News::class);
    }

    // Helper Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPenulis()
    {
        return $this->role === 'penulis';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    // Avatar Accessor
    public function getAvatarUrlAttribute()
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('assets/img/default-avatar.png');
    }
}
