<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Додаємо маршрут для проектів
Route::apiResource('projects', ProjectController::class);
