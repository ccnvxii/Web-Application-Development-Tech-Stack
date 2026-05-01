<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        return response()->json(Project::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Вимога лаби
            'description' => 'nullable|string',
        ]);
        return response()->json(Project::create($validated), 201);
    }

    public function show(Project $project) {
        return response()->json($project);
    }

    public function update(Request $request, Project $project) {
        $validated = $request->validate([
            'name' => 'string|max:255',
        ]);
        $project->update($validated);
        return response()->json($project);
    }

    public function destroy(Project $project) {
        $project->delete();
        return response()->json(null, 204);
    }
}
