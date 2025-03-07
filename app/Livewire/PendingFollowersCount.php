<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class PendingFollowersCount extends Component
{
    protected $listeners = ['toggleFollow' => '$refresh', 'requestConfirmed' => '$refresh', 'requestDeleted' => '$refresh'];

    public function getCountProperty()
    {
        return auth()->user()->pending_followers()->count();
    }
    public function render()
    {
        return view('livewire.pending-followers-count');
    }
}
