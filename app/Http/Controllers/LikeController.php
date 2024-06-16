<?php

namespace App\Http\Controllers;

use App\Http\Resources\Like\LikeResource;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index($postId)
    {
        $likes = Like::where('post_id', $postId)->with('user')->get();
        return response()->json([
            'data' => LikeResource::collection($likes),
        ], 200);
    }

    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        $post_id = $request->input('post_id');
        $like = $request->input('like_id');

        $likeRecord = Like::create([
            'user_id' => $user_id, 
            'post_id' => $post_id,
            'like_id' => $like
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Like created successfully',
            'data' => new LikeResource($likeRecord),
        ], 200);
    }
}
