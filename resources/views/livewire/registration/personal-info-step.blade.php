<div>
    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-primary-light">Asmeninė informacija</h2>
            <p class="mt-2 text-sm text-gray-600">Užpildykite savo asmeninius duomenis</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Vardas -->
            <div>
                <label for="vardas" class="block text-sm font-medium text-gray-700 mb-1">
                    Vardas <span class="text-red-500">*</span>
                </label>
                <input type="text" id="vardas" wire:model.blur="vardas"
                       class="mt-1 block w-full rounded-md shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('vardas') ? 'border-red-500' : 'border-gray-300' }}">
                @error('vardas')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pavardė -->
            <div>
                <label for="pavarde" class="block text-sm font-medium text-gray-700 mb-1">
                    Pavardė <span class="text-red-500">*</span>
                </label>
                <input type="text" id="pavarde" wire:model.blur="pavarde"
                       class="mt-1 block w-full rounded-md shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('pavarde') ? 'border-red-500' : 'border-gray-300' }}">
                @error('pavarde')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gimimo Data -->
            <div>
                <label for="gimimo_data" class="block text-sm font-medium text-gray-700 mb-1">
                    Gimimo data <span class="text-red-500">*</span>
                </label>
                <input type="date" id="gimimo_data" wire:model.blur="gimimo_data"
                       class="mt-1 block w-full rounded-md shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('gimimo_data') ? 'border-red-500' : 'border-gray-300' }}">
                @error('gimimo_data')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lytis -->
            <x-registration.form-select
                label="Lytis"
                id="gender"
                wire:model.blur="gender"
                :options="[
                    'male' => 'Vyras',
                    'female' => 'Moteris',
                    'other' => 'Kita'
                ]"
                :error="$errors->first('gender')"
                placeholder="Pasirinkite lytį..."
                required
            />

            <!-- El. paštas -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    El. paštas <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" wire:model.blur="email"
                       class="mt-1 block w-full rounded-md shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}">
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Telefonas -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                    Tel. Nr. <span class="text-red-500">*</span>
                </label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        +370
                    </span>
                    <input type="text" id="phone" wire:model.blur="phone"
                           class="flex-1 rounded-r-md border-gray-300 shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('phone') ? 'border-red-500' : '' }}"
                           placeholder="61234567">
                </div>
                @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Miestas -->
            <x-registration.form-select
                label="Miestas"
                id="miestas"
                wire:model.blur="miestas"
                :options="[
                    'Vilnius' => 'Vilnius',
                    'Kaunas' => 'Kaunas',
                    'Klaipėda' => 'Klaipėda',
                    'Šiauliai' => 'Šiauliai',
                    'Panevėžys' => 'Panevėžys'
                ]"
                :error="$errors->first('miestas')"
                placeholder="Pasirinkite miestą..."
                required
            />

            <!-- Adresas -->
            <div>
                <label for="adresas" class="block text-sm font-medium text-gray-700 mb-1">
                    Adresas <span class="text-red-500">*</span>
                </label>
                <input type="text" id="adresas" wire:model.blur="adresas"
                       class="mt-1 block w-full rounded-md shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('adresas') ? 'border-red-500' : 'border-gray-300' }}">
                @error('adresas')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pašto kodas -->
            <div>
                <label for="post_code" class="block text-sm font-medium text-gray-700 mb-1">
                    Pašto Kodas <span class="text-red-500">*</span>
                </label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        LT-
                    </span>
                    <input type="text" id="post_code" wire:model.blur="post_code"
                           class="flex-1 rounded-r-md border-gray-300 shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('post_code') ? 'border-red-500' : '' }}"
                           placeholder="12345">
                </div>
                @error('post_code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kalbos -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kalbos <span class="text-red-500">*</span>
                </label>

                <select wire:model.live="selectedLanguage" wire:change="addLanguage"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 {{ $errors->has('languages') ? 'border-red-500' : '' }}">
                    <option value="">Pasirinkite kalbą...</option>
                    @foreach(['Lietuvių', 'Anglų', 'Rusų', 'Lenkų', 'Vokiečių', 'Prancūzų'] as $lang)
                        @if(!in_array($lang, $languages))
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endif
                    @endforeach
                </select>

                <!-- Selected Languages Tags -->
                @if(count($languages) > 0)
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($languages as $index => $language)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary-light text-white">
                                {{ $language }}
                                <button type="button" wire:click="removeLanguage({{ $index }})"
                                        class="ml-2 hover:text-gray-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </span>
                        @endforeach
                    </div>
                @endif

                @error('languages')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slaptažodis -->
            <div>
                <label for="slaptazodis" class="block text-sm font-medium text-gray-700 mb-1">
                    Slaptažodis *
                </label>
                <div class="relative">
                    <input
                        type="{{ $showPassword ? 'text' : 'password' }}"
                        id="slaptazodis"
                        wire:model.blur="slaptazodis"
                        class="w-full px-4 py-2 border @error('slaptazodis') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10"
                        placeholder="Įveskite slaptažodį"
                    >
                    <button
                        type="button"
                        wire:click="togglePasswordVisibility"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700"
                    >
                        @if($showPassword)
                            <!-- Eye Slash Icon (hide password) -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        @else
                            <!-- Eye Icon (show password) -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        @endif
                    </button>
                </div>
                @error('slaptazodis')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Mažiausiai 10 simbolių, 1 didžioji raidė, 1 skaičius, 1 simbolis (@$!%*#?&)</p>
            </div>

            <!-- Patvirtinti slaptažodį -->
            <div>
                <label for="slaptazodis_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    Patvirtinti slaptažodį *
                </label>
                <div class="relative">
                    <input
                        type="{{ $showPasswordConfirmation ? 'text' : 'password' }}"
                        id="slaptazodis_confirmation"
                        wire:model.blur="slaptazodis_confirmation"
                        class="w-full px-4 py-2 border @error('slaptazodis_confirmation') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10"
                        placeholder="Pakartokite slaptažodį"
                    >
                    <button
                        type="button"
                        wire:click="togglePasswordConfirmationVisibility"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700"
                    >
                        @if($showPasswordConfirmation)
                            <!-- Eye Slash Icon (hide password) -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        @else
                            <!-- Eye Icon (show password) -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        @endif
                    </button>
                </div>
                @error('slaptazodis_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

        <!-- Hidden Submit Button (triggered by wizard) -->
        <button type="submit" class="hidden" id="personal-info-submit">Submit</button>
    </form>
</div>
