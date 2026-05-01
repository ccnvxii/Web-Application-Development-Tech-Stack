<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCreated
{
    use Dispatchable, SerializesModels;

    /**
     * Створення екземпляра події.
     *
     * @param Task $task Об'єкт створеної задачі.
     */
    public function __construct(public Task $task) {}
}
