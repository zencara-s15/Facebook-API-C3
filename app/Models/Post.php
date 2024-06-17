<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'image'
    ];

    public static function list() {
        return self::all();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function like() {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public static function store($request, $id = null) {

        $post = [
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'image' => $request->image,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $post['image'] = $image;
        }
        return self::updateOrCreate(['id' => $id], $post);
    }
}
