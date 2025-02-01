<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        // check if user liked the post
        if ($post->Liked(auth()->user())) {
            // remove like
            $post->likes()->detach(auth()->user());
        } else {
            // add like
            $post->likes()->attach(auth()->user());
        }

        return back();
    }
}
