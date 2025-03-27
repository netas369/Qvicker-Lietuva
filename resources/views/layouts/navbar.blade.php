<nav style="position: sticky; top: 0; z-index: 50; padding: 1rem; display: flex; justify-content: space-between; align-items: center; background-color: white; border-bottom: 1px solid #e5e7eb; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); transition: opacity 0.3s ease;">
<a class="text-3xl font-bold leading-none" href="/">
        <p class="text-primary-light font-bold sm:text-3xl text-2xl">WORK<span class="text-primary">LINK</span><span><small class="text-gray-600 text-xs ml-1">beta</small></span></p>
{{--        <img src="{{ asset('images/worklinklogo.png') }}" alt="logo" class="h-10">--}}
    </a>


    <div class="lg:hidden flex items-center gap-2">
        @auth
            <!-- Mobile notification bell -->
            <div class="relative">
                @livewire('navbar-notifications')
            </div>
        @endauth

        <button class="navbar-burger flex items-center text-blue-600 p-3 hover:bg-gray-50 transition duration-200">
            <svg class="block h-6 w-6 fill-primary" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Mobile menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </button>
    </div>
    <ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
        <li><a class="text-md text-primary {{ request()->is('/') ? 'font-bold' : 'font-normal' }} hover:text-primary-light" href="/">Pagrindinis</a></li>
        <li><a class="text-md text-primary {{ request()->is('partners') ? 'font-bold' : 'font-normal' }} hover:text-primary-light" href="/partners">Paslaugų teikėjams</a></li>
        <li><a class="text-md text-primary {{ request()->is('kontaktai') ? 'font-bold' : 'font-normal' }} hover:text-primary-light" href="#">Kontaktai</a></li>
        <li><a class="text-md text-primary {{ request()->is('duk') ? 'font-bold' : 'font-normal' }} hover:text-primary-light" href="#">DUK</a></li>
{{--        <li><a class="text-md text-primary-light {{ request()->is('apiemus') ? 'font-bold' : 'font-normal' }} hover:text-gray-500" href="#">Apie Mus</a></li>--}}
    </ul>

    @guest
        <div class="hidden lg:flex lg:items-center lg:gap-4">
            <a href="/login" class="flex items-center px-4 py-1 space-x-2 font-semibold transition-all duration-150 ease-out border-2 rounded-lg text-primary border-primary/20 hover:border-primary/40 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-primary/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Prisijungti</span>
            </a>

            <a href="/register/" class="flex items-center px-4 py-1 space-x-2 font-semibold text-white transition-all duration-150 ease-out rounded-lg bg-gradient-to-br from-primary to-primary-dark hover:to-primary/90 hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-primary/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                <span>Registruotis</span>
            </a>
        </div>
    @endguest

    @auth
        <div class="hidden lg:flex lg:items-center lg:gap-3 lg:ml-auto lg:mr-3">
            <!-- Notification component -->
            <div class="relative">
                @livewire('navbar-notifications')
            </div>

            <!-- User profile dropdown -->
            <div class="relative group">
                <!-- User avatar button -->
                <button class="flex items-center focus:outline-none">
                    <div class="w-10 h-10 rounded-full border-2 border-primary bg-primary-light flex items-center justify-center hover:bg-primary-verylight transition duration-200">
                        @if(auth()->user()->profile_photo_url)
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="User Profile Photo" class="w-full h-full rounded-full object-cover">
                        @else
                            <!-- Fallback icon if no profile photo is set -->
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @endif
                    </div>
                </button>

                <!-- Dropdown menu -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 invisible opacity-0 group-focus-within:visible group-focus-within:opacity-100 group-hover:visible group-hover:opacity-100 transition-all duration-200">
                    <!-- Role display -->
                    <div class="px-4 py-2 border-b border-gray-100">
                        <div class="text-xs font-medium text-primary-dark">Logged in as</div>
                        <div class="text-sm font-semibold text-gray-700 truncate">{{ auth()->user()->role }}</div>
                    </div>

                    <a href="/profile" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                        Profilis
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                            Atsijungti
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endauth

</nav>
<div class="navbar-menu fixed inset-0 z-50 hidden transform -translate-x-full transition-transform duration-300 ease-in-out bg-white">
    <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-50"></div>
    <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
        <div class="flex items-center mb-8">
            <a class="mr-auto text-3xl font-bold leading-none" href="#">
                <p class="text-primary-light font-bold sm:text-3xl text-2xl">WORK<span class="text-primary">LINK</span><span><small class="text-gray-600 text-xs ml-1">beta</small></span></p>
            </a>
            <button class="navbar-close">
                <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div>
            <ul>
                <li class="mb-1">
                    <a class="block p-4 rounded font-bold {{ request()->is('/') ? 'text-primary text-xl' : 'text-gray-700 text-lg hover:bg-gray-50' }}" href="/">Pagrindinis</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 rounded font-bold {{ request()->is('partners') ? 'text-primary text-xl' : 'text-gray-700 text-lg hover:bg-gray-50' }}" href="/partners">Paslaugų Teikėjams</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 rounded font-bold {{ request()->is('kontaktai') ? 'text-primary text-xl' : 'text-gray-700 text-lg hover:bg-gray-50' }}" href="/kontaktai">Kontaktai</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 rounded font-bold {{ request()->is('duk') ? 'text-primary text-xl' : 'text-gray-700 text-lg hover:bg-gray-50' }}" href="/duk">DUK</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 rounded font-bold {{ request()->is('apiemus') ? 'text-primary text-xl' : 'text-gray-700 text-lg hover:bg-gray-50' }}" href="/apiemus">Apie Mus</a>
                </li>
            </ul>
        </div>
        <div class="mt-auto">

            @guest
                <div class="pt-6">
                    <a href="/login" class="flex items-center px-6 py-4 mb-4 font-semibold transition-all duration-150 ease-out border-2 rounded-lg text-primary border-primary/20 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span>Prisijungti</span>
                    </a>

                    <a href="/register/" class="flex items-center px-6 py-4 font-semibold text-white transition-all duration-150 ease-out rounded-lg bg-gradient-to-br from-primary to-primary-dark hover:to-primary/90 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span>Registruotis</span>
                    </a>
                </div>
            @endguest

            @auth

                    <a href="{{ route('myprofile') }}" class="flex justify-center items-center text-gray-900 text-lg px-4 py-3 hover:bg-gray-50 font-bold w-full">
                        Profilis
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-red-950 text-lg px-4 py-3 hover:bg-gray-50 font-bold">
                            Atsijungti
                        </button>
                    </form>
                    <div class="px-4 py-2 border-b border-gray-100">
                        <div class="text-sm font-medium text-primary-dark">Logged in as</div>
                        <div class="text-md font-semibold text-gray-700 truncate">{{ auth()->user()->role }}</div>
                    </div>
                @endauth
            <p class="my-4 text-xs text-center text-gray-400">
                <span>WorkLink 2025</span>
            </p>
        </div>
    </nav>
</div>

<script>
    // Burger menus
    document.addEventListener('DOMContentLoaded', function() {
        const burger = document.querySelector('.navbar-burger');
        const menu = document.querySelector('.navbar-menu');
        const close = document.querySelector('.navbar-close');
        const backdrop = document.querySelector('.navbar-backdrop');

        if (burger && menu) {
            burger.addEventListener('click', () => {
                menu.classList.remove('hidden');
                menu.classList.remove('-translate-x-full');
                menu.classList.add('translate-x-0');
            });
        }

        if (close && menu) {
            close.addEventListener('click', () => {
                menu.classList.add('-translate-x-full');
                menu.classList.remove('translate-x-0');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 300); // Match the duration of the slide transition
            });
        }

        if (backdrop && menu) {
            backdrop.addEventListener('click', () => {
                menu.classList.add('-translate-x-full');
                menu.classList.remove('translate-x-0');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 300);
            });
        }
    });
</script>
