<x-app-layout>
    <div class="h-screen md:flex md:flex-row">
        <!-- Left Side -->
        <div class="h-full md:w-7/12 bg-black flex items-center justify-center">
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->slug }}">
        </div>
        <!-- Right Side -->
        <div class="flex w-full overflow-y-auto flex-col bg-white md:w-5/12">
            <div class="border-b-2">
                <!-- User Info -->
                <div class="flex items-center justify-between p-5">
                    <div class="flex items-center me-3">
                        <a class="flex items-center" href="/users/{{ $post->user->username }}">
                            <img class="w-8 h-8 rounded-full object-cover" src="{{ Str::contains($post->user->image, 'users/') ? asset('storage/' . $post->user->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="User Avatar">
                            <span class="ml-3">{{ $post->user->name }}</span>
                        </a>
                    </div>
                    @if ($post->user->id == Auth::user()->id)
                    <div class="flex">
                        <!-- Edit post -->
                         <a class="mx-2" href="/p/{{$post->slug}}/edit"><i class='bx bx-edit-alt'></i></a>
                        <!-- Delete post -->
                        <form action="/p/{{$post->slug}}/delete" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type='submit' onclick="return confirm('Are You Sure?')">
                                <i class='bx bx-trash' style='color:#ff0000'></i>
                            </button>
                        </form>
                    </div>
                    @elseif (Auth::user()->isFollowing($post->user))
                    <a href="/users/{{ $post->user->username }}/unfollow" class="text-blue-500 px-3 rounded text-center">{{ __("Unfollow") }}</a>
                    @else
                    <a href="/users/{{ $post->user->username }}/follow" class="text-blue-500 px-3 rounded text-center">{{ __("Follow") }}</a>
                    @endif
                </div>

                <!--Post desc -->
                <div class="px-5 mb-5"><p>{{$post->description}}</p></div>
            </div>

            <!-- Comments -->
                @foreach ($post->comments as $comment)
                    <div class="my-2">
                        <div class="flex items-start py-2 px-5">
                            <div class="flex-shrink-0 me-3">
                            <a href="/users/{{ $comment->user->username }}">
                                <img class="w-8 h-8 rounded-full object-cover" src="{{ Str::contains($comment->user->image, 'users/') ? asset('storage/' . $comment->user->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="User Avatar">
                            </a>
                            </div>
                            <p class="break-words break-all overflow-hidden">
                            <a href="/users/{{ $comment->user->username }}"><span class="font-bold">{{ $comment->user->name }}</span></a> {{ $comment->body }}
                            </p>
                        </div>
                    </div>
                @endforeach

            <!-- Send new Comment -->
            <div class="border-t-2">
                <form action="/p/{{$post->slug}}/comments" method="POST">
                    @csrf
                    <div class="flex items-center px-4 py-2">
                        <input type="text" name="body" class="w-full border-none me-2" placeholder="Add a comment">
                        <button type="submit" class="text-blue-500 font-bold">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>