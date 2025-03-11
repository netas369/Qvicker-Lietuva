<div>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">



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

            <h1 class="text-2xl font-bold mb-6 text-primary">Mano Profilis</h1>

            <form wire:submit.prevent="update" class="space-y-6">

                <!-- Profile Picture Upload -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Profile Picture</h2>

                    <!-- Current Profile Picture -->
                    @if(auth()->user()->image)
                        <img src="{{ auth()->user()->profile_photo_url }}"
                             class="w-32 h-32 rounded-full mb-4 object-cover"
                             alt="Current profile photo">
                    @else
                        <div class="w-32 h-32 rounded-full mb-4 flex items-center justify-center bg-gray-400 text-white text-5xl font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1) . substr(auth()->user()->lastname, 0, 1)) }}
                        </div>
                    @endif

                    <!-- Upload Input -->
                    <input type="file" wire:model="image" id="image" class="hidden">
                    <label for="image" class="cursor-pointer inline-flex items-center px-4 py-2 bg-primary-light border border-transparent rounded-md font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        {{ auth()->user()->image ? 'Pakeisti Nuotrauką' : 'Įkelti Nuotrauką' }}
                    </label>

                    <!-- Upload Progress -->
                    @if($image)
                        <div class="mt-2 text-sm">
                            <span class="text-gray-600">Uploading:</span>
                            {{ $image->getClientOriginalName() }}
                            <div wire:loading wire:target="image" class="text-primary-light">
                                Įkeliama...
                            </div>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- About Me Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Apie Mane</h2>
                    @if($this->user->role === 'provider')
                    <textarea wire:model="aboutMe" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('aboutMe') border-red-500 @enderror" placeholder="Apibūdinkite savo darbo įgūdžius..."></textarea>
                    @endif
                    @if($this->user->role === 'seeker')
                    <textarea wire:model="aboutMe" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('aboutMe') border-red-500 @enderror" placeholder="Apibūdinkite save..."></textarea>
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
                            <option value="provider" {{ $user->role === 'provider' ? 'selected' : '' }}>Provider</option>
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
                        <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
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
                            <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
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
                                    <button type="button" wire:click="removeLanguage('{{ $lang }}')" class="ml-1 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                                <div class="bg-white rounded-lg border border-gray-200 p-3 shadow-sm hover:shadow transition-shadow">
                                    <h4 class="font-medium text-gray-800 border-b pb-2 mb-2">{{ $category }}</h4>
                                    <ul class="space-y-1">
                                        @foreach($subcategories as $id => $subcategory)
                                            <li class="text-sm text-gray-600 flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
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
