<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'post_id',
        'user_id',
        'like_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAllLikes()
    {
        return self::all();
    }

    public static function store($request, $id = null)
    {
        $like = $request->only('user_id', 'post_id', 'like_id');
        $like = self::updateOrCreate(['id' => $id], $like);
        return $like;
    }
}
