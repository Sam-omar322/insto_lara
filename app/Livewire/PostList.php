<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostList extends Component
{

    protected $listeners = ['toggleFollow' => '$refresh'];

    public function getPostsProperty()
    {
        $ids = auth()->user()->following()->wherePivot('confirmed', true)->get()->pluck('id');
        return Post::whereIn('user_id', $ids)->latest()->get();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
