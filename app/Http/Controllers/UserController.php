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
        auth()->user()->follow($user);
        return back();
    }
    public function unfollow(User $user)
    {
        auth()->user()->unfollow($user);
        return back();
    }
}
