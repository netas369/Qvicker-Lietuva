<div class="relative">
    <!-- Search Bar -->
    <!-- Search Bar -->
    <form class="flex items-center max-w-xl mx-auto mt-10 md:mt-20">
        <label for="searchbar" class="sr-only">Ieškoti paslaugos</label>
        <div class="relative w-full">
            <!-- Search icon on the left -->
            <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>

            <!-- Search input - moderately sized and rounded -->
            <input
                wire:model.live="search"
                type="text"
                id="searchbar"
                class="bg-white border border-gray-300 text-gray-900 text-base rounded-full focus:ring-primary-light focus:border-primary-light block w-full ps-12 p-4 shadow-sm"
                placeholder="Ieškoti paslaugos..."
                required
            />

            <!-- Clear button (appears when there's text) -->
            <button
                type="button"
                class="absolute inset-y-0 end-0 flex items-center pe-4 text-gray-500 hover:text-gray-700"
                wire:click="clearSearch"
                x-show="$wire.search.length > 0"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </form>

    <!-- Dropdown -->
    <div
        class="absolute top-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-10 max-w-lg w-full left-1/2 transform -translate-x-1/2"
        style="display: {{ $search ? 'block' : 'none' }};">
        @if(!empty($results))
            @foreach($results as $result)
                <a
                    href="/search?subcategory={{ urlencode($result['subcategory']) }}"
                    class="px-3 py-2 hover:bg-gray-100 cursor-pointer flex justify-between items-center"
                >
                    <div>
                        <span class="text-md font-medium text-gray-900">{{ $result['category'] }}</span>
                        <small class="block text-sm text-gray-500">{{ $result['subcategory'] ?? 'No subcategory' }}</small>
                    </div>
                </a>
            @endforeach
        @else
            <div class="px-3 py-2 text-center text-gray-500">
                No results found
            </div>
        @endif
    </div>
</div>

