<?php

namespace App\Http\Controllers\accept;

use App\Http\Controllers\Controller;
use App\Http\Resources\accept\AcceptFriendResource;
use App\Models\UserAcceptFriend;
use Illuminate\Http\Request;

class AcceptFriendController extends Controller
{
    public function index()
    {
        $friends = UserAcceptFriend::with('accept')->get();
        return response()->json([
            'data' => AcceptFriendResource::collection($friends),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        UserAcceptFriend::store($request);
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'Friend accepted successfully'
        ], 200);
    }

    
    /**
     * Display the specified resource.
     */
    public function showByUserId(int $userId)
    {
        $friendAccept = UserAcceptFriend::where('user_id', $userId)->get();
    
        return response()->json([
            'data' => $friendAccept,
        ], 200);
    }
}
