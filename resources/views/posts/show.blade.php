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
                        <button class="mx-2" onclick="Livewire.dispatch('openModal', { component: 'edit-post-modal', arguments: [{{ $post->id }}] })">
                        <i class='bx bx-edit-alt'></i></button>
                        <!-- Delete post -->
                        <form action="/p/{{$post->slug}}/delete" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type='submit' onclick="return confirm('Are You Sure?')">
                                <i class='bx bx-trash' style='color:#ff0000'></i>
                            </button>
                        </form>
                    </div>
                    @else
                        <livewire:FollowButton :userId="$post->user->id" :post="$post" classes="text-blue-400 px-2" cancel_classes="text-red-500" />
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

            <div class="p-3 flex flex-row gap-3 border-t">
                @livewire('like', ['post' => $post])

                <a class="grow" onclick="document.getElementById('comment_input').focus()">
                    <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
                </a>
            </div>
            @livewire('likedby', ['post' => $post])

            <!-- Send new Comment -->
            <div class="border-t-2">
                <form action="/p/{{$post->slug}}/comments" method="POST">
                    @csrf
                    <div class="flex items-center px-4 py-2">
                        <input id="comment_input" type="text" name="body" class="w-full border-none me-2" placeholder="Add a comment">
                        <button type="submit" class="text-blue-500 font-bold">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>