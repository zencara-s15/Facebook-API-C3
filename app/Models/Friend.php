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

    public static function list()
    {
        return self::all();
    }

    public static function store($request, $id = null)
    {
        $data = $request->only('user_id', 'friend_id', 'status');
        $friend = self::updateOrCreate(['id' => $id], $data);
        return $friend;
    }

    // request 
    public function requester()
    {
        return $this->belongsTo(User::class, 'friend_id', 'id');
    }

}
