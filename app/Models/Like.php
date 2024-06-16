<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;
<<<<<<< HEAD

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

    public function post() {
        return $this->belongsToMany(Post::class, 'post_id', 'id');
    }

    public function user() {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }
    
    public static function store($reqeust, $id=null) {
        $like = $reqeust->only('user_id', 'post_id', 'like');
        $like = self::UpdateOrCreate(['id'=>$id], $like);
        return $like;
    }
    
=======
>>>>>>> friend
}
