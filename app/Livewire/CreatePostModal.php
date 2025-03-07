<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CreatePostModal extends ModalComponent
{

    use WithFileUploads;

    public $image;

    public function save_temp()
    {
        $this->validate([
            'image' => 'image:max:2048'
        ]);

        $image = $this->image->store('temp', 'public');
        $this->dispatch('openModal', 'filters-modal', ['image' => $image]);
    }

    public function render()
    {
        return view('livewire.create-post-modal');
    }
}
