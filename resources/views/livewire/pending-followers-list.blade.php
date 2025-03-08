<div>
    @forelse(auth()->user()->pending_followers as $pending)
        <div class="flex items-center justify-between p-2 border-b border-neutral-200">
            <div class="flex items-center">
            <img class="w-8 h-8 rounded-full object-cover" src="{{ $pending->image ? (Str::contains($pending->image, 'users/') ? asset('storage/' . $pending->image) : 'https://ui-avatars.com/api/?name=' . urlencode($pending->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">
            <a href="/users/{{ $pending->username }}" class="ltr:ml-2 rtl:mr-2">{{ $pending->username }}</a>
            </div>
            
            <div class="flex gap-2">
                <button wire:click="confirm({{ $pending->id }})" class="bg-blue-400 text-white rounded text-center text-[0.8rem] py-1 px-2">
                    {{ __('Confirm') }}
                </button>
                <button wire:click="delete({{ $pending->id }})" class="text-red-400 border border-red-400 rounded text-center text-[0.8rem] py-1 px-2">
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>

    @empty
        <div class="p-4 text-center text-neutral-500">
            {{ __('No pending followers') }}
        </div>
    @endforelse
</div>
