<div class="md:flex md:justify-center md:w-full">
    <!-- Responsive Tabs Navigation -->
    <div class="bg-white rounded-xl border-b shadow-sm max-w-4xl mt-4 px-4 sm:px-10">
        <div class="mx-auto">

            <!-- Mobile Horizontal Scrollable Tabs (visible on small screens only) -->
            <div class="sm:hidden py-3" x-data="mobileNavScroller()" x-init="init()">
                <div class="relative">
                    <!-- Left fade gradient + arrow -->
                    <div x-show="showLeftArrow"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="absolute left-0 top-0 bottom-0 z-10 flex items-center">
                        <!-- Gradient fade -->
                        <div class="absolute left-0 top-0 bottom-0 w-12 bg-gradient-to-r from-white via-white/80 to-transparent pointer-events-none"></div>
                        <!-- Arrow button -->
                        <button @click="scrollLeft()"
                                type="button"
                                class="relative z-10 flex items-center justify-center w-8 h-8 bg-white rounded-full shadow-md border border-gray-200 hover:bg-gray-50 active:scale-95 transition-all ml-1">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Right fade gradient + arrow -->
                    <div x-show="showRightArrow"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="absolute right-0 top-0 bottom-0 z-10 flex items-center">
                        <!-- Gradient fade -->
                        <div class="absolute right-0 top-0 bottom-0 w-12 bg-gradient-to-l from-white via-white/80 to-transparent pointer-events-none"></div>
                        <!-- Arrow button -->
                        <button @click="scrollRight()"
                                type="button"
                                class="relative z-10 flex items-center justify-center w-8 h-8 bg-white rounded-full shadow-md border border-gray-200 hover:bg-gray-50 active:scale-95 transition-all mr-1">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Scrollable nav container -->
                    <div x-ref="scroller"
                         @scroll="updateArrows()"
                         class="overflow-x-auto mobile-nav-scrollbar scroll-smooth">
                        <nav class="flex flex-nowrap gap-2 pb-2 px-1">

                            <a href="{{ route('profile.dashboard') }}"
                               @if(Route::currentRouteName() == 'profile.dashboard') x-ref="activeTab" @endif
                               class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                               {{ Route::currentRouteName() == 'profile.dashboard'
                                  ? 'bg-primary-light text-white shadow-md'
                                  : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span>Apžvalga</span>
                            </a>

                            <a href="{{ route('myprofile') }}"
                               @if(Route::currentRouteName() == 'myprofile') x-ref="activeTab" @endif
                               class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                               {{ Route::currentRouteName() == 'myprofile'
                                  ? 'bg-primary-light text-white shadow-md'
                                  : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Profilis</span>
                            </a>

                            @if($user && $user->role === 'provider')
                                <a href="{{ route('provider.work') }}"
                                   @if(Route::currentRouteName() == 'provider.work') x-ref="activeTab" @endif
                                   class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                                   {{ Route::currentRouteName() == 'provider.work'
                                      ? 'bg-primary-light text-white shadow-md'
                                      : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Darbas</span>
                                </a>

                                <a href="{{ route('provider.calendar') }}"
                                   @if(Route::currentRouteName() == 'provider.calendar') x-ref="activeTab" @endif
                                   class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                                   {{ Route::currentRouteName() == 'provider.calendar'
                                      ? 'bg-primary-light text-white shadow-md'
                                      : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Kalendorius</span>
                                </a>

                                <a href="{{ route('reservations.provider') }}"
                                   @if(Route::currentRouteName() == 'reservations.provider') x-ref="activeTab" @endif
                                   class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                                   {{ Route::currentRouteName() == 'reservations.provider'
                                      ? 'bg-primary-light text-white shadow-md'
                                      : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    <span>Užklausos</span>
                                </a>
                            @else
                                <a href="{{ route('reservations.seeker') }}"
                                   @if(Route::currentRouteName() == 'reservations.seeker') x-ref="activeTab" @endif
                                   class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                                   {{ Route::currentRouteName() == 'reservations.seeker'
                                      ? 'bg-primary-light text-white shadow-md'
                                      : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <span>Užklausos</span>
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Desktop Navigation (hidden on small screens) -->
            <div class="hidden sm:block overflow-x-auto pb-1">
                <nav class="flex flex-nowrap min-w-full whitespace-nowrap">

                    <a href="{{ route('profile.dashboard') }}"
                       class="flex-shrink-0 py-4 px-1 border-b-2 font-medium text-base md:text-lg transition duration-150 ease-in-out
            {{ Route::currentRouteName() == 'profile.dashboard'
                 ? 'border-primary-light text-primary-light'
                 : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Apžvalga</span>
                        </div>
                    </a>

                    <a href="{{ route('myprofile') }}"
                       class="flex-shrink-0 py-4 px-1 border-b-2 font-medium text-base md:text-lg transition duration-150 ease-in-out ml-8 md:ml-12
           {{ Route::currentRouteName() == 'myprofile'
              ? 'border-primary-light text-primary-light'
              : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
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

<style>
    /* Mobile navigation scrollbar - hidden but functional */
    .mobile-nav-scrollbar {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .mobile-nav-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

<script>
    function mobileNavScroller() {
        return {
            showLeftArrow: false,
            showRightArrow: false,

            init() {
                this.$nextTick(() => {
                    // First scroll to active tab
                    this.scrollToActive();
                    // Then update arrow visibility
                    setTimeout(() => this.updateArrows(), 100);
                });

                // Update on resize
                window.addEventListener('resize', () => this.updateArrows());
            },

            scrollToActive() {
                const scroller = this.$refs.scroller;
                const activeTab = this.$refs.activeTab;

                if (scroller && activeTab) {
                    // Calculate position to center the active tab
                    const scrollerRect = scroller.getBoundingClientRect();
                    const activeRect = activeTab.getBoundingClientRect();

                    const scrollLeft = activeTab.offsetLeft - (scrollerRect.width / 2) + (activeRect.width / 2);

                    scroller.scrollTo({
                        left: Math.max(0, scrollLeft),
                        behavior: 'instant' // Use instant on load to avoid jarring animation
                    });
                }
            },

            updateArrows() {
                const scroller = this.$refs.scroller;
                if (!scroller) return;

                const isScrollable = scroller.scrollWidth > scroller.clientWidth;

                if (!isScrollable) {
                    this.showLeftArrow = false;
                    this.showRightArrow = false;
                    return;
                }

                const isAtStart = scroller.scrollLeft <= 5;
                const isAtEnd = scroller.scrollLeft >= scroller.scrollWidth - scroller.clientWidth - 5;

                this.showLeftArrow = !isAtStart;
                this.showRightArrow = !isAtEnd;
            },

            scrollLeft() {
                const scroller = this.$refs.scroller;
                if (scroller) {
                    scroller.scrollBy({ left: -150, behavior: 'smooth' });
                    setTimeout(() => this.updateArrows(), 300);
                }
            },

            scrollRight() {
                const scroller = this.$refs.scroller;
                if (scroller) {
                    scroller.scrollBy({ left: 150, behavior: 'smooth' });
                    setTimeout(() => this.updateArrows(), 300);
                }
            }
        }
    }
</script>
