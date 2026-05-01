<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /**
         * Реєстрація спостерігача (Observer) для моделі Task
         * Дозволяє автоматично відстежувати події створення, оновлення та видалення задач
         */
        \App\Models\Task::observe(\App\Observers\TaskObserver::class);
    }
}
