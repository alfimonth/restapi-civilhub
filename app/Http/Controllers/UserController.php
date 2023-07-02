<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'photo' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create a new user based on the validated data
        $user = User::create($validatedData);

        // If user creation fails, return an error response
        if (!$user) {
            return response()->json(['error' => 'Failed to create user'], 500);
        }

        // Return the created user as a JSON response
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Find the user with the given ID
        $user = User::findOrFail($id);

        // Update the fields based on the request data
        $user->update($request->all());

        // Return the updated user as a JSON response
        return response()->json($user);
    }

    public function destroy($id)
    {
        // Find the user with the given ID and delete it
        // ...
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
