<img class="w-8 h-8 rounded-full object-cover" 
     src="{{ Auth::check() ? (Str::contains(Auth::user()->image, 'users/') ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" 
     alt="User Avatar">