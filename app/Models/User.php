<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'bio',
        'username',
        'image',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function suggested_users() {
        // get the users that the authenticated user follows
        $following = $this->following()->wherePivot('confirmed', true)->get();
        return User::all()->diff($following)->except(auth()->id())->shuffle()->take(5);
    }

    public function likes() {
        return $this->belongsToMany(Post::class, 'likes');
    }

    // Follows
    public function following() {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withPivot('confirmed')->withTimestamps(); // pivot is a table that has user_id and following_user_id and confirmed.
    }
    public function followers() {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->withPivot('confirmed')->withTimestamps();
    }
    public function follow(User $user) {
        if ($user->private_account) {
            return $this->following()->attach($user);
        }
        return $this->following()->attach($user, ['confirmed' => true]);
    }
    public function unfollow(User $user) {
        return $this->following()->detach($user);
    }
    public function isPending(User $user) {
        return $this->following()->where('following_user_id', $user->id)->wherePivot('confirmed', false)->exists();
    }
    public function isFollower(User $user) {
        return $this->followers()->where('user_id', $user->id)->wherePivot('confirmed', true)->exists();
    }
    public function isFollowing(User $user) {
        return $this->following()->where('following_user_id', $user->id)->wherePivot('confirmed', true)->exists();
    }
}
