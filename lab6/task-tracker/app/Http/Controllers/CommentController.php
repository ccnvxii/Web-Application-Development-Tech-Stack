<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Повертає список усіх коментарів
     */
    public function index() {
        return response()->json(Comment::all());
    }

    /**
     * Створює новий коментар до конкретної задачі
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create($validated);
        return response()->json($comment, 201);
    }

    /**
     * Повертає конкретний коментар за ID
     */
    public function show(Comment $comment) {
        return response()->json($comment);
    }

    /**
     * Оновлює вміст коментаря
     */
    public function update(Request $request, Comment $comment) {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);
        return response()->json($comment);
    }

    /**
     * Видаляє коментар із бази даних
     */
    public function destroy(Comment $comment) {
        $comment->delete();
        return response()->json(null, 204);
    }
}
