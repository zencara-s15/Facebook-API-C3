<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAcceptFriend extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'friend_request',
        'status',
    ];

    public static function list()
    {
        return self::all();
    }

    public static function store($request, $id = null)
    {
        $data = $request->only('user_id', 'friend_request', 'status');
        $friend = self::updateOrCreate(['id' => $id], $data);
        return $friend;
    }

    // Request 
    public function accept()
    {
        return $this->belongsTo(User::class, 'friend_request', 'id');
    }
}
