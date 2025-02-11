<div class="max-h-96 flex flex-col">
    <div class="flex w-full item-center border-b border-neutral-200 p-2">
        <h1 class="text-lg text-center grow font-bold pb-2">{{ __('Following') }}</h1>
        <button wire:click="$dispatch('closeModal')"><i class="bx bx-x text-xl"></i></button>
    </div>    

    <div class="overflow-y-auto">
        @foreach($this->following_list as $following)
            <div class="flex items-center justify-between p-2 border-b border-neutral-200">
                <div class="flex items-center">
                <img class="w-8 h-8 rounded-full object-cover" src="{{ $following->image ? (Str::contains($following->image, 'users/') ? asset('storage/' . $following->image) : 'https://ui-avatars.com/api/?name=' . urlencode($following->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">
                <a href="/users/{{ $following->username }}" class="ml-2">{{ $following->username }}</a>
                </div>
    
                @auth
                @if (auth()->user()->isFollowing($following))
                <button wire:click="unfollow({{ $following->id }})" class="px-2 py-1 border border-gray-500 rounded">{{ __('Unfollow') }}</button>
                @endif
                @endauth
            </div>
        @endforeach
    </div>
</div>
