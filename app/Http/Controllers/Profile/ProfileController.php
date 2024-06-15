<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function uploadProfile(Request $request)
    {
        $user_id = $request->user()->id;
        $user = User::find($request->user()->id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')) {
            $user = User::uploadProfile($request, $user_id);
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User profile uploaded successfully'
            ], 200);
        } 
        return response()->json([
            'success' => false,
            'message' => 'No image uploaded'
        ], 400);
    }


    public function updateProfileInfo(Request $request) {
        $user = $request->user();
        $user->update($request->all());
        return response()->json([
           'success' => true,
            'data' => $user,
           'message' => 'User info updated successfully'
        ], 200);
        return response()->json([
           'success' => false,
           'message' => 'User profile not updated'
        ], 400);
    }

    public function getProfilePicture(Request $request) {
        $user_pf = $request->user()->image;
        return response()->json([
            'success' => true,
            'data' => $user_pf,
        ]);
    }

    public function deleteProfilePicture(Request $request) {
        $user = $request->user();
        $user->image= null;
        $user->save();
        return response()->json([
           'success' => true,
            'data' => $user,
           'message' => 'User profile deleted successfully'
        ], 200);
    }
}
