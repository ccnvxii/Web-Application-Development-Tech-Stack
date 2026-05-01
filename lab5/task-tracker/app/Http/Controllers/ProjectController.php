<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Отримання списку проектів
    public function index()
    {
        return response()->json(Project::with('user')->get());
    }

    // Створення проекту
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $project = Project::create($validated);
        return response()->json($project, 201);
    }
}
