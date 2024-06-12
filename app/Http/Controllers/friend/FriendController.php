<?php

namespace App\Http\Controllers\friend;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestFriendResource;
use App\Http\Resources\RequestFriendResource as ResourcesRequestFriendResource;
use App\Models\Friend;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        
        $friends = Friend::with(['requester'])->get();
        return response()->json([
            'data' => ResourcesRequestFriendResource::collection($friends),
        ], 200);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Friend::store($request);
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'Friend request successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
