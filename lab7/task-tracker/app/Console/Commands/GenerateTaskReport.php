<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class GenerateTaskReport extends Command
{
    protected $signature = 'tasks:report {--project_id= : ID проєкту для фільтрації задач}';
    protected $description = 'Генерація табличного звіту по всіх або конкретних задачах';

    public function handle()
    {
        // Отримуємо значення опції project_id
        $projectId = $this->option('project_id');

        // Побудова запиту до бази даних
        $query = Task::query();

        //  Фільтрація
        if ($projectId) {
            $query->where('project_id', $projectId);
            $this->info("Створення звіту для проєкту ID: {$projectId}");
        } else {
            $this->info("Загальний звіт по всіх задачах системи");
        }

        $tasks = $query->get(['id', 'title', 'status', 'due_date']);

        // Обробка ситуації, коли задач немає
        if ($tasks->isEmpty()) {
            // Вивід попередження
            $this->warn("У системі немає задач, що відповідають вашому запиту.");
            return;
        }

        // Заголовки для таблиці
        $headers = ['ID', 'Назва', 'Статус', 'Дедлайн'];

        // Вивід даних
        $this->table($headers, $tasks->toArray());
    }
}
