<header class="w-full xl:fixed top-0 left-0 bg-white xl:bg-transparent xl:pointer-events-none shadow-md xl:shadow-none z-20">
    <nav class="w-full 2xl:max-w-7xl 2xl:mx-auto flex flex-row xl:flex-col items-center xl:items-start justify-between" x-data="{ sidebarOpen: false }">
        <div class="w-full h-full fixed inset-0 z-20 transition-opacity duration-300 opacity-0 pointer-events-none"
             :class="{ '': sidebarOpen === true, 'opacity-0 pointer-events-none': sidebarOpen === false }"
             x-on:click="sidebarOpen = false">
            <div class="absolute w-full h-full bg-gray-900 bg-opacity-50 xl:bg-opacity-0 z-30"></div>
        </div>
        <div class="transform -translate-x-full xl:translate-x-0 ease-in-out transition-all duration-300 fixed top-0 left-0 2xl:left-auto xl:mt-32 2xl:mx-auto pb-20 w-3/5 sm:w-60 2xl:w-full 2xl:max-w-7xl h-full bg-white 2xl:bg-transparent z-40 xl:z-10 2xl:pointer-events-none"
             :class="{ 'left-sidebar--open' : sidebarOpen === true }">
            <div class="w-full 2xl:w-60 bg-transparent 2xl:bg-white 2xl:rounded-md 2xl:shadow 2xl:pointer-events-auto py-4 xl:py-5">
                <div class="mb-6 block xl:hidden">
                    <div class="w-full h-full flex items-center justify-center">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}" class="h-9 xl:h-14 w-auto">
                        </a>
                    </div>
                </div>
                <div class="w-full xl:pointer-events-auto" id="__sidebarNavigationWrapper">
                    <div class="px-3">
                        <x-sidebar.nav-wrapper>
                            <x-sidebar.nav-title>
                                Main
                            </x-sidebar.nav-title>
                            <x-sidebar.nav-item :active="request()->routeIs('dashboard')">
                                <x-sidebar.nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                    <i class="bi bi-speedometer2"></i>
                                    <span class="ml-2 relative top-[0.05rem]">
                                        Dashboard
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>

                            @if (Auth::user()->can('user.manage'))
                                <x-sidebar.nav-title>
                                    Management
                                </x-sidebar.nav-title>
                                <x-sidebar.nav-item :active="request()->routeIs('user.*')">
                                    <x-sidebar.nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.*')">
                                        <i class="bi bi-people"></i>
                                        <span class="ml-2 relative top-[0.05rem]">
                                            User
                                        </span>
                                    </x-sidebar.nav-link>
                                </x-sidebar.nav-item>
                            @endif

                            {{-- <x-sidebar.nav-item :active="false" x-data="{ subnavOpen: false }">
                                <x-sidebar.nav-link href="#" :active="false" x-on:click="subnavOpen = !subnavOpen">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 bi bi-arrow-down-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <span class="ml-2 relative top-[0.05rem]">
                                    Parent Menu
                                </span>
                                    <span class="absolute left-auto right-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-3 h-3 bi bi-caret-down" viewBox="0 0 16 16">
                                        <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                                    </svg>
                                </span>
                                </x-sidebar.nav-link>
                                <x-sidebar.subnav-wrapper :active="false" x-show="subnavOpen">
                                    <x-sidebar.subnav-item>
                                        <x-sidebar.subnav-link href="#" :active="false">
                                            Child Menu 1
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                    <x-sidebar.subnav-item>
                                        <x-sidebar.subnav-link href="#" :active="false">
                                            Child Menu 2
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                    <x-sidebar.subnav-item>
                                        <x-sidebar.subnav-link href="#" :active="false">
                                            Child Menu 2
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                </x-sidebar.subnav-wrapper>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item :active="false">
                                <x-sidebar.nav-link href="#" :active="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                    </svg>
                                    <span class="ml-2 relative top-[0.05rem]">
                                        Settings
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item> --}}
                        </x-sidebar.nav-wrapper>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/3 xl:hidden">
            <button type="button" class="px-6 py-4 border-0 bg-white text-gray-800 outline-none focus:outline-none" x-on:click="sidebarOpen = true">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>
        </div>
        <div class="w-1/3 xl:w-60 xl:z-30 xl:pointer-events-auto xl:bg-white">
            <div class="w-full h-full flex items-center justify-center">
                <a href="{{ route('dashboard') }}" class="py-2">
                    <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
                </a>
            </div>
        </div>
        <div class="relative w-1/3 xl:w-60 xl:pt-2 xl:z-30 xl:pointer-events-auto xl:bg-white" x-data="{ dropdownOpen: false }">
            <div class="w-full flex justify-end xl:justify-start">
                <button type="button" class="xl:w-full h-9 xl:h-auto px-7 xl:px-5 py-2 bg-transparent xl:hover:bg-blue-100 border-0 inline-flex xl:flex-col items-center xl:items-start outline-none focus:outline-none cursor-pointer" x-on:click="dropdownOpen = !dropdownOpen" x-on:click.away="dropdownOpen = false">
                    <div class="xl:inline-flex xl:items-center">
                        <div class="relative">
                            <img src="{{ asset('img/avatar.png') }}" alt="{{ Auth::user()->name }}" class="w-8 xl:w-10 h-8 xl:h-10 rounded-full">
                        </div>
                        <div class="hidden xl:block ml-2 xl:ml-4 text-left">
                            <span class="block text-gray-800 font-bold whitespace-nowrap">
                                {{ Str::limit(ucwords(Auth::user()->name), 20) }}
                            </span>
                            <span class="text-gray-500 text-xs">
                                {{ Auth::user()->roles->first()->name ?? '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="hidden xl:w-full xl:flex xl:justify-center xl:mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 bi bi-chevron-compact-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                        </svg>
                    </div>
                </button>
            </div>

            <div class="absolute xl:relative top-10 xl:top-0 right-6 xl:right-0 2xl:right-0 left-auto w-48 xl:w-full py-1 border border-solid border-gray-300 shadow-lg bg-white z-10" style="display: none" x-show="dropdownOpen" x-transition>
                <div class="px-5 py-4 text-gray-800 no-underline xl:hidden">
                    <span class="font-bold">
                        {{ Str::limit(ucwords(Auth::user()->name), 20) }}
                    </span>
                </div>
                <a href="#" class="block px-5 py-2 text-gray-800 hover:bg-gray-100 no-underline">
                    My Profile
                </a>
                <hr class="w-full border border-r-0 border-b-0 border-l-0 border-gray-200 my-1">
                <a href="{{ route('logout') }}" class="block px-5 py-2 text-gray-800 hover:bg-gray-100 no-underline">
                    Logout
                </a>
            </div>
        </div>
    </nav>
</header>
