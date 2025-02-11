<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class FollowingModal extends ModalComponent
{
    public $userId;
    protected $user;

    public function getFollowingListProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot('confirmed', true)->get();
    }

    public function unfollow($userId)
    {
        $following_user = User::find($userId);
        $this->user = User::find($this->userId);
        $this->user->unfollow($following_user);
        $this->dispatch("unfollowUser");
    }

    public function render()
    {
        return view('livewire.following-modal');
    }
}
