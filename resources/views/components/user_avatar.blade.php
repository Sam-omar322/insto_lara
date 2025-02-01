<div class="w-8 h-8 rounded-full overflow-hidden">
    <img src="{{ strpos($user->image, 'users/') !== false ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
</div>