<div class="card">
    <div class="card-header">
        <div class="flex justify-center items-center mr-3">
            <img class="w-8 h-8 rounded-full object-cover" src="{{ $post->user->image ? (Str::contains($post->user->image, 'users/') ? asset('storage/' . $post->user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">
        </div>
        <a href="/users/{{ $post->user->username }}" class="font-bold">{{ $post->user->username }}</a>
    </div>
    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <img class="h-auto w-full object-cover" src="{{Storage::url($post->image) }}" alt="{{$post->description}}">
        </div>
        <div class="p-3">
            {{$post->description}}
        </div>

        @if ($post->comments()->count() > 0)
        <a href="/p/{{$post->slug}}" class="p-3 font-bold text-sm text-gray-500">
            {{ __('View All ' . $post->comments()->count() . ' comments') }}
        </a>
        @endif
        <div class="p-3 text-gray-400 uppercase text-xs">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="card-footer">
        <form action="/p/{{$post->slug}}/comments" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body" placeholder="{{ __('Add a comment ... ') }}" autocomplete='off' autocorrect='off'
                class="grow border-none focus:ring-0 outline-0 bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-300 resize-none"></textarea>
            <button type="submit" class="bg-white border-none text-blue-500 ml-5">{{ __('Post') }}</button>
        </div>
        </form>
    </div>
</div>