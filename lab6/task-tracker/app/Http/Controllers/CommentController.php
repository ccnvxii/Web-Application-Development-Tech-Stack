<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id', // Вимога лаби
            'content' => 'required|string|max:1000',
        ]);
        return response()->json(Comment::create($validated), 201);
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return response()->json(null, 204);
    }
}
