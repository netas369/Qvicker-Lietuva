<nav style="position: sticky; top: 0; z-index: 50; padding: 1rem; display: flex; justify-content: space-between; align-items: center; background-color: white; border-bottom: 1px solid #e5e7eb; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); transition: opacity 0.3s ease;">
    <a class="text-3xl font-bold leading-none" href="/">
        <p class="text-primary-light font-bold sm:text-3xl text-2xl">Q<span class="text-primary">vicker</span><span><small class="text-gray-600 text-xs ml-1">LT</small></span></p>
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
        <li><a class="text-md text-primary {{ request()->is('partners') ? 'font-bold' : 'font-normal' }} hover:text-primary-light" href="/partners">Partneriams</a></li>
        <li><a class="text-md text-primary {{ request()->is('seekers') ? 'font-bold' : 'font-normal' }} hover:text-primary-light" href="/seekers">Naudotojams</a></li>
        @if(auth()->user()->role == 'provider')
        <li><a class="text-md text-primary {{ request()->is('provider/support') ? 'font-bold' : 'font-normal' }} hover:text-primary-light" href="/provider/support">Pagalba</a></li>
        @endif
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
                <button class="flex items-center focus:outline-none group">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-full border-2 border-gray-200 bg-gray-100 flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:border-primary group-hover:shadow-lg group-hover:scale-105">
                            @if(auth()->user()->profile_photo_url)
                                <img src="{{ auth()->user()->profile_photo_url }}" alt="User Profile Photo" class="w-full h-full object-cover">
                            @else
                                <!-- Fallback to initials if no profile photo is set -->
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary to-primary-dark text-white text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1) . (auth()->user()->lastname ? substr(auth()->user()->lastname, 0, 1) : '')) }}
                                </div>
                            @endif
                        </div>
                        <!-- Online indicator -->
                        <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                </button>

                <!-- Dropdown menu -->
                <div class="absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 invisible opacity-0 group-focus-within:visible group-focus-within:opacity-100 group-hover:visible group-hover:opacity-100 transition-all duration-200 transform origin-top-right scale-95 group-hover:scale-100 max-h-[85vh] overflow-hidden flex flex-col">
                    <!-- User info header -->
                    <div class="px-6 py-5 bg-gradient-to-br from-primary/10 via-primary/5 to-transparent rounded-t-2xl border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-14 h-14 rounded-full border-2 border-white shadow-lg bg-white flex items-center justify-center overflow-hidden">
                                @if(auth()->user()->profile_photo_url)
                                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary to-primary-dark text-white text-sm font-bold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1) . (auth()->user()->lastname ? substr(auth()->user()->lastname, 0, 1) : '')) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-sm text-gray-600">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                                <div class="mt-1 inline-flex items-center px-2.5 py-1 bg-primary/10 rounded-full">
                                    <div class="w-2 h-2 bg-primary rounded-full mr-2 animate-pulse"></div>
                                    <span class="text-xs font-medium text-primary capitalize">{{ auth()->user()->role }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scrollable menu items -->
                    <div class="overflow-y-auto flex-1">
                        <!-- Profile Section -->
                        <div class="p-2">
                            <div class="px-3 py-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Vartotojas</div>
                            <a href="/profile" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-150 group/item">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3 group-hover/item:bg-blue-100 transition-colors">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium">Mano profilis</span>
                                    <p class="text-xs text-gray-500">Peržiūrėti ir redaguoti</p>
                                </div>
                            </a>

                            <a href="/dashboard" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-150 group/item">
                                <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center mr-3 group-hover/item:bg-purple-100 transition-colors">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium">Valdymo skydas</span>
                                    <p class="text-xs text-gray-500">Statistika ir apžvalga</p>
                                </div>
                            </a>
                        </div>

                        <!-- Work Section -->
                        <div class="border-t border-gray-100 p-2">
                            <div class="px-3 py-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Darbas</div>
                            @if(auth()->user()->role === 'provider')
                                <a href="/provider/work" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-150 group/item">
                                    <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center mr-3 group-hover/item:bg-green-100 transition-colors">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <span class="font-medium">Mano paslaugos</span>
                                        <p class="text-xs text-gray-500">Valdyti paslaugas</p>
                                    </div>
                                </a>
                            @endif

                            @if(auth()->user()->role === 'provider')
                                <a href="/provider-reservations" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-150 group/item">
                                    @elseif(auth()->user()->role === 'seeker')
                                        <a href="/my-reservations" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-150 group/item">
                                            @endif
                                <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center mr-3 group-hover/item:bg-orange-100 transition-colors">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium">Užsakymai</span>
                                    <p class="text-xs text-gray-500">Istorija ir būsena</p>
                                </div>
                            </a>
                        </div>

                        <!-- Settings Section -->
                        <div class="border-t border-gray-100 p-2">
                            <div class="px-3 py-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nustatymai</div>

                            <a href="/provider/support" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-150 group/item">
                                <div class="w-8 h-8 rounded-lg bg-pink-50 flex items-center justify-center mr-3 group-hover/item:bg-pink-100 transition-colors">
                                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium">Pagalba</span>
                                    <p class="text-xs text-gray-500">Palaikymas ir DUK</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Bottom section with logout -->
                    <div class="border-t border-gray-100 p-3 bg-gray-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-all duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Atsijungti</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    @endauth
</nav>

<!-- Mobile Menu Overlay -->
<div class="navbar-menu fixed inset-0 z-50 hidden transform -translate-x-full transition-transform duration-300 ease-in-out">
    <!-- Backdrop -->
    <div class="navbar-backdrop fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>

    <!-- Menu Panel -->
    <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm bg-white shadow-2xl overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-primary/5 to-primary/10 px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <a href="/" class="flex-1">
                    <p class="text-primary-light font-bold text-2xl">
                        Q<span class="text-primary">vicker</span>
                        <span class="inline-block ml-1">
                            <small class="text-gray-600 text-xs font-medium bg-gray-100 px-2 py-0.5 rounded-full">LT</small>
                        </span>
                    </p>
                </a>
                <button class="navbar-close p-2 rounded-lg hover:bg-white/50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- User Info Section (if authenticated) -->
        @auth
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full border-2 border-primary/20 bg-gray-200 flex items-center justify-center overflow-hidden">
                        @if(auth()->user()->profile_photo_url)
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-primary font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1) . (auth()->user()->lastname ? substr(auth()->user()->lastname, 0, 1) : '')) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto py-4">
            <!-- Main Navigation -->
            <ul class="space-y-1 px-3">
                <li>
                    <a href="/" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->is('/') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Pagrindinis</span>
                    </a>
                </li>
                <li>
                    <a href="/partners" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->is('partners') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Partneriams</span>
                    </a>
                </li>
                <li>
                    <a href="/seekers" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->is('seekers') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="font-medium">Naudotojams</span>
                    </a>
                </li>
                <li>
                    <a href="/duk" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->is('duk') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">DUK</span>
                    </a>
                </li>
                <li>
                    <a href="/apiemus" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->is('apiemus') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Apie Mus</span>
                    </a>
                </li>
            </ul>

            @auth
                <!-- Divider -->
                <div class="mx-6 my-4 border-t border-gray-200"></div>

                <!-- User Profile Section -->
                <div class="px-3 mb-4">
                    <div class="px-3 py-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Vartotojas</div>
                    <ul class="space-y-1">
                        <li>
                            <a href="/profile" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium text-sm">Mano profilis</span>
                                    <p class="text-xs text-gray-500">Peržiūrėti ir redaguoti</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium text-sm">Valdymo skydas</span>
                                    <p class="text-xs text-gray-500">Statistika ir apžvalga</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Work Section -->
                <div class="px-3 mb-4">
                    <div class="px-3 py-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Darbas</div>
                    <ul class="space-y-1">
                        <li>
                            @if(auth()->user()->role === 'provider')
                            <a href="/provider/work" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium text-sm">Mano paslaugos</span>
                                    <p class="text-xs text-gray-500">Valdyti paslaugas</p>
                                </div>
                            </a>
                            @endif
                        </li>
                        <li>
                            @if(auth()->user()->role === 'provider')
                            <a href="/provider-reservations" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                @elseif(auth()->user()->role === 'seeker')
                                    <a href="/my-reservations" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                    @endif
                                <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium text-sm">Užsakymai</span>
                                    <p class="text-xs text-gray-500">Istorija ir būsena</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Settings Section -->
                <div class="px-3 mb-4">
                    <div class="px-3 py-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nustatymai</div>
                    <ul class="space-y-1">
                        <li>
                            <a href="/help" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                <div class="w-8 h-8 rounded-lg bg-pink-50 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="font-medium text-sm">Pagalba</span>
                                    <p class="text-xs text-gray-500">Palaikymas ir DUK</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Logout Section -->
                <ul class="space-y-1 px-3">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-200">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="font-medium">Atsijungti</span>
                            </button>
                        </form>
                    </li>
                </ul>
            @endauth
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-gray-200 px-6 py-4">
            @guest
                <div class="space-y-3">
                    <a href="/login" class="flex items-center justify-center px-4 py-3 border-2 border-primary/20 rounded-lg text-primary font-semibold hover:bg-primary/5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Prisijungti
                    </a>
                    <a href="/register/" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-primary to-primary-dark text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Registruotis
                    </a>
                </div>
            @endguest

            <!-- Footer -->
            <p class="mt-4 text-xs text-center text-gray-400">
                © Qvicker 2025
            </p>
        </div>
    </nav>
</div>

<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const burger = document.querySelector('.navbar-burger');
        const menu = document.querySelector('.navbar-menu');
        const close = document.querySelector('.navbar-close');
        const backdrop = document.querySelector('.navbar-backdrop');

        function openMenu() {
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('-translate-x-full');
                menu.classList.add('translate-x-0');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            menu.classList.add('-translate-x-full');
            menu.classList.remove('translate-x-0');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }

        if (burger) {
            burger.addEventListener('click', openMenu);
        }

        if (close) {
            close.addEventListener('click', closeMenu);
        }

        if (backdrop) {
            backdrop.addEventListener('click', closeMenu);
        }

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                closeMenu();
            }
        });
    });
</script>
