<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Events\TaskCreated;

class CreateTaskInteractive extends Command
{
    protected $signature = 'tasks:create-interactive';
    protected $description = 'Інтерактивний майстер створення нової задачі';

    public function handle()
    {
        //Збір даних через інтерактивні запитання
        $title = $this->ask('Введіть назву задачі');
        $description = $this->ask('Введіть короткий опис (можна залишити порожнім)');
        $dueDate = $this->ask('Дата дедлайну (формат YYYY-MM-DD)');

        // Вибір статусу зі списку варіантів
        $status = $this->choice(
            'Оберіть статус задачі',
            ['new', 'in_progress', 'done'],
            0
        );

        $assigneeId = $this->ask('Введіть ID виконавця (assignee_id)');
        $projectId = $this->ask('Введіть ID проєкту (project_id)');
        $authorId = $this->ask('Введіть ID автора (author_id)', 1);

        // Підтвердження операції
        $this->line("---");
        $this->info("Перевірте введені дані:");
        $this->line("Назва: {$title}");
        $this->line("Проєкт ID: {$projectId}");
        $this->line("Статус: {$status}");

        if ($this->confirm('Бажаєте створити цю задачу?', true)) {
            // Створення запису в базі даних
            $task = Task::create([
                'title'       => $title,
                'description' => $description,
                'due_date'    => $dueDate,
                'status'      => $status,
                'project_id'  => $projectId,
                'assignee_id' => $assigneeId,
                'author_id'   => $authorId,
            ]);

            /**
             * Виклик події TaskCreated активує Listener та Observer.
             */
            event(new TaskCreated($task));

            // Повідомлення про успіх
            $this->info("Задача '{$task->title}' успішно створена з ID: {$task->id}");
        } else {
            $this->warn("Створення задачі скасовано.");
        }
    }
}
