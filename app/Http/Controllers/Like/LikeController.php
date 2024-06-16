<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\Like\LikeResource;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */

public function index()
{
    $likes = Like::with('user')->get();
    return response()->json([
        'data' => LikeResource::collection($likes),
    ], 200);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $like = Like::store($request);
        return response()->json(['success'=>true, 'message'=>'Like created successfully', 'data'=>$like], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
