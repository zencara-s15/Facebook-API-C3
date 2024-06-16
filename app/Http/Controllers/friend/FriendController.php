<?php

namespace App\Http\Controllers\friend;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestFriendResource;
use App\Http\Resources\RequestFriendResource as ResourcesRequestFriendResource;
use App\Models\Friend;
use Dotenv\Validator;
use Illuminate\Http\Request;

class FriendController extends Controller
{

    // get friend that we have 
    public function friendList(Request $request)
    {
        $user_id = $request->user()->id;
        $friends = Friend::friendList($user_id);

        return response()->json([
            'success' => true,
            'friends' => $friends
        ], 200);
    }

    public function sendFriendRequest(Request $request)
    {
        $friend = Friend::sendFriendRequest($request, ['status' => 'pending']);
        return response()->json([
            'success' => true,
            'data' => $friend,
            'message' => 'Friend request sent successfully'
        ], 200);
    }

    public function getFriendRequest(Request $request)
    {
        $user_id = $request->user()->id;
        $friendRequests = Friend::getFriendRequest($user_id);
        return response()->json([
            'success' => true,
            'data' => $friendRequests,
        ], 200);
    }
    // public function acceptFriendRequest(Request $request)
    // {
    //     // Get the friend request ID from the request
    //     $request_id = $request->input('request_id');

    //     // Accept the friend request by updating the status to true
    //     $friendRequest = Friend::find($request_id);
    //     if ($friendRequest) {
    //         $friendRequest->status = true;
    //         $friendRequest->save();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Friend request accepted successfully',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Friend request not found',
    //         ], 404);
    //     }
    // }
    public function acceptFriendRequest(Request $request, $friendRequestId)
    {
        // Accept the friend request by updating the status to true
        $friendRequest = Friend::find($friendRequestId);
        if ($friendRequest) {
            $friendRequest->status = "true";
            $friendRequest->save();

            return response()->json([
                'success' => true,
                'message' => 'Friend request accepted successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Friend request not found',
            ], 404);
        }
    }


    public function rejectFriendRequest(Request $request, $friendRequestId)
    {
        // Reject the friend request by updating the status to false
        $friendRequest = Friend::find($friendRequestId);
        if ($friendRequest) {
            $friendRequest->status = "false";
            $friendRequest->save();

            return response()->json([
                'success' => true,
                'message' => 'Friend request rejected successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => "false",
                'message' => 'Friend request not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // $user_id = $request->user()->id;
        // $user = Friend::find($request->user()->id);
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
    public function showByUserId(int $userId)
    {
        $friendRequests = Friend::where('user_id', $userId)->get();

        return response()->json([
            'data' => $friendRequests,
        ], 200);
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
