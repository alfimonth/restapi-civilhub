<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'id_user' => 'required',
            'content' => 'required',
            'image' => 'required',
            'is_anonymous' => 'required',
        ]);

        // Create a new post based on the validated data
        $post = Post::create($validatedData);

        // If post creation fails, return an error response
        if (!$post) {
            return response()->json(['error' => 'Failed to create post'], 500);
        }

        // Return the created post as a JSON response
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        // Find the post with the given ID
        $post = Post::findOrFail($id);

        // Update the fields based on the request data
        $post->update($request->all());

        // Return the updated post as a JSON response
        return response()->json($post);
    }

    public function destroy($id)
    {
        // Find the post with the given ID and delete it
        // ...
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
