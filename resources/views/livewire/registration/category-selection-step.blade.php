<div class="space-y-8">
    <div class="text-center">
        <h2 class="mt-14 text-2xl md:text-3xl font-bold text-primary-light">Pasirinkite teikiamas paslaugas</h2>
        <p class="mt-2 text-sm text-gray-600">Pažymėkite visas paslaugas, kurias galite teikti</p>
    </div>

    @error('selectedSubcategories')
    <span class="block text-red-500 text-sm text-center mb-4">{{ $message }}</span>
    @enderror

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

    <!-- Subcategories Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
        @foreach($categories as $index => $category)
            @if($activeTab === $index)
                @foreach($category['subcategories'] as $subcategory)
                    <label class="flex items-center p-3 space-x-3 border border-gray-200 rounded-lg hover:border-primary-light hover:bg-gray-50 cursor-pointer">
                        <input type="checkbox"
                               wire:model.live="selectedSubcategories"
                               value="{{ $subcategory['id'] }}"
                               class="flex-shrink-0 rounded border-gray-300 text-primary-light focus:ring-primary-light">
                        <span class="text-sm text-gray-700 break-words">{{ $subcategory['name'] }}</span>
                    </label>
                @endforeach
            @endif
        @endforeach
    </div>

    <!-- Selected Services -->
    <div class="mt-6">
        <h3 class="text-xl font-medium text-gray-900">Pasirinktos paslaugos:</h3>

        @if(count($selectedSubcategories) > 0)
            <div class="mt-3 space-y-3">
                @foreach($categories as $category)
                    @foreach($category['subcategories'] as $subcategory)
                        @if(in_array($subcategory['id'], $selectedSubcategories))
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="font-medium text-lg text-gray-900">{{ $subcategory['name'] }}</span>
                                    <button type="button" wire:click="removeSubcategory({{ $subcategory['id'] }})"
                                            class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Price -->
                                    <div class="md:w-[25%]">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kaina</label>
                                        <div class="relative">
                                            <input type="number"
                                                   wire:model.blur="subcategoryPrices.{{ $subcategory['id'] }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                                   placeholder="Įveskite kainą"
                                                   min="0"
                                                   max="1000"
                                                   step="0.01">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 text-sm">€</span>
                                            </div>
                                        </div>
                                        @error("subcategoryPrices.{$subcategory['id']}")
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Price Type -->
                                    <div class="md:w-[50%]">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kainos tipas</label>
                                        <select wire:model.blur="subcategoryPriceTypes.{{ $subcategory['id'] }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                            <option value="">Pasirinkite kainos tipą</option>
                                            <option value="hourly">Valandinis</option>
                                            <option value="fixed">Fiksuotas</option>
                                            <option value="meter">Metrinis</option>
                                        </select>
                                        @error("subcategoryPriceTypes.{$subcategory['id']}")
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Experience -->
                                    <div class="md:w-[25%]">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Patirtis (metais)</label>
                                        <input type="number"
                                               wire:model.blur="subcategoryExperience.{{ $subcategory['id'] }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                               placeholder="Pvz: 5"
                                               min="0"
                                               max="50">
                                        @error("subcategoryExperience.{$subcategory['id']}")
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @else
            <p class="mt-2 text-sm text-gray-500">Nėra pasirinktų paslaugų</p>
        @endif
    </div>

    <!-- REMOVED: The duplicate "Toliau" button that was here -->
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
