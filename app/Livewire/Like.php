<?php

namespace App\Livewire;

use Livewire\Component;

class Like extends Component
{
    public $post;

    public function toggle_like() {
        // check if user liked the post
        if ($this->post->Liked(auth()->user())) {
            // remove like
            $this->post->likes()->detach(auth()->user());
        } else {
            // add like
            $this->post->likes()->attach(auth()->user());
        }
        $this->dispatch("ToggleLike"); // livewire 3
        // $this->emit('ToggleLike'); livewire 2
    }
    public function render()
    {
        return view('livewire.like');
    }
}
