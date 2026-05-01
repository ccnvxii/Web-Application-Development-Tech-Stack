<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Повертає список усіх проектів
     */
    public function index() {
        return response()->json(Project::all());
    }

    /**
     * Створює новий проект
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $project = Project::create($validated);
        return response()->json($project, 201);
    }

    /**
     * Повертає дані конкретного проекту за ID
     */
    public function show(Project $project) {
        return response()->json($project);
    }

    /**
     * Оновлює дані проекту
     */
    public function update(Request $request, Project $project) {
        $validated = $request->validate([
            'name' => 'string|max:255',
        ]);

        $project->update($validated);
        return response()->json($project);
    }

    /**
     * Видаляє проект із бази даних.
     */
    public function destroy(Project $project) {
        $project->delete();
        return response()->json(null, 204);
    }
}
