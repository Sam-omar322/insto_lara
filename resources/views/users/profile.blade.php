<x-app-layout>
    {{-- Message User --}}
    <div class="{{ session('success') ? '' : 'hidden'}} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-neutral-200" role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    <div class="grid grid-cols-4">
        {{-- User Image --}}
        <div class="px-4 col-span-1 order-1">
            <img class="rounded-full w-20 md:w-40 border border-neutral-300" src="{{ $user->image ? (Str::contains($user->image, 'users/') ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">
        </div>

        {{-- Username and Button --}}
        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3">
            <div class="text-3x1 mb-3">{{ $user->username }}</div>
            @auth
                @if ($user->id == auth()->id())
                    <a href="/profile" class="w-44 border text-sm font-bold py-1 rounded-md border-neutral-300 text-center">
                        {{ __('Edit Profile') }}
                    </a>
                    @else
                    <livewire:FollowButton :userId="$user->id" classes="bg-blue-500 text-white px-4 py-2" pendding_classes="text-white px-4 py-2 bg-gray-500" cancel_classes="text-red-500 px-4 py-2 border border-red-500" />
                    @endif
            @endauth

            @guest
            <a href="/users/{{ $user->username }}/follow" class="w-30 bg-blue-500 text-white px-3 py-1 rounded text-center self-start">{{ __('Follow') }}</a>
            @endguest
        </div>

        {{-- User Info --}}
        <div class="text-md px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-0">
            <p class="font-bold">{{ $user->name }}</p>
            {!! nl2br(e($user->bio)) !!} <!-- nl2br is a break work function and e is a escape function -->
        </div>

        {{-- User Stats --}}
        <div class="col-span-4 my-2 py-2 border-y border-y-neutral-200 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
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
                    <button onclick="Livewire.dispatch('openModal', { component: 'follower-modal', arguments: { userId: {{ $user->id }} }})" class='text-neutral-500 md:text-black'>{{ $user->followers()->count() > 1 ? 'Followers' : 'Follower' }}</button>
                </li>
                <livewire:following :userId="$user->id" /> 
            </ul>
        </div>
    </div>

    {{-- Bottom --}}
    @if($user->posts()->count() > 0 and ($user->private_account == false or (auth()->check() && (auth()->id() == $user->id or auth()->user()->isFollowing($user)))))
        <div class="grid grid-cols-3 gap-1 my-5">
            @foreach($user->posts()->orderBy('created_at', 'desc')->get() as $post)
                <a href="/p/{{$post->slug}}" class="aspect-square block w-full">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{$post->description}}" class="w-full aspect-square object-cover">
                </a>
            @endforeach
        </div>
    @else 
        <div class="w-full text-center mt-20">
            @if ($user->private_account == true and (!auth()->check() || $user->id != auth()->id()))
                {{ __('This Account Is Private. Follow To See Their Photos.') }}
            @else
                {{ __('This User Does Not Have Any Posts') }}
            @endif
        </div>
    @endif
</x-app-layout>