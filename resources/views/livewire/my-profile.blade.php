<div>
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            @if (session()->has('message'))
                <div
                    id="session-message"
                    class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-xl shadow-sm mb-6 font-medium flex items-center space-x-3"
                >
                    <div class="bg-green-500 rounded-full p-1">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    {{ session('message') }}
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('session-message');
                        if (msg) {
                            msg.remove(); // Hides after 3 seconds
                        }
                    }, 5000);
                </script>
            @endif

            <!-- Header Section with Gradient -->
            <div class="bg-gradient-to-r from-primary-light to-primary-verylight py-4 px-6 text-white">
                <h1 class="text-2xl md:text-3xl font-bold mb-6">Mano Profilis</h1>
            </div>

            <!-- Main Content -->
            <div class="p-6 md:p-8">
                <form wire:submit.prevent="update" class="space-y-8">
                    <div class="w-full grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <!-- Profile Picture Upload - Enhanced styling -->
                            <div class="mb-6">
                                <!-- Current Profile Picture -->
                                <div wire:loading.remove wire:target="image">
                                    @if(auth()->user()->image)
                                        <div class="relative group">
                                            <img src="{{ auth()->user()->profile_photo_url }}"
                                                 class="w-32 h-32 rounded-full mb-4 object-cover border-4 border-white shadow-lg"
                                                 alt="Current profile photo">
                                            <!-- Upload overlay -->
                                            <div class="absolute inset-0 bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer mb-4">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @else
                                        <div class="relative group">
                                            <div
                                                class="w-32 h-32 rounded-full mb-4 flex items-center justify-center bg-gradient-to-br from-primary-light to-primary-verylight text-white text-4xl font-bold border-4 border-white shadow-lg">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1) . substr(auth()->user()->lastname, 0, 1)) }}
                                            </div>
                                            <!-- Upload overlay -->
                                            <div class="absolute inset-0 bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer mb-4">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Loading State -->
                                <div wire:loading wire:target="image"
                                     class="w-32 h-32 rounded-full mb-4 flex items-center justify-center bg-gray-100 border-4 border-white shadow-lg">
                                    <svg class="animate-spin h-10 w-10 text-primary-light"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>

                                <!-- Upload Input - Enhanced styling -->
                                <input type="file" wire:model="image" id="image" class="hidden">
                                <label for="image"
                                       class="cursor-pointer inline-flex items-center px-4 py-2 bg-primary-light border border-transparent rounded-xl text-sm text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light transition-all duration-200 shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ auth()->user()->image ? 'Pakeisti Nuotrauką' : 'Įkelti Nuotrauką' }}
                                </label>

                                <!-- Error Message -->
                                @error('image')
                                <p class="text-red-500 text-xs mt-2 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-8">
                            <div class="rounded-xl p-6">
                                <p class="text-primary-light text-xl md:text-3xl font-bold mb-4">{{ ucfirst($this->name) . ' '. ucfirst($this->lastname) }}</p>

                                @if($this->user->role == 'provider')
                                    <!-- Star Rating Display - Enhanced -->
                                    <div class="flex items-center mb-4">
                                        <div class="flex text-yellow-400">
                                            <!-- Full Stars -->
                                            @for ($i = 1; $i <= floor($this->user->average_rating); $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor

                                            <!-- Half Star (if applicable) -->
                                            @php
                                                $fraction = $this->user->average_rating - floor($this->user->average_rating);
                                                $showHalfStar = $fraction > 0.25 && $fraction < 0.75;
                                                $showFullStar = $fraction >= 0.75;
                                                $totalStarsShown = floor($this->user->average_rating) + ($showHalfStar ? 1 : 0) + ($showFullStar ? 1 : 0);
                                                $emptyStarsToShow = 5 - $totalStarsShown;
                                            @endphp

                                            @if ($showHalfStar)
                                                <div class="relative">
                                                    <!-- Empty star background -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                         fill="currentColor" style="color: #D1D5DB;">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                    <!-- Half star overlay -->
                                                    <div class="absolute inset-0 overflow-hidden" style="width: 50%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                             viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            @elseif ($showFullStar)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endif

                                            <!-- Empty Stars -->
                                            @for ($i = 0; $i < $emptyStarsToShow; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                     fill="currentColor" style="color: #D1D5DB;">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>

                                        <!-- Rating Number -->
                                        <span class="ml-3 text-sm text-gray-700 md:text-base font-medium px-3 py-1 rounded-full ">
                                         {{ number_format($this->user->average_rating, 1) }} ({{ $this->user->reviewsReceived()->count() }} {{ $this->user->reviewsReceived()->count() == 1 ? 'atsiliepimas' : 'atsiliepimai' }})
                                        </span>
                                    </div>
                                @endif

                                @if($user->role == 'provider')
                                    <div class="flex items-center text-sm md:text-lg bg-white rounded-lg p-3 shadow-sm">
                                        <div class="bg-primary-light p-2 rounded-lg mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                <path fill-rule="evenodd"
                                                      d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-700 font-semibold">Įvykdyti Užsakymai:
                                            <span class="text-primary-light font-bold">{{$this->user->getTotalReservationsDone()}}</span></p>
                                    </div>
                                @endif
                            </div>
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

                    <!-- About Me Section - Enhanced styling -->
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Apie Mane</h2>
                        </div>
                        @if($this->user->role === 'provider')
                            <textarea wire:model="aboutMe" rows="4"
                                      class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 resize-none @error('aboutMe') border-red-500 @enderror"
                                      placeholder="Apibūdinkite savo darbo įgūdžius..."></textarea>
                        @endif
                        @if($this->user->role === 'seeker')
                            <textarea wire:model="aboutMe" rows="4"
                                      class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 resize-none @error('aboutMe') border-red-500 @enderror"
                                      placeholder="Apibūdinkite save..."></textarea>
                        @endif
                        @error('aboutMe')
                        <p class="text-red-500 text-xs mt-1 bg-red-50 p-2 rounded-lg">{{ $message }}</p>
                        @enderror
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
                                        <label for="city-select" class="block text-sm font-semibold text-gray-700">Miestai</label>
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
                                    <small class="text-gray-500 mt-1 block">Pasirinkite miestą, kuriame norite gauti paslaugas</small>
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
                                                <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
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

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6 border-t border-gray-200">
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-primary-light border border-transparent rounded-xl font-semibold text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Atnaujinti Profili
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
