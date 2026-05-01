<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['task_id', 'user_id', 'content'];

    // Коментар належить певному завданню
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    // Коментар належить певному користувачу
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
