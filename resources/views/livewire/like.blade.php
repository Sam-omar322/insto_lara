<div>
    <a wire:click="toggle_like">
        @if ($post->Liked(auth()->user()))
        <i class="bx bxs-heart text-3xl text-red-500 cursor-pointer"></i>
        @else
        <i class="bx bx-heart text-3xl hover:text-gray-300 cursor-pointer"></i>
        @endif
    </a>
</div>
