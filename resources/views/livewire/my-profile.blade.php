<div>
    <div class="mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden">
            @if (session()->has('message'))
                <div
                    id="session-message"
                    class="fixed top-4 right-4 z-50 max-w-md animate-slide-in"
                >
                    <div class="bg-white rounded-xl shadow-2xl border-l-4 border-green-500 p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-semibold text-gray-900">Sėkmingai atnaujinta!</p>
                                <p class="mt-1 text-sm text-gray-600">{{ session('message') }}</p>
                            </div>
                            <button
                                onclick="document.getElementById('session-message').remove()"
                                class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <style>
                    @keyframes slide-in {
                        from {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }

                    .animate-slide-in {
                        animation: slide-in 0.3s ease-out;
                    }
                </style>

                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('session-message');
                        if (msg) {
                            msg.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                            msg.style.opacity = '0';
                            msg.style.transform = 'translateX(100%)';
                            setTimeout(() => msg.remove(), 300);
                        }
                    }, 5000);
                </script>
            @endif

            <!-- Header Section with Gradient -->
            <div class="py-2 px-6 text-primary-light border-b-2">
                <h1 class="text-2xl md:text-3xl font-bold mb-4 mt-4">Mano Profilis</h1>
            </div>

            <!-- Main Content -->
            <div class="p-6 md:p-8">
                <!-- Main Profile Form (without password) -->
                <form wire:submit.prevent="updateProfile" autocomplete="off" class="space-y-6 md:space-y-8">
                    <div class="w-full">
                        <!-- Mobile: Side by side layout -->
                        <div class="flex flex-row gap-4 md:grid md:grid-cols-12 md:gap-6">
                            <!-- Profile Picture Section -->
                            <div class="flex-shrink-0 md:col-span-4 flex flex-col items-center">
                                <div class="mb-3 md:mb-4">
                                    <!-- Current Profile Picture -->
                                    <div wire:loading.remove wire:target="image">
                                        @if(auth()->user()->image)
                                            <div class="relative group">
                                                <img src="{{ auth()->user()->profile_photo_url }}"
                                                     class="w-28 h-28 sm:w-48 sm:h-48 md:w-48 md:h-48 rounded-full object-cover border-4 border-white shadow-lg"
                                                     alt="Current profile photo">
                                            </div>
                                        @else
                                            <div class="relative group">
                                                <div class="w-24 h-24 sm:w-28 sm:h-28 md:w-40 md:h-40 rounded-full flex items-center justify-center bg-gradient-to-br from-primary-light to-primary-verylight text-white text-2xl sm:text-3xl md:text-4xl font-bold border-4 border-white shadow-lg">
                                                    {{ strtoupper(substr(auth()->user()->name, 0, 1) . substr(auth()->user()->lastname, 0, 1)) }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Loading State -->
                                    <div wire:loading wire:target="image"
                                         class="w-24 h-24 sm:w-28 sm:h-28 md:w-40 md:h-40 rounded-full flex items-center justify-center bg-gray-100 border-4 border-white shadow-lg">
                                        <svg class="animate-spin h-6 w-6 sm:h-8 sm:w-8 md:h-10 md:w-10 text-primary-light"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Upload Button - Hidden on mobile, shown below on mobile -->
                                <input type="file" id="image-input" class="hidden" accept="image/*">
                                <label for="image-input"
                                       class="hidden md:inline-flex cursor-pointer items-center justify-center px-4 py-2 min-h-[44px] bg-primary-light border border-transparent rounded-xl text-sm font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light transition-all duration-200 shadow-md hover:shadow-lg active:scale-95">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ auth()->user()->image ? 'Pakeisti Nuotrauką' : 'Įkelti Nuotrauką' }}
                                </label>

                                @error('image')
                                <p class="text-red-500 text-xs mt-2 bg-red-50 p-2 rounded-lg text-center hidden md:block">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Profile Info Section -->
                            <div class="flex-1 md:col-span-8">
                                <div class="md:p-4">
                                    <!-- Name -->
                                    <p class="text-primary-light text-base sm:text-lg md:text-2xl lg:text-3xl font-bold mb-2 md:mb-4 break-words">
                                        {{ ucfirst($this->name) . ' '. ucfirst($this->lastname) }}
                                    </p>

                                    @if($this->user->role == 'provider')
                                        <!-- Star Rating Display -->
                                        <div class="flex flex-wrap items-center gap-1 sm:gap-2 mb-2 md:mb-4">
                                            <div class="flex text-yellow-400">
                                                <!-- Full Stars -->
                                                @for ($i = 1; $i <= floor($this->user->average_rating); $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 md:h-6 md:w-6" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor

                                                @php
                                                    $fraction = $this->user->average_rating - floor($this->user->average_rating);
                                                    $showHalfStar = $fraction > 0.25 && $fraction < 0.75;
                                                    $showFullStar = $fraction >= 0.75;
                                                    $totalStarsShown = floor($this->user->average_rating) + ($showHalfStar ? 1 : 0) + ($showFullStar ? 1 : 0);
                                                    $emptyStarsToShow = 5 - $totalStarsShown;
                                                @endphp

                                                @if ($showHalfStar)
                                                    <div class="relative">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 md:h-6 md:w-6" viewBox="0 0 20 20" fill="currentColor" style="color: #D1D5DB;">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                        <div class="absolute inset-0 overflow-hidden" style="width: 50%">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 md:h-6 md:w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @elseif ($showFullStar)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 md:h-6 md:w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endif

                                                @for ($i = 0; $i < $emptyStarsToShow; $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-8 sm:w-8 md:h-8 md:w-8" viewBox="0 0 20 20" fill="currentColor" style="color: #D1D5DB;">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                            </div>

                                            <span class="text-xs sm:text-sm text-gray-600 font-medium">
                                {{ number_format($this->user->average_rating, 1) }} ({{ $this->user->reviewsReceived()->count() }} {{ $this->user->reviewsReceived()->count() == 1 ? 'atsiliepimas' : 'atsiliepimai' }})
                            </span>
                                        </div>
                                    @endif

                                    @if($user->role == 'provider')
                                        <div class="inline-flex items-center text-xs sm:text-sm md:text-base bg-white rounded-lg md:rounded-xl p-2 sm:p-3 md:p-4 shadow-sm border border-gray-100">
                                            <div class="bg-primary-light p-1.5 sm:p-2 md:p-2.5 rounded-lg mr-2 sm:mr-3 flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 md:h-5 md:w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <p class="text-gray-700 font-medium">
                                                <span class="hidden sm:inline">Įvykdyti Užsakymai:</span>
                                                <span class="sm:hidden">Atlikti Užsakymai:</span>
                                                <span class="text-primary-light font-bold">{{$this->user->getTotalReservationsDone()}}</span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Upload Button - Full width below the row -->
                        <div class="mt-4 flex flex-col items-start sm:hidden">
                            <label for="image-input"
                                   class="cursor-pointer inline-flex items-center justify-center px-5 py-2.5 min-h-[44px] bg-primary-light border border-transparent rounded-xl text-sm font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light transition-all duration-200 shadow-md hover:shadow-lg active:scale-95">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ auth()->user()->image ? 'Pakeisti Nuotrauką' : 'Įkelti Nuotrauką' }}
                            </label>

                            @error('image')
                            <p class="text-red-500 text-xs mt-2 bg-red-50 p-2 rounded-lg text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Portfolio Photos Section (Only for providers) - Enhanced styling -->
                    @if($user->role == 'provider')
                        <div class="rounded-xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-light"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-primary-light font-bold text-lg md:text-xl">Mano Darbų Pavyzdžiai</h3>
                            </div>

                            <!-- Photo Grid -->
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-3">
                                <!-- Photo Upload Boxes -->
                                @for ($i = 0; $i < $maxPortfolioPhotos; $i++)
                                    <div
                                        class="relative aspect-square border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center bg-white hover:bg-gray-50 hover:border-primary-light transition-all duration-200 overflow-hidden shadow-sm">
                                        @if(isset($portfolioPhotos[$i]))
                                            <!-- If photo exists in this slot -->
                                            <div class="w-full h-full relative group">
                                                <img src="{{ Storage::url($portfolioPhotos[$i]['path']) }}"
                                                     class="w-full h-full object-cover" alt="Portfolio work">

                                                <!-- Mobile: Always visible delete button in corner -->
                                                <button type="button"
                                                        wire:click="removePortfolioPhoto({{ $i }})"
                                                        class="absolute top-2 right-2 p-1 rounded-full bg-red-500 hover:bg-red-600 text-white shadow-lg md:hidden z-10 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>

                                                <!-- Desktop: Hover overlay with delete button -->
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex items-center justify-center">
                                                    <button type="button"
                                                            wire:click="removePortfolioPhoto({{ $i }})"
                                                            class="text-white p-2 rounded-full bg-red-500 hover:bg-red-600 shadow-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Empty upload slot -->
                                            <label for="portfolio-photo-{{ $i }}"
                                                   class="flex flex-col items-center justify-center w-full h-full cursor-pointer group">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400 group-hover:text-primary-light transition-colors"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M12 4v16m8-8H4"/>
                                                </svg>
                                                <span
                                                    class="text-xs text-gray-500 group-hover:text-primary-light mt-2 text-center px-2 font-medium transition-colors">Pridėti nuotrauką</span>
                                                <input type="file" id="portfolio-photo-{{ $i }}"
                                                       wire:model="newPortfolioPhoto" class="hidden" accept="image/*">
                                            </label>
                                        @endif
                                    </div>
                                @endfor
                            </div>

                            <!-- Error Message -->
                            @error('newPortfolioPhoto')
                            <p class="text-red-500 text-xs mt-3 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                            @enderror

                            <!-- Loading Indicator -->
                            <div wire:loading wire:target="newPortfolioPhoto, removePortfolioPhoto" class="mt-4">
                                <div class="flex items-center text-sm text-gray-600 bg-blue-50 p-3 rounded-lg">
                                    <svg class="animate-spin h-4 w-4 mr-2 text-primary-light"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Apdorojama...
                                </div>
                            </div>

                            <!-- Success/Error Messages -->
                            @if (session()->has('message'))
                                <div class="text-sm text-green-600 mt-3 bg-green-50 p-2 rounded-lg">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="text-sm text-red-600 mt-3 bg-red-50 p-2 rounded-lg">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="space-y-4"
                         x-data="{
        previewMode: false,
        resize() {
            $nextTick(() => {
                const textarea = $refs.aboutMeTextarea;
                if (textarea) {
                    textarea.style.height = 'auto';
                    textarea.style.height = textarea.scrollHeight + 'px';
                }
            });
        }
     }"
                         x-init="
        resize();
        $watch('$wire.aboutMe', () => resize());
     "
                         @about-me-saved.window="resize()"
                    >
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center">
                                    <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                        <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Profesinis aprašymas</h2>
                                </div>

                                <button
                                    type="button"
                                    @click="previewMode = !previewMode; if(!previewMode) resize();"
                                    class="flex items-center px-3 py-1.5 text-sm font-medium rounded-lg transition-colors duration-200"
                                    :class="previewMode ? 'bg-primary-light text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                                >
                                    <svg x-show="!previewMode" class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="previewMode" class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span x-text="previewMode ? 'Redaguoti' : 'Peržiūrėti'"></span>
                                </button>
                            </div>

                            <!-- Combined saving indicator for both fields -->
                            <div x-show="!previewMode" class="flex items-center text-sm">
                                <div wire:loading wire:target="title, aboutMe" class="flex items-center text-blue-600">
                                    <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Saugoma...
                                </div>
                                <div
                                    x-data="{ show: false }"
                                    x-show="show"
                                    x-transition
                                    @about-me-saved.window="show = true; setTimeout(() => show = false, 2000)"
                                    @title-saved.window="show = true; setTimeout(() => show = false, 2000)"
                                    class="flex items-center text-green-600"
                                    style="display: none;"
                                >
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Išsaugota
                                </div>
                            </div>
                        </div>

                        <!-- Info box -->
                        <div class="bg-primary-dark/20 border-l-4 border-primary-dark rounded-xl p-4 shadow-sm">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-bold text-primary mb-2">
                                        @if($this->user->role === 'provider')
                                            ⚠️ Labai svarbu!
                                        @else
                                            Patarimas
                                        @endif
                                    </h3>
                                    <div class="text-sm text-primary space-y-2">
                                        @if($this->user->role === 'provider')
                                            <p class="leading-relaxed">
                                                <strong>Qvicker</strong> yra tarpusavio paslaugų platforma (P2P), kur klientai renka meistrus pagal jūsų aprašymą ir patirtį.
                                            </p>
                                        @else
                                            <p class="leading-relaxed">
                                                Apibūdinkite save - tai padės meistrams geriau suprasti jūsų poreikius.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Mode -->
                        <div x-show="!previewMode" class="space-y-4">
                            @if(auth()->user()->role === 'provider')
                                <div>
                                    <label for="title" class="block text-sm font-semibold text-primary mb-2">Titulinis</label>
                                    <input type="text"
                                           id="title"
                                           name="title"
                                           wire:model.live.debounce.500ms="title"
                                           class="w-full rounded-xl border-gray-300 shadow-sm bg-gray-50 text-gray-600 focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 @error('title') border-red-500 @enderror"
                                           placeholder="Jūsų teikiamų paslaugų pavadinimas..."
                                           maxlength="100">
                                    @error('title')
                                    <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500 mt-1 text-right">
                                        {{ strlen($title ?? '') }}/60 simbolių
                                    </p>
                                </div>
                            @endif

                            <div>
                                <label for="aboutMe" class="block text-sm font-semibold text-primary mb-2">Aprašymas</label>
                                <textarea
                                    x-ref="aboutMeTextarea"
                                    wire:model.live.debounce.1000ms="aboutMe"
                                    @input="resize()"
                                    rows="4"
                                    class="w-full rounded-xl border-gray-300 shadow-sm bg-gray-50 focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 overflow-hidden resize-none min-h-[120px] transition-all duration-200 @error('aboutMe') border-red-500 @enderror"
                                    placeholder="{{ $this->user->role === 'provider' ? 'Papasakokite apie savo patirtį, naudojamus įrankius ir kodėl klientai turėtų pasirinkti būtent Jus. Pvz.: „Turiu 5 metų patirtį, dirbu tik su kokybiškomis medžiagomis ir suteikiu garantiją...' : 'Apibūdinkite save...' }}"
                                ></textarea>

                                @error('aboutMe')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror

                                <p class="text-xs text-gray-500 mt-2 text-right">
                                    {{ strlen($aboutMe ?? '') }}/2000 simbolių
                                </p>
                            </div>
                        </div>

                        <!-- Preview Mode -->
                        <div x-show="previewMode" style="display: none;">
                            <div class="w-full rounded-xl bg-gray-50 border border-gray-200 p-6 shadow-inner space-y-4">
                                @if(auth()->user()->role === 'provider')
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Titulinis</p>
                                        <p class="text-lg font-semibold text-gray-800">
                                            @if($title)
                                                {{ $title }}
                                            @else
                                                <span class="text-gray-400 italic font-normal">Titulinis dar nepateiktas.</span>
                                            @endif
                                        </p>
                                    </div>
                                    <hr class="border-gray-200">
                                @endif
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Aprašymas</p>
                                    <div class="prose max-w-none text-gray-700 whitespace-pre-wrap leading-relaxed">
                                        @if($aboutMe)
                                            {{ $aboutMe }}
                                        @else
                                            <span class="text-gray-400 italic">Aprašymas dar nepateiktas.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Asmeninė Informacija</h2>
                        </div>

                        <!-- Grid Container -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Vardas</label>
                                <input type="text" id="name" name="name" wire:model="name"
                                       class="w-full rounded-xl border-gray-300 shadow-sm bg-gray-50 text-gray-600 cursor-not-allowed focus:border-gray-300 focus:ring-0 @error('name') border-red-500 @enderror"
                                       readonly>
                                @error('name')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="lastname" class="block text-sm font-semibold text-gray-700 mb-2">Pavardė</label>
                                <input type="text" id="lastname" name="lastname" wire:model="lastname"
                                       class="bg-gray-50 w-full rounded-xl border-gray-300 shadow-sm text-gray-600 focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 @error('lastname') border-red-500 @enderror"
                                       readonly>
                                @error('lastname')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email (disabled) -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" wire:model="email"
                                       class="w-full rounded-xl border-gray-300 shadow-sm bg-gray-50 text-gray-600 cursor-not-allowed focus:ring-0"
                                       readonly>
                            </div>

                            <!-- Birthday -->
                            <div>
                                <label for="birthday" class="block text-sm font-semibold text-gray-700 mb-2">Gimimo Diena</label>
                                <input type="date" id="birthday" name="birthday" wire:model="birthday"
                                       class="w-full rounded-xl bg-gray-50 border-gray-300 shadow-sm text-gray-600 focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 @error('birthday') border-red-500 @enderror"
                                       readonly>
                                @error('birthday')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Lytis</label>
                                <select wire:model="gender" id="gender" disabled
                                        class="w-full rounded-xl border-gray-300 shadow-sm bg-gray-50 text-gray-600 focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 @error('gender') border-red-500 @enderror">
                                    <option value="">Pasirinkite...</option>
                                    <option value="male">Vyras</option>
                                    <option value="female">Moteris</option>
                                    <option value="other">Kita</option>
                                </select>
                                @error('gender')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Rolė</label>
                                <select id="role" name="role" disabled
                                        class="w-full rounded-xl border-gray-300 shadow-sm bg-gray-50 text-gray-600 focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 @error('role') border-red-500 @enderror">
                                    <option value="provider" {{ $user->role === 'provider' ? 'selected' : '' }}>Provider
                                    </option>
                                    <option value="seeker" {{ $user->role === 'seeker' ? 'selected' : '' }}>Seeker</option>
                                </select>
                                @error('role')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Adresas</label>
                                <input type="text" id="address" name="address" wire:model="address"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 @error('address') border-red-500 @enderror">
                                @error('address')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Post Code -->
                            <div>
                                <label for="post_code" class="block text-sm font-semibold text-gray-700 mb-2">Pašto Kodas</label>
                                <div class="flex">
                                <span
                                    class="inline-flex items-center px-4 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-xl font-medium">
                                    LT-
                                </span>
                                    <input type="text" wire:model="post_code" id="post_code"
                                           class="flex-1 rounded-r-xl border @error('post_code') border-red-500 @else border-gray-300 @enderror shadow-sm p-3 focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50"
                                           placeholder="XXXXX">
                                </div>
                                @error('post_code')
                                <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                                <small class="text-gray-500 mt-1 block">Formatas: XXXXX (be LT-)</small>
                            </div>

                            @if($user->role == 'provider')
                                <!-- Phone Number -->
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Telefono numeris:</label>
                                    <div class="flex">
                                    <span
                                        class="inline-flex items-center px-4 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-xl font-medium">
                                     +370
                                     </span>
                                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                               wire:model="phone"
                                               class="flex-1 rounded-r-xl border @error('phone') border-red-500 @else border-gray-300 @enderror shadow-sm p-3 focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50"
                                               placeholder="6XXXXXXX"
                                               pattern="[6]{1}[0-9]{7}"
                                               title="Įveskite 8 skaitmenis, prasidedančius 6">
                                    </div>
                                    @error('phone')
                                    <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                    @enderror
                                    <small class="text-gray-500 mt-1 block">Formatas: 6XXXXXXX (be +370)</small>
                                </div>

                                <!-- Cities -->
                                <div class="md:col-span-2">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <label for="city-select" class="text-sm font-semibold text-gray-700">Miestai</label>
                                    </div>
                                    <!-- Selected cities display as tags -->
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach($cities as $city)
                                            <div class="bg-primary-light text-white px-4 py-2 rounded-full flex items-center text-sm font-medium shadow-sm">
                                                {{ $city }}
                                                <button type="button" wire:click="removeCity('{{ $city }}')"
                                                        class="ml-2 hover:bg-white/20 rounded-full p-1 transition-colors focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- City selector dropdown -->
                                    <div class="relative">
                                        <select wire:model="selectedCity" wire:change="addCity" id="city-select"
                                                class="w-full md:w-64 rounded-xl border @error('cities') border-red-500 @else border-gray-300 @enderror shadow-sm p-3 focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50">
                                            <option value="">Pasirinkite miestą...</option>
                                            <option value="Vilnius">Vilnius</option>
                                            <option value="Kaunas">Kaunas</option>
                                            <option value="Klaipėda">Klaipėda</option>
                                            <option value="Šiauliai">Šiauliai</option>
                                            <option value="Panevėžys">Panevėžys</option>
                                        </select>
                                    </div>

                                    @error('cities')
                                    <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                    @enderror
                                    <small class="text-gray-500 mt-1 block">Pasirinkite visus miestus, kuriuose galite teikti
                                        paslaugas</small>
                                </div>
                            @elseif($user->role == 'seeker')
                                <!-- Cities for seeker -->
                                <div class="md:col-span-2">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <label for="seeker-city-select" class="block text-sm font-semibold text-gray-700">Miestas</label>
                                    </div>

                                    <!-- City selector dropdown -->
                                    <div class="relative">
                                        <select wire:model="currentSeekerCity" wire:change="addSingleCitySeeker" id="seeker-city-select"
                                                class="w-full md:w-64 rounded-xl border @error('cities') border-red-500 @else border-gray-300 @enderror shadow-sm p-3 focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50">
                                            <option value="">Pasirinkite miestą...</option>
                                            <option value="Vilnius">Vilnius</option>
                                            <option value="Kaunas">Kaunas</option>
                                            <option value="Klaipėda">Klaipėda</option>
                                            <option value="Šiauliai">Šiauliai</option>
                                            <option value="Panevėžys">Panevėžys</option>
                                        </select>
                                    </div>

                                    @error('cities')
                                    <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                    @enderror
                                    <small class="text-gray-500 mt-1 block">Pasirinkite miestą, kuriame gyvenate</small>
                                </div>
                            @endif

                        </div>
                        <!-- Languages -->
                        <div>
                            <div class="flex items-center mb-3">
                                <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                    </svg>
                                </div>
                                <label for="language-select" class="block text-sm font-semibold text-gray-700">Kalbos</label>
                            </div>

                            <!-- Selected languages display as tags -->
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($languages as $lang)
                                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full flex items-center text-sm font-medium shadow-sm">
                                        {{ $lang }}
                                        <button type="button" wire:click="removeLanguage('{{ $lang }}')"
                                                class="ml-2 hover:bg-green-200 rounded-full p-1 transition-colors focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Language selector dropdown -->
                            <div class="relative">
                                <select wire:model="selectedLanguage" wire:change="addLanguage" id="language-select"
                                        class="w-full md:w-64 rounded-xl border @error('languages') border-red-500 @else border-gray-300 @enderror shadow-sm p-3 focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50">
                                    <option value="">Pasirinkite kalbą...</option>
                                    <option value="Lietuvių">Lietuvių</option>
                                    <option value="Anglų">Anglų</option>
                                    <option value="Rusų">Rusų</option>
                                    <option value="Lenkų">Lenkų</option>
                                    <option value="Vokiečių">Vokiečių</option>
                                    <option value="Prancūzų">Prancūzų</option>
                                </select>
                            </div>

                            @error('languages')
                            <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                            @enderror
                            <small class="text-gray-500 mt-1 block">Pasirinkite visas kalbas, kuriomis kalbate</small>
                        </div>
                    </div>

                    @if($this->user->role === 'provider')
                        <!-- Work Categories Section -->
                        <div class="space-y-6">
                            <div class="flex items-center">
                                <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m4 0h2a2 2 0 002-2V7a2 2 0 00-2-2h-2m-4 0V3a2 2 0 012-2h.01M9 5a2 2 0 012-2h.01M9 5a2 2 0 012 2h.01"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Jūsų Darbo Kategorijos</h3>
                            </div>

                            <!-- Category Cards Display -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @php
                                    // Group subcategories by their parent category
                                    $groupedCategories = collect($this->user->categories)
                                        ->groupBy('category')
                                        ->map(function ($items) {
                                            return $items->pluck('subcategory', 'id');
                                        });
                                @endphp

                                @forelse($groupedCategories as $category => $subcategories)
                                    <div
                                        class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                                        <div class="flex items-center mb-3">
                                            <div class="bg-primary-light/10 p-2 rounded-lg mr-3">

                                            </div>
                                            <h4 class="font-bold text-gray-800">{{ $category }}</h4>
                                        </div>
                                        <ul class="space-y-2">
                                            @foreach($subcategories as $id => $subcategory)
                                                <li class="text-sm text-gray-600 flex items-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4 text-green-500 mr-2 mt-0.5 flex-shrink-0"
                                                         viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>{{ $subcategory }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @empty
                                    <div class="col-span-full bg-gray-50 rounded-xl p-6 text-center text-gray-500 border-2 border-dashed border-gray-300">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m4 0h2a2 2 0 002-2V7a2 2 0 00-2-2h-2m-4 0V3a2 2 0 012-2h.01M9 5a2 2 0 012-2h.01M9 5a2 2 0 012 2h.01"></path>
                                        </svg>
                                        Nėra pasirinktų darbo kategorijų
                                    </div>
                                @endforelse
                            </div>

                            <!-- Hidden form field for form submission -->
                            <div class="hidden">
                                <select id="subcategories" name="subcategories[]" multiple>
                                    @foreach($this->user->categories as $category)
                                        <option value="{{ $category->id }}" selected>{{ $category->subcategory }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button for Main Form -->
                    <div class="flex justify-end pt-6 border-t border-gray-200">
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-primary-light border border-transparent rounded-xl font-semibold text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Atnaujinti Profilį
                        </button>
                    </div>
                </form>

                <!-- Separate Password Change Section -->
                <div class="mt-8 pt-8 border-t-2 border-gray-200">
                    <div class="flex items-center justify-between mb-6 mt-8">
                        <div class="flex items-center">
                            <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Slaptažodžio Keitimas</h2>
                        </div>

                        <button
                            wire:click="togglePasswordForm"
                            type="button"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 text-sm">
                            @if($showPasswordForm)
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Atšaukti
                            @else
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                                Keisti Slaptažodį
                            @endif
                        </button>
                    </div>

                    @if($showPasswordForm)
                        <form wire:submit.prevent="updatePassword" autocomplete="off" class="space-y-6">
                            <!-- Password change info box -->
                            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            Slaptažodis turi turėti bent 8 simbolius, vieną didžiąją raidę, vieną skaičių ir vieną specialųjį simbolą (@$!%*#?&).
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <!-- Current Password -->
                                <div>
                                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Dabartinis Slaptažodis
                                    </label>
                                    <div class="relative">
                                        <input
                                            type="password"
                                            id="current_password"
                                            wire:model="current_password"
                                            autocomplete="new-password"
                                            readonly
                                            onfocus="this.removeAttribute('readonly');"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 pr-10 @error('current_password') border-red-500 @enderror"
                                            placeholder="Įveskite dabartinį slaptažodį">
                                        <button
                                            type="button"
                                            onclick="togglePasswordVisibility('current_password')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hover:text-primary-light transition-colors">
                                            <!-- Eye Icon (Show) -->
                                            <svg id="current_password_eye_show" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <!-- Eye Slash Icon (Hide) -->
                                            <svg id="current_password_eye_hide" class="h-5 w-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('current_password')
                                    <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Naujas Slaptažodis
                                    </label>
                                    <div class="relative">
                                        <input
                                            type="password"
                                            id="new_password"
                                            wire:model="new_password"
                                            autocomplete="new-password"
                                            readonly
                                            onfocus="this.removeAttribute('readonly');"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 pr-10 @error('new_password') border-red-500 @enderror"
                                            placeholder="Įveskite naują slaptažodį">
                                        <button
                                            type="button"
                                            onclick="togglePasswordVisibility('new_password')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hover:text-primary-light transition-colors">
                                            <!-- Eye Icon (Show) -->
                                            <svg id="new_password_eye_show" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <!-- Eye Slash Icon (Hide) -->
                                            <svg id="new_password_eye_hide" class="h-5 w-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('new_password')
                                    <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm New Password -->
                                <div>
                                    <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Patvirtinkite Naują Slaptažodį
                                    </label>
                                    <div class="relative">
                                        <input
                                            type="password"
                                            id="new_password_confirmation"
                                            wire:model="new_password_confirmation"
                                            autocomplete="new-password"
                                            readonly
                                            onfocus="this.removeAttribute('readonly');"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 pr-10 @error('new_password_confirmation') border-red-500 @enderror"
                                            placeholder="Pakartokite naują slaptažodį">
                                        <button
                                            type="button"
                                            onclick="togglePasswordVisibility('new_password_confirmation')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hover:text-primary-light transition-colors">
                                            <!-- Eye Icon (Show) -->
                                            <svg id="new_password_confirmation_eye_show" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <!-- Eye Slash Icon (Hide) -->
                                            <svg id="new_password_confirmation_eye_hide" class="h-5 w-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('new_password_confirmation')
                                    <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button for Password Form -->
                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-primary-light border border-transparent rounded-xl font-semibold text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Pakeisti Slaptažodį
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="text-gray-600 text-sm">
                            Norėdami pakeisti slaptažodį, paspauskite mygtuką "Keisti Slaptažodį" viršuje.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="cropper-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800">Pasirinkite nuotraukos dalį</h3>
                <button type="button" onclick="closeCropperModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Image Container - FIXED HEIGHT -->
            <div class="mb-4 bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center" style="height: 400px;">
                <img id="crop-image" class="block max-w-full max-h-full">
            </div>

            <!-- Controls -->
            <div class="flex items-center justify-between">
                <div class="flex gap-2">
                    <button type="button" onclick="rotateCropperLeft()"
                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors"
                            title="Pasukti kairėn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                    </button>
                    <button type="button" onclick="rotateCropperRight()"
                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors"
                            title="Pasukti dešinėn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10H11a8 8 0 00-8 8v2m18-10l-6 6m6-6l-6-6"></path>
                        </svg>
                    </button>
                    <button type="button" onclick="resetCropper()"
                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors"
                            title="Atstatyti">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex gap-2">
                    <button type="button" onclick="closeCropperModal()"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">
                        Atšaukti
                    </button>
                    <button type="button" onclick="uploadCroppedImage()"
                            class="px-4 py-2 bg-primary-light hover:bg-primary-dark text-white rounded-lg font-medium transition-colors">
                        Įkelti
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('aboutMeSaved', () => {
            window.dispatchEvent(new CustomEvent('about-me-saved'));
        });
    });

    function togglePasswordVisibility(fieldId) {
        const input = document.getElementById(fieldId);
        const eyeShow = document.getElementById(fieldId + '_eye_show');
        const eyeHide = document.getElementById(fieldId + '_eye_hide');

        if (input.type === 'password') {
            input.type = 'text';
            eyeShow.classList.add('hidden');
            eyeHide.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeShow.classList.remove('hidden');
            eyeHide.classList.add('hidden');
        }
    }

    let cropper = null;

    document.getElementById('image-input').addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (!file) return;

        if (!file.type.match('image.*')) {
            alert('Prašome pasirinkti nuotrauką');
            return;
        }

        if (file.size > 8 * 1024 * 1024) {
            alert('Nuotrauka negali viršyti 8MB dydžio');
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            const modal = document.getElementById('cropper-modal');
            const image = document.getElementById('crop-image');

            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            image.src = event.target.result;
            modal.classList.remove('hidden');

            image.onload = function() {
                // Destroy previous instance if it exists
                if (cropper) {
                    cropper.destroy();
                }

                // Use the window global we defined in app.js
                cropper = new window.Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 1,
                    background: false,
                });
            };
        };

        reader.readAsDataURL(file);
    });

    function closeCropperModal() {
        const modal = document.getElementById('cropper-modal');
        modal.classList.add('hidden');

        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        document.getElementById('image-input').value = '';
    }

    // Fix the button functions
    function rotateCropperLeft() {
        if (cropper) cropper.rotate(-90);
    }

    function rotateCropperRight() {
        if (cropper) cropper.rotate(90);
    }

    function resetCropper() {
        if (cropper) cropper.reset();
    }

    function uploadCroppedImage() {
        if (!cropper) {
            alert('Cropper nepavyko inicializuoti');
            return;
        }

        const canvas = cropper.getCroppedCanvas({
            width: 800,
            height: 800,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        canvas.toBlob(function(blob) {
            if (!blob) return;

            const file = new File([blob], 'profile.jpg', {
                type: 'image/jpeg',
                lastModified: Date.now()
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // TARGETED FIX:
            // Find the specific Livewire component that handles the profile
            // by looking for the one that contains our image input.
            const profileComponentElement = document.getElementById('image-input').closest('[wire\\:id]');

            if (!profileComponentElement) {
                console.error('Could not find the profile Livewire component.');
                return;
            }

            const component = Livewire.find(profileComponentElement.getAttribute('wire:id'));

            component.upload('image', dataTransfer.files[0],
                (uploadedFilename) => {
                    closeCropperModal();
                    // Optional: Manually trigger the save if your updatedImage()
                    // method doesn't auto-save to the database.
                },
                (error) => {
                    console.error('Upload error:', error);
                    alert('Įvyko klaida įkeliant nuotrauką');
                },
                (event) => {
                    console.log('Upload progress:', event.detail.progress);
                }
            );
        }, 'image/jpeg', 0.9);
    }
</script>
