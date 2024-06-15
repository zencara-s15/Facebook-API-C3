<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'post_image'
    ];

    public static function list() {
        return self::all();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function store($request, $id = null) {
        $post = $request->only('user_id', 'title');

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image')->store('images', 'public');
            $post['post_image'] = $image;
        }

        return self::updateOrCreate(['id' => $id], $post);
    }
}
