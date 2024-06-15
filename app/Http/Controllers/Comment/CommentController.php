<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // /
    //  * Display a listing of the resource.
    //  */
    public function index()
    {
        $comment = comment::list();
        // $comment = CommentResource::collection($comment);
        return response()->json(['success'=>true, 'comment'=>$comment], 200);

    }

    // /
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        $comment = comment::store($request);
        return response()->json(['success'=>true, 'message'=>'comment created successfully', 'comment'=>$comment], 200);
    }

    // /
    //  * Display the specified resource.
    //  */
    public function showByUserId(int $userId)
    {
        $comment = comment::where('user_id', $userId)->get();

        return response()->json([
            'comment' => $comment,
        ], 200);
    }

    // /
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, string $id)
    {
        $comment = comment::store($request, $id);
        return response()->json(['success'=>true, 'message'=>'comment update successfully', 'data'=>$comment], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Find the comment by its ID
    $comment = comment::find($id);

    // Check if the comment exists
    if (!$comment) {
        return response()->json(['success' => false, 'message' => 'Comment not found'], 404);
    }

    // Perform the delete operation
    $comment->delete();

    return response()->json(['success' => true, 'message' => 'Comment deleted successfully', 'data' => $comment], 200);
}

}
