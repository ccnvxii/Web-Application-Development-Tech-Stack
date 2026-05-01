<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class NotifyAssignee
{
    public function handle(TaskCreated $event): void {
        if ($event->task->assignee_id) {
            Log::info("Слухач подій: Користувачу {$event->task->assignee_id} призначено задачу '{$event->task->title}'");
        }
    }
}
