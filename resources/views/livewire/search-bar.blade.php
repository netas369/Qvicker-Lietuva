<div class="relative">
    <!-- Search Bar -->
    <form class="flex items-center max-w-lg mx-auto mt-10">
        <label for="voice-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"/>
                </svg>
            </div>
            <input wire:model.live="search" type="text" id="searchbar" class="bg-white border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-verylight focus:border-primary-light block w-full ps-10 p-2.5  ml-2" placeholder="Ieškoti paslaugos..." required />
            <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-3">
                <svg class="w-5 h-6 text-primary dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
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

