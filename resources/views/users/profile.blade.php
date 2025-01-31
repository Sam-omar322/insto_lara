<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row items-center md:items-start mb-8">
            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden">
            <img class="w-full h-full object-cover" src="{{ $user->image ? (Str::contains($user->image, 'users/') ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">            </div>
            <div class="md:ml-8 mt-4 md:mt-0">
                <div class="flex items-center mb-4">
                    <div>
                        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                        <a href="/profile" class="mt-4 block bg-gray-300 text-black px-4 py-2 rounded-md">Edit Profile</a>
                    </div>
                    <button class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-md">Follow</button>
                    <button class="ml-2 bg-gray-300 text-black px-4 py-2 rounded-md">Message</button>
                </div>
                <div class="flex space-x-4 mb-4">
                    <div><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div><strong>{{ $user->followers_count }}</strong> followers</div>
                    <div><strong>{{ $user->following_count }}</strong> following</div>
                </div>
                <div>
                    <p>{{ $user->bio }}</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($user->posts as $post)
                <div>
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}" class="w-full aspect-square object-cover rounded-lg">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
