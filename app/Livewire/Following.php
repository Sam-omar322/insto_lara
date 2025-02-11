<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Following extends Component
{
    protected $user;
    public $userId;
    protected $listeners = ['unfollowUser', ];
    // public function mount($user)
    // {
    //     $this->user = $user;
    //     $this->userId = $user->id;
    // }
    public function getCountProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot('confirmed', true)->get()->count();
    }


    public function render()
    {
        return view('livewire.following');
    }
}
