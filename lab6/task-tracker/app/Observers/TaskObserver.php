<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    public function created(Task $task): void {
        Log::info("Автоматичний лог: Створено задачу ID {$task->id} ('{$task->title}')");
    }

    public function updated(Task $task): void {
        Log::info("Автоматичний лог: Оновлено задачу ID {$task->id}");
    }

    public function deleted(Task $task): void {
        Log::warning("Автоматичний лог: Видалено задачу ID {$task->id}");
    }
}
