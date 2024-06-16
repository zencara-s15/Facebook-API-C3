<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $posts = Post::where('user_id', $user_id)->get();
        // $posts = PostResource::collection($posts);
        return response()->json(['success' => true, 'data' => $posts], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::store($request);

        return response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post created successfully'
        ], 201);
    }

    public function showByPostId(Request $request, int $postId)
    {
        $user_id = $request->user()->id;
        $postRequest = Post::where('user_id', $user_id)->where('id', $postId)->first();

        // Check if the post exists
        if (!$postRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $postRequest
        ], 200);
    }



    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post = $post ? Post::store($request) : false;

        return $post ? response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post updated successfully',
        ], 200) : response()->json([
            'success' => false,
            'message' => 'Post not found with id ' . $id,
        ], 404);
    }
}
