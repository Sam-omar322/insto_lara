<x-app-layout>
<div class="container mx-auto p-4">
    <div class="grid grid-cols-3 gap-1 md:gap-5 mt-8">
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', $post->slug) }}">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}" class="w-full aspect-square object-cover rounded-lg">
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $posts->links() }}
    </div>
</div>
</x-app-layout>