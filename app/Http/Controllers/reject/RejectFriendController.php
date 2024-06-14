<?php

namespace App\Http\Controllers\reject;

use App\Http\Controllers\Controller;
use App\Http\Resources\reject\RejectFriendResource;
use App\Models\UserRejectFriend;
use Illuminate\Http\Request;

class RejectFriendController extends Controller
{
    
    public function index()
    {
        $friends = UserRejectFriend::with('reject')->get();
        return response()->json([
            'data' => RejectFriendResource::collection($friends),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        UserRejectFriend::store($request);
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'Friend has rejected'
        ], 200);
    }

    
    /**
     * Display the specified resource.
     */
    public function showByUserId(int $userId)
    {
        $rejectFriend = UserRejectFriend::where('user_id', $userId)->get();
    
        return response()->json([
            'data' => $rejectFriend,
        ], 200);
    }
}
