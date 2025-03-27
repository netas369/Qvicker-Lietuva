<div class="md:flex md:justify-center md:w-full">
    <!-- Responsive Tabs Navigation -->
    <div class="bg-white rounded-xl border-b shadow-sm max-w-4xl mt-4 px-4 sm:px-10">
        <div class="mx-auto">
            <!-- Mobile Dropdown Menu (visible on small screens only) -->
            <div class="sm:hidden py-2">
                <select id="mobileNavigation" onchange="navigateTo(this.value)" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary focus:outline-none focus:ring-primary">
                    <option value="{{ route('myprofile') }}" {{ Route::currentRouteName() == 'myprofile' ? 'selected' : '' }}>Profilis</option>

                    @if($user && $user->role === 'provider')
                        <option value="{{ route('provider.work') }}" {{ Route::currentRouteName() == 'provider.work' ? 'selected' : '' }}>Darbas</option>
                        <option value="{{ route('provider.calendar') }}" {{ Route::currentRouteName() == 'provider.calendar' ? 'selected' : '' }}>Kalendorius</option>
                        <option value="{{ route('reservations.provider') }}" {{ Route::currentRouteName() == 'reservations.provider' ? 'selected' : '' }}>Gautos užklausos</option>
                        <option value="{{ route('reservations.seeker') }}" {{ Route::currentRouteName() == 'reservations.seeker' ? 'selected' : '' }}>Mano užklausos</option>
                    @else
                        <option value="{{ route('reservations.seeker') }}" {{ Route::currentRouteName() == 'reservations.seeker' ? 'selected' : '' }}>Mano užklausos</option>
                    @endif
                </select>
            </div>

            <!-- Desktop Navigation (hidden on small screens) -->
            <div class="hidden sm:block overflow-x-auto pb-1">
                <nav class="flex flex-nowrap min-w-full whitespace-nowrap">
                    <a href="{{ route('myprofile') }}"
                       class="flex-shrink-0 py-4 px-1 border-b-2 font-medium text-base md:text-lg transition duration-150 ease-in-out
                   {{ Route::currentRouteName() == 'myprofile'
                      ? 'border-primary-light text-primary-light'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Profilis</span>
                        </div>
                    </a>


                    @if($user && $user->role === 'provider')
                        <a href="{{ route('provider.work') }}"
                           class="flex-shrink-0 py-4 px-1 border-b-2 font-medium text-base md:text-lg transition duration-150 ease-in-out ml-8 md:ml-12
                       {{ Route::currentRouteName() == 'provider.work'
                          ? 'border-primary-light text-primary-light'
                          : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <div class="flex items-center justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Darbas</span>
                            </div>
                        </a>

                        <a href="{{ route('provider.calendar') }}"
                           class="flex-shrink-0 py-4 px-1 border-b-2 font-medium text-base md:text-lg transition duration-150 ease-in-out ml-8 md:ml-12
                       {{ Route::currentRouteName() == 'provider.calendar'
                          ? 'border-primary-light text-primary-light'
                          : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <div class="flex items-center justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Kalendorius</span>
                            </div>
                        </a>

                        <a href="{{ route('reservations.provider') }}"
                           class="flex-shrink-0 py-4 px-1 border-b-2 font-medium text-base md:text-lg transition duration-150 ease-in-out ml-8 md:ml-12
                       {{ Route::currentRouteName() == 'reservations.provider'
                          ? 'border-primary-light text-primary-light'
                          : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <div class="flex items-center justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span>Užklausos</span>
                            </div>
                        </a>

                    @else
                        <a href="{{ route('reservations.seeker') }}"
                           class="flex-shrink-0 py-4 px-1 border-b-2 font-medium text-base md:text-lg transition duration-150 ease-in-out ml-8 md:ml-12
                   {{ Route::currentRouteName() == 'reservations.seeker'
                      ? 'border-primary-light text-primary-light'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <div class="flex items-center justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span>Užklausos</span>
                            </div>
                        </a>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    function navigateTo(url) {
        window.location.href = url;
    }
</script>
