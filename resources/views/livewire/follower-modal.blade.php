<div class="max-h-96 flex flex-col">
    <div class="flex w-full item-center border-b border-neutral-200 p-2">
        <h1 class="text-lg text-center grow font-bold pb-2">{{ __('Followers') }}</h1>
        <button wire:click="$dispatch('closeModal')"><i class="bx bx-x text-xl"></i></button>
    </div>    

    <div class="overflow-y-auto">
        @foreach($this->followers_list as $follower)
            <div class="flex items-center justify-between p-2 border-b border-neutral-200">
                <div class="flex items-center">
                <img class="w-8 h-8 rounded-full object-cover" src="{{ $follower->image ? (Str::contains($follower->image, 'users/') ? asset('storage/' . $follower->image) : 'https://ui-avatars.com/api/?name=' . urlencode($follower->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">
                <a href="/users/{{ $follower->username }}" class="ltr:ml-2 rtl:mr-2">{{ $follower->username }}</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
