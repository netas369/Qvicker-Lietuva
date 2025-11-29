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
