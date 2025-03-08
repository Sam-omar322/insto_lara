<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        <!-- Left Side -->
         <livewire:post-list />

        <!-- Right Side -->
         <div class="hidden w-[40rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm">
                <div class="ltr:mr-4 rtl:ml-4">
                    <a href="/users/{{ Auth::user()->username }}">
                        <x-user_avatar :user="Auth::user()" />
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/users/{{ Auth::user()->username }}" class="font-bold">{{ Auth::user()->username }}</a>
                    <div class="text-gray-300 text-sm">{{ Auth::user()->name }}</div>
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-gray-500 font-bold">{{ __('Suggestions For You') }}</h3>
                <ul>
                    @foreach ($suggested_users as $suggested_user)
                    <li class="flex flex-row my-5 text-sm justify-items-center">
                        <div class="ltr:mr-4 rtl:ml-4">
                            <a href="/users/{{ $suggested_user->username }}">
                            <img class="w-8 h-8 rounded-full object-cover" src="{{ $suggested_user->image ? (Str::contains($suggested_user->image, 'users/') ? asset('storage/' . $suggested_user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($suggested_user->name)) : 'https://ui-avatars.com/api/?name=Guest' }}" alt="User Avatar">
                            </a>
                        </div>
                        <div class="flex flex-col grow">
                            <a href="/users/{{ $suggested_user->username }}" class="font-bold">{{ $suggested_user->username}}
                                @if (auth()->user()->isFollower($suggested_user))
                                <span class="text-sm text-gray-500">{{ __('Follower') }}</span>
                                @endif
                            </a>
                            <div class="text-gray-400 text-sm">{{ $suggested_user->name }}</div>
                        </div>
                        @if (Auth::user()->isPending($suggested_user))
                        <livewire:follow-button :userId="$suggested_user->id" pendding_classes='font-bold text-gray-400' cancel_classes="font-bold text-red-400" />
                        @else
                        <livewire:follow-button :userId="$suggested_user->id" classes="text-blue-500 font-bold" />
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>

