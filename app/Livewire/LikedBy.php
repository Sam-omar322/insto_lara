<?php

namespace App\Livewire;

use Livewire\Component;

class LikedBy extends Component
{
    public $post;
    protected $listeners = ['ToggleLike' => 'getLikesProperty'];

    public function getLikesProperty()
    {
        return $this->post->likes()->count();
    }

    public function getFirstnameProperty()
    {
        return $this->post->likes()->first()->username;
    }

    public function render()
    {
        return view('livewire.liked-by');
    }
}
