<div class="space-y-6">
    <div class="text-center">
        <h2 class="mt-14 text-2xl md:text-3xl font-bold text-primary-light">Pasirinkite teikiamas paslaugas</h2>
        <p class="mt-2 text-sm text-gray-600">Pažymėkite visas paslaugas, kurias galite teikti</p>
    </div>

    <!-- Search Bar -->
    <div class="max-w-2xl mx-auto">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input type="text"
                   wire:model.live.debounce.300ms="searchTerm"
                   class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-light focus:border-transparent"
                   placeholder="Ieškoti paslaugos...">
            @if($searchTerm)
                <button type="button"
                        wire:click="$set('searchTerm', '')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            @endif
        </div>
        @if($searchTerm && count($filteredSubcategories) === 0)
            <p class="mt-2 text-sm text-gray-500 text-center">Nerasta paslaugų pagal "{{ $searchTerm }}"</p>
        @endif
    </div>

    @error('selectedSubcategories')
    <div class="max-w-2xl mx-auto">
        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
            <div class="flex items-start">
                <svg class="h-5 w-5 text-red-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span class="block text-red-600 text-sm font-medium">{{ $message }}</span>
            </div>
        </div>
    </div>
    @enderror

    <!-- Category Tabs (hidden when searching) -->
    @if(!$searchTerm)
        <div class="relative">
            <!-- Left scroll arrow -->
            <button id="scrollLeftReg" type="button"
                    class="hidden absolute left-2 top-1/2 -translate-y-1/2 z-10 lg:flex items-center justify-center w-10 h-10 bg-white rounded-full shadow-lg border border-gray-200 hover:bg-gray-50 transition-all duration-200">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Right scroll arrow -->
            <button id="scrollRightReg" type="button"
                    class="hidden absolute right-2 top-1/2 -translate-y-1/2 z-10 lg:flex items-center justify-center w-10 h-10 bg-white rounded-full shadow-lg border border-gray-200 hover:bg-gray-50 transition-all duration-200">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <div id="regCategoryScroller" class="flex flex-nowrap overflow-x-auto border-b-2 border-primary-light border-opacity-50 pb-2 scrollbar-hide">
                <ul class="flex flex-nowrap gap-4 -mb-px text-sm font-medium text-center" role="tablist">
                    @foreach($categories as $index => $category)
                        <li class="flex-shrink-0">
                            <div class="flex-none w-28 snap-always snap-center">
                                <button wire:click="setActiveTab({{ $index }})" type="button" role="tab"
                                        class="inline-block p-4 rounded-t-lg transition-colors {{ $activeTab === $index ? 'text-primary-light border-b-2 border-primary' : 'text-gray-500 hover:text-gray-600' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                    </svg>
                                    <span class="block mt-2 text-primary">{{ $category['name'] }}</span>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Subcategories Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
        @if($searchTerm)
            <!-- Show filtered results when searching -->
            @foreach($filteredSubcategories as $subcategory)
                <label class="relative flex items-start p-4 space-x-3 border-2 rounded-lg transition-all duration-200 cursor-pointer
                    {{ in_array($subcategory['id'], $selectedSubcategories) ? 'border-primary-light bg-blue-50' : 'border-gray-200 hover:border-primary-light hover:bg-gray-50' }}">
                    <input type="checkbox"
                           wire:model.live="selectedSubcategories"
                           value="{{ $subcategory['id'] }}"
                           class="flex-shrink-0 mt-0.5 rounded border-gray-300 text-primary-light focus:ring-primary-light">
                    <div class="flex-1">
                        <span class="block text-sm font-medium text-gray-900">{{ $subcategory['name'] }}</span>
                        <span class="block text-xs text-gray-500 mt-0.5">{{ $subcategory['category'] }}</span>
                    </div>
                    @if(in_array($subcategory['id'], $selectedSubcategories))
                        <svg class="absolute top-2 right-2 w-5 h-5 text-primary-light" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                </label>
            @endforeach
        @else
            <!-- Show category-filtered results -->
            @foreach($categories as $index => $category)
                @if($activeTab === $index)
                    @foreach($category['subcategories'] as $subcategory)
                        <label class="relative flex items-center p-4 space-x-3 border-2 rounded-lg transition-all duration-200 cursor-pointer
                            {{ in_array($subcategory['id'], $selectedSubcategories) ? 'border-primary-light bg-blue-50' : 'border-gray-200 hover:border-primary-light hover:bg-gray-50' }}">
                            <input type="checkbox"
                                   wire:model.live="selectedSubcategories"
                                   value="{{ $subcategory['id'] }}"
                                   class="flex-shrink-0 rounded border-gray-300 text-primary-light focus:ring-primary-light">
                            <span class="text-sm font-medium text-gray-900 break-words">{{ $subcategory['name'] }}</span>
                            @if(in_array($subcategory['id'], $selectedSubcategories))
                                <svg class="absolute top-2 right-2 w-5 h-5 text-primary-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </label>
                    @endforeach
                @endif
            @endforeach
        @endif
    </div>

    <!-- Selected Services Counter -->
    @if(count($selectedSubcategories) > 0)
        <div class="max-w-2xl mx-auto">
            <div class="bg-primary-light bg-opacity-10 border border-primary-light rounded-lg p-3">
                <p class="text-sm font-medium text-primary-light text-center">
                    Pasirinkta paslaugų: {{ count($selectedSubcategories) }}
                </p>
            </div>
        </div>
    @endif

    <!-- Selected Services Details -->
    <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Pasirinktos paslaugos</h3>
            @if(count($selectedSubcategories) > 0)
                <button type="button"
                        wire:click="clearAllSubcategories"
                        class="text-sm text-red-600 hover:text-red-800 font-medium">
                    Išvalyti visas
                </button>
            @endif
        </div>

        @if(count($selectedSubcategories) > 0)
            <div class="space-y-4">
                @foreach($categories as $category)
                    @foreach($category['subcategories'] as $subcategory)
                        @if(in_array($subcategory['id'], $selectedSubcategories))
                            <div class="bg-white border-2 border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <span class="font-semibold text-lg text-gray-900">{{ $subcategory['name'] }}</span>
                                        <span class="block text-xs text-gray-500 mt-1">{{ $category['name'] }}</span>
                                    </div>
                                    <button type="button"
                                            wire:click="removeSubcategory({{ $subcategory['id'] }})"
                                            class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-full transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Price -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Kaina <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="number"
                                                   wire:model.blur="subcategoryPrices.{{ $subcategory['id'] }}"
                                                   class="w-full px-3 py-2.5 pr-8 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light focus:border-transparent
                                                   @error("subcategoryPrices.{$subcategory['id']}") border-red-500 @else border-gray-300 @enderror"
                                                   placeholder="0.00"
                                                   min="0"
                                                   max="1000"
                                                   step="0.01">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 text-sm font-medium">€</span>
                                            </div>
                                        </div>
                                        @error("subcategoryPrices.{$subcategory['id']}")
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Price Type -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Kainos tipas <span class="text-red-500">*</span>
                                        </label>
                                        <select wire:model.blur="subcategoryPriceTypes.{{ $subcategory['id'] }}"
                                                class="w-full px-3 py-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light focus:border-transparent
                                                @error("subcategoryPriceTypes.{$subcategory['id']}") border-red-500 @else border-gray-300 @enderror">
                                            <option value="">Pasirinkite tipą</option>
                                            <option value="hourly">⏱️ Valandinis</option>
                                            <option value="fixed">💰 Fiksuotas</option>
                                            <option value="meter">📏 Metrinis</option>
                                        </select>
                                        @error("subcategoryPriceTypes.{$subcategory['id']}")
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Experience -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Patirtis (metais)
                                        </label>
                                        <input type="number"
                                               wire:model.blur="subcategoryExperience.{{ $subcategory['id'] }}"
                                               class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light focus:border-transparent"
                                               placeholder="Pvz: 5"
                                               min="0"
                                               max="50">
                                        @error("subcategoryExperience.{$subcategory['id']}")
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="mt-4 text-sm text-gray-500">Nėra pasirinktų paslaugų</p>
                <p class="mt-1 text-xs text-gray-400">Pasirinkite paslaugas iš sąrašo aukščiau</p>
            </div>
        @endif
    </div>

    <!-- Bottom Error Message (duplicate of top error) -->
    @error('selectedSubcategories')
    <div class="max-w-2xl mx-auto mt-6">
        <div class="bg-red-50 border-2 border-red-300 rounded-lg p-4 shadow-sm">
            <div class="flex items-start">
                <svg class="h-6 w-6 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h4 class="text-red-800 font-semibold text-sm mb-1">Klaida</h4>
                    <span class="block text-red-700 text-sm">{{ $message }}</span>
                </div>
            </div>
        </div>
    </div>
    @enderror

    <!-- Summary of errors for individual fields -->
    @php
        $hasFieldErrors = false;
        foreach($selectedSubcategories as $subcategoryId) {
            if ($errors->has("subcategoryPrices.{$subcategoryId}") ||
                $errors->has("subcategoryPriceTypes.{$subcategoryId}") ||
                $errors->has("subcategoryExperience.{$subcategoryId}")) {
                $hasFieldErrors = true;
                break;
            }
        }
    @endphp

    @if($hasFieldErrors)
        <div class="max-w-2xl mx-auto mt-4">
            <div class="bg-yellow-50 border-2 border-yellow-300 rounded-lg p-4 shadow-sm">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-yellow-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="text-yellow-800 font-semibold text-sm mb-1">Prašome pataisyti klaidas</h4>
                        <span class="block text-yellow-700 text-sm">Kai kurios paslaugos turi neužpildytų ar neteisingų laukų. Patikrinkite kainą ir kainos tipą kiekvienai paslaugai.</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scroller = document.getElementById('regCategoryScroller');
            const scrollLeftBtn = document.getElementById('scrollLeftReg');
            const scrollRightBtn = document.getElementById('scrollRightReg');

            if (!scroller || !scrollLeftBtn || !scrollRightBtn) return;

            function updateArrowVisibility() {
                const isScrollable = scroller.scrollWidth > scroller.clientWidth;

                if (!isScrollable) {
                    scrollLeftBtn.style.display = 'none';
                    scrollRightBtn.style.display = 'none';
                    return;
                }

                const isAtStart = scroller.scrollLeft <= 10;
                const isAtEnd = scroller.scrollLeft >= scroller.scrollWidth - scroller.clientWidth - 10;

                if (isAtStart) {
                    scrollLeftBtn.style.display = 'none';
                    scrollRightBtn.style.display = 'flex';
                } else if (isAtEnd) {
                    scrollLeftBtn.style.display = 'flex';
                    scrollRightBtn.style.display = 'none';
                } else {
                    scrollLeftBtn.style.display = 'flex';
                    scrollRightBtn.style.display = 'flex';
                }
            }

            scrollLeftBtn.addEventListener('click', () => {
                scroller.scrollBy({ left: -220, behavior: 'smooth' });
            });

            scrollRightBtn.addEventListener('click', () => {
                scroller.scrollBy({ left: 220, behavior: 'smooth' });
            });

            scroller.addEventListener('scroll', updateArrowVisibility);
            window.addEventListener('resize', updateArrowVisibility);

            setTimeout(updateArrowVisibility, 100);
            window.addEventListener('load', updateArrowVisibility);

            document.addEventListener('livewire:load', updateArrowVisibility);
            Livewire.hook('message.processed', () => {
                setTimeout(updateArrowVisibility, 100);
            });
        });
    </script>
@endpush
