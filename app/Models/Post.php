<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'description',
        'slug',
        'likes',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
        // return $this->belongsTo(User::class, 'user_id'); if you change function name you can use id column to identify
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
