<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'email',
        'password',
    ];

   

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id')
                    ->wherePivot('status', 'accepted')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function acceptFriend()
    {
        return $this->belongsToMany(User::class, 'acceptFriend', 'friend_request')
                    ->wherePivot('status', 'accepted')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public static function uploadProfile($request, $id = null)
    {
        $data = $request->only('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $data['image'] = $image;
        }

        $user = self::updateOrCreate(['id' => $id], $data);

        return $user;
    }
    public static function updateProfileInfo($request, $id = null){
        $data = $request->only('name', 'email');

        $user = self::updateOrCreate(['id' => $id], $data);

        return $user;
    }

    public function post() {
        return $this->hasMany(Post::class, 'post', 'user_id')
                    ->wherePivot('status', 'accepted')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(User::class, 'comments', 'user_id')
                    ->wherePivot('status', 'commented')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
