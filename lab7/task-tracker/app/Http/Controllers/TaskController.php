<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Events\TaskCreated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Повертає список усіх завдань.
     */
    public function index() {
        return response()->json(Task::all());
    }

    /**
     * Створює нове завдання з валідацією та викликом події.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:new,in_progress,done',
            'project_id'  => 'required|exists:projects,id',
            'assignee_id' => 'nullable|exists:users,id',
            'due_date'    => 'nullable|date',
            'author_id'   => 'required|exists:users,id',
        ]);

        $task = Task::create($validated);

        event(new TaskCreated($task));

        return response()->json($task, 201);
    }

    /**
     * Повертає конкретне завдання за ID.
     */
    public function show(Task $task) {
        return response()->json($task);
    }

    /**
     * Оновлює дані завдання .
     */
    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'title'  => 'string|max:255',
            'status' => 'in:new,in_progress,done',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    /**
     * Видаляє завдання з бази даних.
     */
    public function destroy(Task $task) {
        $task->delete();
        return response()->json(null, 204);
    }
}
