<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',
        'user_id',
        'like',
    ];

    
    public static function list() {
        $like = self::all();
        return $like;
    }

 // Like.php
public function post()
{
    return $this->belongsTo(Post::class, 'post_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    
    public static function store($reqeust, $id=null) {
        $like = $reqeust->only('user_id', 'post_id', 'like');
        $like = self::UpdateOrCreate(['id'=>$id], $like);
        return $like;
    }
    
}
