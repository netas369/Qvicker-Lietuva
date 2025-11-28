<div class="max-w-4xl mx-auto px-4 py-8">
    @if($userType === 'provider')
        <!-- Progress Bar Component -->
        <x-registration.progress-bar
            :current-step="$currentStep"
            :total-steps="$totalSteps"
        />
    @endif

    <!-- Form Steps -->
    <div class="mt-8">
        @if($userType === 'seeker' || ($userType === 'provider' && $currentStep === 1))
            <livewire:registration.personal-info-step />
        @endif

        @if($userType === 'provider' && $currentStep === 2)
            <livewire:registration.category-selection-step />
        @endif

        @if($userType === 'provider' && $currentStep === 3)
            <!-- Confirmation Step (inline, not a separate component) -->
            <div class="space-y-8">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-primary-light">Patvirtinkite savo informaciją</h2>
                    <p class="mt-2 text-sm text-gray-600">Peržiūrėkite visus įvestus duomenis prieš registruojantis</p>
                </div>

                <!-- Personal Information Review -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-primary mb-4">Asmeninė informacija</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Vardas</p>
                            <p class="text-gray-900">{{ $personalData['vardas'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pavardė</p>
                            <p class="text-gray-900">{{ $personalData['pavarde'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Gimimo data</p>
                            <p class="text-gray-900">{{ $personalData['gimimo_data'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Lytis</p>
                            <p class="text-gray-900">
                                @if(isset($personalData['gender']))
                                    @switch($personalData['gender'])
                                        @case('male') Vyras @break
                                        @case('female') Moteris @break
                                        @case('other') Kita @break
                                        @default {{ $personalData['gender'] }}
                                    @endswitch
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">El. paštas</p>
                            <p class="text-gray-900">{{ $personalData['email'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Tel. Nr.</p>
                            <p class="text-gray-900">{{ isset($personalData['phone']) ? '+370' . $personalData['phone'] : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Miestas</p>
                            <p class="text-gray-900">{{ $personalData['miestas'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Adresas</p>
                            <p class="text-gray-900">{{ $personalData['adresas'] ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pašto Kodas</p>
                            <p class="text-gray-900">{{ isset($personalData['post_code']) ? 'LT-' . $personalData['post_code'] : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Kalbos</p>
                            <p class="text-gray-900">
                                @if(isset($personalData['languages']) && is_array($personalData['languages']))
                                    {{ implode(', ', $personalData['languages']) }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Selected Services Review -->
                @if(isset($categoryData['selectedSubcategories']) && count($categoryData['selectedSubcategories']) > 0)
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-primary mb-4">Pasirinktos paslaugos</h3>
                        <div class="space-y-3">
                            @foreach($categoryData['selectedSubcategories'] as $subcategoryId)
                                @php
                                    $foundSubcategory = null;
                                    $parentCategory = null;

                                    // Find the subcategory and its parent category
                                    foreach($categories as $category) {
                                        foreach($category['subcategories'] as $subcategory) {
                                            if($subcategory['id'] == $subcategoryId) {
                                                $foundSubcategory = $subcategory;
                                                $parentCategory = $category['name'];
                                                break 2;
                                            }
                                        }
                                    }

                                    $price = $categoryData['subcategoryPrices'][$subcategoryId] ?? '-';
                                    $priceType = $categoryData['subcategoryPriceTypes'][$subcategoryId] ?? '-';
                                    $experience = $categoryData['subcategoryExperience'][$subcategoryId] ?? '-';

                                    $priceTypeLabel = match($priceType) {
                                        'hourly' => 'Valandinis',
                                        'fixed' => 'Fiksuotas',
                                        'meter' => 'Metrinis',
                                        default => $priceType
                                    };
                                @endphp

                                @if($foundSubcategory)
                                    <div class="bg-white p-4 rounded border border-gray-200">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $foundSubcategory['name'] }}</p>
                                                <p class="text-sm text-gray-500">{{ $parentCategory }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-semibold text-primary">{{ $price }}€ <span class="text-sm font-normal">({{ $priceTypeLabel }})</span></p>
                                                @if($experience !== '-')
                                                    <p class="text-sm text-gray-600">Patirtis: {{ $experience }} m.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Terms and Conditions -->
                <div class="mt-6 text-center">
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="terms"
                               class="rounded border-gray-300 text-primary-light focus:ring-primary-light">
                        <span class="ml-2 text-sm text-gray-600">
                            Sutinku su
                            <a href="{{ route('legal.terms') }}" class="text-primary-light hover:text-primary-dark" target="_blank">naudojimo sąlygomis</a>
                        </span>
                    </label>
                    @error('terms')
                    <span class="block text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif
    </div>

    <!-- Terms for Seekers (show at bottom of personal info step) -->
    @if($userType === 'seeker')
        <div class="mt-6 text-center">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="terms"
                       class="rounded border-gray-300 text-primary-light focus:ring-primary-light">
                <span class="ml-2 text-sm text-gray-600">
                    Sutinku su
                    <a href="{{ route('legal.terms') }}" class="text-primary-light hover:text-primary-dark" target="_blank">naudojimo sąlygomis</a>
                </span>
            </label>
            @error('terms')
            <span class="block text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
    @endif

    <!-- Navigation Buttons -->
    <div class="mt-8 flex justify-between">
        @if($currentStep > 1)
            <button type="button" wire:click="previousStep"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Atgal
            </button>
        @else
            <div></div>
        @endif

        @if($userType === 'seeker' || $currentStep >= $totalSteps)
            <button type="button" wire:click="register"
                    class="px-4 py-2 bg-primary-light text-white rounded-md hover:bg-primary"
                    wire:loading.attr="disabled">
                <span wire:loading.remove>Registruotis</span>
                <span wire:loading>
                    <svg class="animate-spin h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        @else
            <button type="button"
                    wire:click="$dispatch('validate-current-step')"
                    class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                Toliau
            </button>
        @endif
    </div>
</div>
