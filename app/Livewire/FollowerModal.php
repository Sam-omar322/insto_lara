<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class FollowerModal extends ModalComponent
{

    public $userId;
    protected $user;

    public function getFollowersListProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->followers()->wherePivot('confirmed', true)->get();
    }

    public function render()
    {
        return view('livewire.follower-modal');
    }
}
