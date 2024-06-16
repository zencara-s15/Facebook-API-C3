<?php
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::list();
        // $posts = PostResource::collection($posts);
        return response()->json(['success' => true, 'data' => $posts], 200);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::store($request);

        return response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post created successfully'
        ], 201);
    }

    public function showByPostId(int $postId) {
        $postRequests = Post::where('user_id', $postId)->get();
        return response()->json(['data' => $postRequests], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'post_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('post_image')) {
            // Delete the old image if it exists
            if ($post->post_image) {
                Storage::disk('public')->delete($post->post_image);
            }

            // Store the new image
            $imageName = time() . '.' . $request->post_image->extension();
            $request->post_image->storeAs('images', $imageName, 'public');
            $validatedData['post_image'] = 'images/' . $imageName;
        }

        $post->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post updated successfully',
        ], 200);
    }
}
