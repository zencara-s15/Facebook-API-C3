<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'text'
    ];

    public static function list() {
        $comment = self::all();
        return $comment;
    }

    public static function store($request, $id=null) {
        $comment = $request->only('user_id', 'post_id', 'text');
        $comment = self::updateOrCreate(['id'=>$id], $comment);
        return $comment;
    }

    public function post() {
        return $this->belongsToMany(Post::class, 'post_id', 'id');
    }

    public function user() {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }

}

