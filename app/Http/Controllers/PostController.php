<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
 
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get posts of the users that the authenticated user follows
        $ids = auth()->user()->following()->wherePivot('confirmed', true)->get()->pluck('id');
        $posts = Post::whereIn('user_id', $ids)->latest()->get();
        $suggested_users = Auth::user()->suggested_users();
        return view('posts.index', compact(['posts', 'suggested_users']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required|string',
        ]);

        $path = $request->file('image')->store('posts', 'public');

        $data['image'] = $path;

        $faker = Faker::create();
        $data['slug'] = $faker->regexify('[A-Za-z0-9]{10}');
        
        $data['user_id'] = auth()->user()->id;

        Post::create($data);

        // return redirect()->route('posts.create')
        //     ->with('success', 'Post created successfully.');
        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id == $post->user->id) {
            return view('posts.edit', compact('post'));
        }
        return redirect("/");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
    
            // Store the new image
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }
    
        $post->update($data);
        
        return redirect()->route('posts.show', $post->slug)->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete("public/" . $post->image);
        $post->comments()->delete();
        $post->delete();

        return redirect("/");
    }

    public function explore()
    {
        $posts = Post::WhereRelation('user', 'private_account', '=', 0)->whereNot('user_id', auth()->id())->simplepaginate(9);
        return view('posts.explore', compact('posts'));
    }
}
