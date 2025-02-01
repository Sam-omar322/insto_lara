<x-app-layout>
    {{-- Message User --}}
    <div class="{{ session('success') ? '' : 'hidden'}} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-neutral-200" role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    <div class="grid grid-cols-4">
        {{-- user Image --}}
        <div class="px-4 col-span-1 order-1">
            <img class="rounded-full w-20 md:w-40 border border-neutral-300" src="{{ $user->image ? (Str::contains($user->image, 'users/') ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">
        </div>

        {{-- Username and Button --}}

        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3">
            <div class="text-3x1 mb-3">{{ $user->username }}</div>
            @if ($user->id == auth()->id())
            <a href="/profile"
                class="w-44 border text-sm font-bold py-1 tounded-md border-neutral-300 text-center">
                {{ __('Edit Profile') }}
            </a>
            @elseif(auth()->user()->isFollowing($user))
            <a href="/users/{{ $user->username }}/unfollow" class="w-30 bg-blue-500 text-white px-3 py-1 rounded text-center self-start">{{ __("Unfollow") }}</a>
            @elseif(auth()->user()->isPending($user))
            <div class="flex gap-3">
                <span class="w-30 bg-gray-400 text-white px-3 py-1 rounded text-center self-start">{{ __('Pending') }}</span>
                <a href="/users/{{ $user->username }}/unfollow" class="w-30 bg-gray-200 text-red-400 px-3 py-1 rounded text-center self-start font-bold2">{{ __("Cancel") }}</a>
            </div>
            @else
            <a href="/users/{{ $user->username }}/follow" class="w-30 bg-blue-500 text-white px-3 py-1 rounded text-center self-start">{{ __('Follow') }}</a>
            @endif
        </div>

        {{--  User info --}}

        <div class="text-md px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-0">
            <p class="font-bold">{{ $user->name }}</p>
            {!! nl2br(e($user->bio)) !!} <!-- nl2br is a break work function and e is a escape function -->
        </div>
        {{-- User stats  --}}
        <div
            class="col-span-4 my-2 py-2 border-y border-y-neutral-200 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
            <ul class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl">
                <li class="flex flex-col md:flex-row text-center rtl:ml-5 gap-2">
                    <div class="md:ltr:mr-1 md:rtl:ml-1 font-bold md:font-normal">
                        {{ $user->posts->count() }}
                    </div>
                    <span class='text-neutral-500 md:text-black'>{{ $user->posts->count() > 1 ? 'posts' : 'post' }}</span>
                </li>
                <li class="flex flex-col md:flex-row text-center rtl:ml-5 gap-2">
                    <div class="md:ltr:mr-1 md:rtl:ml-1 font-bold md:font-normal">
                        {{ $user->followers()->wherePivot('confirmed', true)->get()->count() }}
                    </div>
                    <span class='text-neutral-500 md:text-black'>{{ $user->followers()->count() > 1 ? 'Followers' : 'Follower' }}</span>
                </li>
                <li class="flex flex-col md:flex-row text-center rtl:ml-5 gap-2">
                    <div class="md:ltr:mr-1 md:rtl:ml-1 font-bold md:font-normal">
                        {{ $user->following()->wherePivot('confirmed', true)->get()->count() }}
                    </div>
                    <span class='text-neutral-500 md:text-black'>{{ __('Following') }}</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Botoom --}}

    @if($user->posts()->count() > 0 and ($user->private_account == false or auth()->id() == $user->id or auth()->user()->isFollowing($user)))
    <div class="grid grid-cols-3 gap-1 my-5">
        @foreach($user->posts as $post)
        <a href="/p/{{$post->slug}}" class="aspect-square block w-full">
        <img src="{{ asset('storage/'.$post->image) }}" alt="{{$post->description}}" class="w-full aspect-square object-cover">
        </a>
        @endforeach
    </div>
    @else 
    <div class="w-full text-center mt-20">
        @if ($user->private_account == true and $user->id != auth()->id())
        {{ __('This Account Is Private. Follow To See Their Photos.') }}
        @else
        {{ __('This User Dose Not Have Any Posts') }}
        @endif
    </div>
    @endif
</x-app-layout>