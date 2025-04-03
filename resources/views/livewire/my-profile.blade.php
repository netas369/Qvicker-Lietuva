<div>
    <div class="container mx-auto px-4 py-4">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6">
            @if (session()->has('message'))
                <div
                    id="session-message"
                    class=" text-primary-light p-3 rounded shadow mb-4 font-medium"
                >
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

            <h1 class="text-2xl font-bold mb-6 text-primary-light">Mano Profilis</h1>

            <form wire:submit.prevent="update" class="space-y-6">
                <div class="w-full grid grid-cols-12">
                    <div class="col-span-12 md:col-span-4 md:ml-8">
                        <!-- Profile Picture Upload - Modified for instant upload -->
                        <div class="mb-6">
                            <!-- Current Profile Picture -->
                            <div wire:loading.remove wire:target="image">
                                @if(auth()->user()->image)
                                    <img src="{{ auth()->user()->profile_photo_url }}"
                                         class="w-32 h-32 rounded-full mb-4 object-cover"
                                         alt="Current profile photo">
                                @else
                                    <div
                                        class="w-32 h-32 rounded-full mb-4 flex items-center justify-center bg-gray-400 text-white text-5xl font-bold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1) . substr(auth()->user()->lastname, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Loading State -->
                            <div wire:loading wire:target="image"
                                 class="w-32 h-32 rounded-full mb-4 flex items-center justify-center bg-gray-200">
                                <svg class="animate-spin h-10 w-10 text-primary-light"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>

                            <!-- Upload Input - Modified to trigger immediate upload -->
                            <input type="file" wire:model="image" id="image" class="hidden">
                            <label for="image"
                                   class="cursor-pointer inline-flex items-center px-2 py-1 bg-primary-light border border-transparent rounded-md text-sm text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                {{ auth()->user()->image ? 'Pakeisti Nuotrauką' : 'Įkelti Nuotrauką' }}
                            </label>

                            <!-- Error Message -->
                            @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-8">
                        <p class="text-primary-verylight text-md md:text-2xl font-bold">{{ ucfirst($this->name) . ' '. ucfirst($this->lastname) }}</p>
                        @if($this->user->role == 'provider')
                            <!-- Star Rating Display -->
                            <div class="flex items-center mt-2">
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
                                <span class="ml-2 text-xs text-gray-700 md:text-sm">
                                 {{ number_format($this->user->average_rating, 1) }} ({{ $this->user->reviewsReceived()->count() }} {{ $this->user->reviewsReceived()->count() == 1 ? 'atsiliepimas' : 'atsiliepimai' }})
                                </span>
                            </div>
                        @endif
                        @if($user->role == 'provider')
                        <div class="flex items-center mt-4 md:mt-8 text-sm md:text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary-light" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-primary-light font-bold">Įvykdyti Užsakymai: <span>{{$this->user->getTotalReservationsDone()}}</span></p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- About Me Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Apie Mane</h2>
                    @if($this->user->role === 'provider')
                        <textarea wire:model="aboutMe" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('aboutMe') border-red-500 @enderror"
                                  placeholder="Apibūdinkite savo darbo įgūdžius..."></textarea>
                    @endif
                    @if($this->user->role === 'seeker')
                        <textarea wire:model="aboutMe" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('aboutMe') border-red-500 @enderror"
                                  placeholder="Apibūdinkite save..."></textarea>
                    @endif
                    @error('aboutMe')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grid Container -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Vardas</label>
                        <input type="text" id="name" name="name" wire:model="name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed focus:border-gray-300 focus:ring-0 @error('name') border-red-500 @enderror"
                               readonly>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Pavardė</label>
                        <input type="text" id="lastname" name="lastname" wire:model="lastname"
                               class="bg-gray-100 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('lastname') border-red-500 @enderror"
                               readonly>
                        @error('lastname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email (disabled) -->
                    <div class="">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" wire:model="email"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed"
                               readonly>
                    </div>

                    <!-- Birthday -->
                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-700">Gimimo Diena</label>
                        <input type="date" id="birthday" name="birthday" wire:model="birthday"
                               class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('birthday') border-red-500 @enderror"
                               readonly>
                        @error('birthday')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Lytis</label>
                        <select wire:model="gender" id="gender" disabled
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('gender') border-red-500 @enderror">
                            <option value="">Pasirinkite...</option>
                            <option value="male">Vyras</option>
                            <option value="female">Moteris</option>
                            <option value="other">Kita</option>
                        </select>
                        @error('gender')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rolė</label>
                        <select id="role" name="role" disabled
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('role') border-red-500 @enderror">
                            <option value="provider" {{ $user->role === 'provider' ? 'selected' : '' }}>Provider
                            </option>
                            <option value="seeker" {{ $user->role === 'seeker' ? 'selected' : '' }}>Seeker</option>
                        </select>
                        @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="">
                        <label for="address" class="block text-sm font-medium text-gray-700">Adresas</label>
                        <input type="text" id="address" name="address" wire:model="address"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('address') border-red-500 @enderror">
                        @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Post Code -->
                    <div>
                        <label for="post_code" class="block text-sm font-medium text-gray-700">Pašto Kodas</label>
                        <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                            LT-
                        </span>
                            <input type="text" wire:model="post_code" id="post_code"
                                   class="w-full rounded-none rounded-r-md border @error('post_code') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                   placeholder="XXXXX">
                        </div>
                        @error('post_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <small class="text-gray-500 mt-1 block">Formatas: XXXXX (be LT-)</small>
                    </div>


                    <!-- City -->
                    <div class="">
                        <label for="city" class="block text-sm font-medium text-gray-700">Miestas</label>
                        <select id="city" name="city" wire:model="city"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('city') border-red-500 @enderror">
                            <option value="" disabled>Pasirinkite miestą</option>
                            <option value="Kaunas">Kaunas</option>
                            <option value="Vilnius">Vilnius</option>
                            <option value="Klaipeda">Klaipėda</option>
                        </select>
                        @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefono numeris:</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                             +370
                             </span>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   wire:model="phone"
                                   class="w-full rounded-none rounded-r-md border @error('phone') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                   placeholder="6XXXXXXX"
                                   pattern="[6]{1}[0-9]{7}"
                                   title="Įveskite 8 skaitmenis, prasidedančius 6">
                        </div>
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <small class="text-gray-500 mt-1 block">Formatas: 6XXXXXXX (be +370)</small>
                    </div>

                    <!-- Languages -->
                    <div>
                        <label for="language-select" class="block text-sm font-medium text-gray-700">Kalbos</label>

                        <!-- Selected languages display as tags -->
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($languages as $lang)
                                <div class="bg-primary-light text-white px-2 py-1 rounded-md flex items-center text-sm">
                                    {{ $lang }}
                                    <button type="button" wire:click="removeLanguage('{{ $lang }}')"
                                            class="ml-1 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
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
                                    class="w-full rounded-md border @error('languages') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
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
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <small class="text-gray-500 mt-1 block">Pasirinkite visas kalbas, kuriomis kalbate</small>
                    </div>
                </div>

                @if($this->user->role === 'provider')
                    <!-- Work Categories Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Jūsų Darbo Kategorijos</h3>

                        <!-- Category Cards Display -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
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
                                    class="bg-white rounded-lg border border-gray-200 p-3 shadow-sm hover:shadow transition-shadow">
                                    <h4 class="font-medium text-gray-800 border-b pb-2 mb-2">{{ $category }}</h4>
                                    <ul class="space-y-1">
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
                                <div class="col-span-full bg-gray-50 rounded-lg p-4 text-center text-gray-500">
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
                <div class="flex justify-end mt-8">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-primary-light border border-transparent rounded-md font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Atnaujinti Profili
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
