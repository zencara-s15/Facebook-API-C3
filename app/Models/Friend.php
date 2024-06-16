<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Friend extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];

    public static function friendList($user_id)
    {
        return self::where(function ($query) use ($user_id) {
            $query->where([
                ['user_id', $user_id],
                ['status', 'true'],
            ])->orWhere([
                ['friend_id', $user_id],
                ['status', 'true'],
            ]);
        })->get();
    }
    
    public static function getFriendRequest($user_id)
    {
        return self::where(function ($query) use ($user_id) {
            $query->where([
                ['user_id', $user_id],
                ['status', 'pending'],
            ])->orWhere([
                ['friend_id', $user_id],
                ['status', 'pending'],
            ]);
        })->get();
    }

    public static function sendFriendRequest($request, $attributes = [])
    {
        $user_id = $request->user()->id;
        $data = array_merge(
            $request->only('friend_id'),
            ['user_id' => $user_id, 'status' => 'pending'],
            $attributes
        );
        return self::updateOrCreate(['friend_id' => $data['friend_id']], $data);
    }

    public static function acceptFriendRequest($request_id)
    {
        $friendRequest = self::find($request_id);
        if ($friendRequest) {
            $friendRequest->status = true;
            $friendRequest->save();
            return true;
        }
        return false;
    }

    public static function rejectFriendRequest($request_id)
    {
        $friendRequest = self::find($request_id);
        if ($friendRequest) {
            $friendRequest->status = false;
            $friendRequest->save();
            return true;
        }
        return false;
    }

    // request 
    public function requester()

    {
        return $this->belongsTo(User::class, 'friend_id', 'id');
    }

}
