@props(['user'])

<div class="w-8 h-8 rounded-full overflow-hidden">
    @if ($user)
        <img src="{{ Str::contains($user->image, 'users/') ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
    @else
        <img src="https://ui-avatars.com/api/?name=Guest" alt="Guest" class="w-full h-full object-cover">
    @endif
</div>