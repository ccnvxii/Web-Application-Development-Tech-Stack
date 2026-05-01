<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'project_id',
        'author_id',
        'assigned_to',
        'due_date'
    ];

    // Завдання належить проекту
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Завдання має багато коментарів
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
