<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('users.profile', compact('user'));
    }

    public function follow(User $user)
    {
        if (!auth()->user()->isFollowing($user) && !auth()->user()->isPending($user)) { // if the authenticated user is not following the user and the authenticated user is not pending to follow the user
            auth()->user()->follow($user);
        }
        return redirect()->route('users.profile', $user->username);
    }
    public function unfollow(User $user)
    {
        auth()->user()->unfollow($user);
        return back();
    }
}

