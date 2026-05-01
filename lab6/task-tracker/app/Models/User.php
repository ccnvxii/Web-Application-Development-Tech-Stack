<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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
        ];
    }

    /**
     * Зв'язки для Лабораторної роботи №5
     */

    // Користувач має багато проектів
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // Користувач може бути автором багатьох завдань
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'author_id');
    }

    // Користувач може залишати багато коментарів
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
