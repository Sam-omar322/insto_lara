<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link class="flex items-center gap-1" :href="route('posts.index')" :active="request()->routeIs('home')">
                        <i class='bx bxs-home-alt-2' undefined ></i>
                        {{ __('Home') }}
                    </x-nav-link>
                </div> -->
            </div>

            <!-- Search -->
            <div class="hidden sm:flex sm:items-center">
                @livewire('search')
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="flex items-center space-x-3">
                        <div class="space-x-3 text-[1.6rem] ltr:mr-2 rtl:ml-2 leading-5">
                            <a class="rtl:ml-2 ltr:mr-2" href="{{ route('posts.index') }}">
                                {!! url()->current() == route('posts.index') 
                                    ? '<i class="bx bxs-home-alt-2"></i>'
                                    : '<i class="bx bx-home-alt-2"></i>' !!}
                            </a>
                            <a href="{{ route('explore') }}">
                                {!! url()->current() == route('explore') 
                                    ? '<i class="bx bxs-compass"></i>'
                                    : '<i class="bx bx-compass"></i>' !!}
                            </a>
                            <button onclick="Livewire.dispatch('openModal', { component: 'create-post-modal'})" class="cursor-pointer">
                                    <i class="bx bx-message-add"></i>
                            </button>
                        </div>
                    </div>
                @endauth

                @guest
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-400">Login</a>
                        <a href="{{ route('register') }}" class="text-sm text-white bg-blue-400 py-2 px-4 rounded dark:text-gray-400">Register</a>
                    </div>
                @endguest

                @auth

                    <x-dropdown width="96">
                        <x-slot name="trigger">
                            <button class="space-x-3 text-[1.6rem] ml-2 leading-5">
                                <div class="relative">
                                    <i class="bx bxs-inbox"></i>
                                </div>
                                <livewire:pending-followers-count />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @livewire('pending-followers-list')
                        </x-slot>
                    </x-dropdown>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex justify-center items-center mx-3">
                                    <x-user_avatar :user="Auth::user()" />
                                </div>
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.profile', Auth::user()->username)">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

 <!-- Responsive Navigation Menu -->
 <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::check() ? Auth::user()->email : '' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- create new post -->
                    <x-dropdown-link class="cursor-pointer" onclick="Livewire.dispatch('openModal', { component: 'create-post-modal'})">
                        {{ __('Create Post') }}
                    </x-dropdown-link>
                            
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>