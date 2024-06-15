<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRejectFriend extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'reject_friends',
        'status',
    ];

    public static function list()
    {
        return self::all();
    }

    public static function store($request, $id = null)
    {
        $data = $request->only('user_id', 'reject_friends', 'status');
        $friend = self::updateOrCreate(['id' => $id], $data);
        return $friend;
    }

    // Request 
    public function reject()
    {
        return $this->belongsTo(User::class, 'reject_friends', 'id');
    }
}
