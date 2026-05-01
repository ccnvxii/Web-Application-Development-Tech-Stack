<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Events\TaskCreated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        return response()->json(Task::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:new,in_progress,done', // Вимога лаби
            'project_id'  => 'required|exists:projects,id',
            'assignee_id' => 'nullable|exists:users,id',
            'due_date'    => 'nullable|date',
        ]);

        $task = Task::create($validated);

        // Виклик події (Крок 3)
        event(new TaskCreated($task));

        return response()->json($task, 201);
    }

    public function show(Task $task) {
        return response()->json($task);
    }

    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'title'  => 'string|max:255',
            'status' => 'in:new,in_progress,done',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    public function destroy(Task $task) {
        $task->delete();
        return response()->json(null, 204);
    }
}
