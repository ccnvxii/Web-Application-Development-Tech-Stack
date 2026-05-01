<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class NotifyAssignee
{
    public function handle(TaskCreated $event): void
    {
        // Перевіряє чи призначено виконавця для цієї задачі
        if ($event->task->assignee_id) {
            // Записуєінформацію про сповіщення в системний лог (storage/logs/laravel.log)
            Log::info("Користувачу {$event->task->assignee_id} призначено задачу '{$event->task->title}'");
        }
    }
}
