@extends('layouts.main')

@section('content')
    <form class="max-w-xs sm:max-w-sm mx-auto" method="POST" action="{{ route('search.results') }}">
        @csrf

        @if(isset($subcategory))
            <input type="hidden" name="subcategory" value="{{ $subcategory }}">
        @endif

        @if(isset($subcategoryId))
            <input type="hidden" name="subcategory_id" value="{{ $subcategoryId }}">
        @endif

        <div class="mb-5 md:mt-16 mt-8">
            <label for="category" class="block mb-2 text-lg font-medium text-primary-light font-sans">Kategorija</label>
            <select
                id="category"
                name="category"
                class="border border-primary text-gray-600 font-medium text-sm rounded-lg block w-full p-2.5">
                <option value="">Pasirinkite kategoriją</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ (isset($selectedCategory) && $selectedCategory == $category) ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
            @error('category')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="subcategory" class="block mb-2 text-lg font-medium text-primary-light font-sans">Sub-Kategorija</label>
            <select
                id="subcategory"
                name="subcategory"
                class="border border-primary text-gray-600 font-medium text-sm rounded-lg block w-full p-2.5">
                <option value="">Pasirinkite sub-kategoriją</option>
                @if(isset($subcategories))
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory }}" {{ (isset($selectedSubcategory) && $selectedSubcategory == $subcategory) ? 'selected' : '' }}>
                            {{ $subcategory }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('subcategory')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="my-8 text-center">
            <hr class="mt-2 border-t border-gray-300">
        </div>

        <div class="mb-5 mt-10">
            <label for="date" class="block mb-2 text-lg font-medium text-primary-light font-sans">Kada reikia paslaugos?</label>
            <input
                type="date"
                id="date"
                name="date"
                class="bg-white border border-primary text-gray-600 font-medium text-sm rounded-lg block w-full p-2.5"
                value="{{ date('Y-m-d') }}"
                min="{{ date('Y-m-d') }}">
            @error('date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5 mt-10">
            <label for="city" class="block mb-2 text-lg font-medium text-primary-light font-sans">Kokiame mieste reikia paslaugos?</label>
            <select
                id="city"
                name="city"
                class="border border-primary text-gray-600 font-medium text-sm rounded-lg block w-full p-2.5">
                <option value="">Pasirinkite miestą</option>
                <option value="Vilnius">Vilnius</option>
                <option value="Kaunas">Kaunas</option>
                <option value="Klaipėda">Klaipėda</option>
                <option value="Šiauliai">Šiauliai</option>
                <option value="Panevėžys">Panevėžys</option>
            </select>
            @error('city')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5 mt-10">
            <label for="task_size" class="block mb-2 text-lg font-medium text-primary-light font-sans">Kokio dydžio yra užduotis?</label>
            <select
                id="task_size"
                name="task_size"
                class="border border-primary text-gray-600 font-medium text-sm rounded-lg block w-full p-2.5">
                <option value="">Pasirinkite užduoties dydį</option>
                <option value="small">Maža (1-2 val.)</option>
                <option value="medium">Vidutinė (2-4 val.)</option>
                <option value="big">Didelė (4-8 val.)</option>
            </select>
            @error('task_size')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Search Button -->
        <div class="mt-10 mb-12 text-center">
            <button class="w-auto rounded-lg bg-gradient-to-tr from-primary to-primary-light py-3 px-8
                 border border-transparent text-center text-lg font-semibold text-white font-sans
                 hover:from-primary-dark hover:to-primary-light hover:shadow-lg
                 focus:outline-none focus:ring-4 focus:ring-primary-light focus:ring-opacity-50
                 active:scale-95 transition-all duration-200 ease-in-out
                 disabled:opacity-50 disabled:cursor-not-allowed"
                    type="submit"
                    aria-label="Search for service providers">
        <span class="flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Ieškoti paslaugų teikėjų
        </span>
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const subcategorySelect = document.getElementById('subcategory');

            // Store all subcategories grouped by category
            const subcategoriesData = @json($subcategoriesData ?? []);

            categorySelect.addEventListener('change', function() {
                const selectedCategory = this.value;

                // Clear subcategory options
                subcategorySelect.innerHTML = '<option value="">Pasirinkite sub-kategoriją</option>';

                // Populate subcategories based on selected category
                if (selectedCategory && subcategoriesData[selectedCategory]) {
                    subcategoriesData[selectedCategory].forEach(function(subcategory) {
                        const option = document.createElement('option');
                        option.value = subcategory;
                        option.textContent = subcategory;
                        subcategorySelect.appendChild(option);
                    });
                }
            });
        });
    </script>
@endsection
