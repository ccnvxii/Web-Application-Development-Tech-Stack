<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Повертає список усіх користувачів.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Створює нового користувача.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Хешуємо пароль перед збереженням
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    /**
     * Повертає дані конкретного користувача за ID.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Оновлює дані користувача.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);
        return response()->json($user);
    }

    /**
     * Видаляє користувача.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
