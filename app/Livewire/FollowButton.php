<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FollowButton extends Component
{
    public $userId;
    protected $user;
    public $post;
    public $classes;
    public $pendding_classes;
    public $cancel_classes;
    public $follow_state;

    // call this function once the component is mounted
    public function mount() {
        $this->user = User::find($this->userId);
        $this->set_follow_state();
    }
    
    public function toggle_follow() {
        $this->user = User::find($this->userId);
        auth()->user()->toggle_follow($this->user);
        $this->set_follow_state();
    }

    public function set_follow_state() {
        if (auth()->user()->isPending($this->user)) {
            $this->follow_state = 'Pending';
        } elseif (auth()->user()->isFollowing($this->user)) {
            $this->follow_state = 'Unfollow';
        } else {
            $this->follow_state = 'Follow';
        }
    }
    public function cancel_request() {
        $this->user = User::find($this->userId);
        auth()->user()->unfollow($this->user);
        $this->set_follow_state();
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
