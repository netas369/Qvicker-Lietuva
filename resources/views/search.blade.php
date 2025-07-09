@extends('layouts.main')

@section('content')
    <!-- Hero Section with Background -->
    <div class="relative min-h-screen ">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-light opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary opacity-10 rounded-full blur-3xl"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 px-4 py-12 md:py-20 pb-24">
            <!-- Header Section -->
            <div class="text-center mb-10 md:mb-16">
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4">
                    Raskite <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light">
                        Geriausius Specialistus
                    </span>
                </h1>
                <p class="text-gray-600 text-lg md:text-xl max-w-2xl mx-auto">
                    Greitas ir patogus būdas rasti paslaugų teikėjus jūsų mieste
                </p>
            </div>

            <!-- Form Card -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                    <form method="POST" action="{{ route('search.results') }}">
                        @csrf

                        @if(isset($subcategory))
                            <input type="hidden" name="subcategory" value="{{ $subcategory }}">
                        @endif

                        @if(isset($subcategoryId))
                            <input type="hidden" name="subcategory_id" value="{{ $subcategoryId }}">
                        @endif

                        <!-- Two Column Layout for Category & Subcategory -->
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <!-- Category -->
                            <div class="group">
                                <label for="category" class="flex items-center gap-2 mb-3 text-lg font-semibold text-gray-700">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    Kategorija
                                </label>
                                <select
                                    id="category"
                                    name="category"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-700 font-medium
                                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-200
                                           hover:border-gray-300">
                                    <option value="">Pasirinkite kategoriją</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ (isset($selectedCategory) && $selectedCategory == $category) ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Subcategory -->
                            <div class="group">
                                <label for="subcategory" class="flex items-center gap-2 mb-3 text-lg font-semibold text-gray-700">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    Sub-Kategorija
                                </label>
                                <select
                                    id="subcategory"
                                    name="subcategory"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-700 font-medium
                                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-200
                                           hover:border-gray-300">
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
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Divider with Icon -->
                        <div class="relative my-10">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t-2 border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-white px-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Service Details Grid -->
                        <div class="grid md:grid-cols-3 gap-6">
                            <!-- Date -->
                            <div class="group">
                                <label for="date" class="flex items-center gap-2 mb-3 text-lg font-semibold text-gray-700">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Kada?
                                </label>
                                <input
                                    type="date"
                                    id="date"
                                    name="date"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-700 font-medium
                                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-200
                                           hover:border-gray-300"
                                    value="{{ date('Y-m-d') }}"
                                    min="{{ date('Y-m-d') }}">
                                @error('date')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="group">
                                <label for="city" class="flex items-center gap-2 mb-3 text-lg font-semibold text-gray-700">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Kur?
                                </label>
                                <select
                                    id="city"
                                    name="city"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-700 font-medium
                                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-200
                                           hover:border-gray-300">
                                    <option value="">Pasirinkite miestą</option>
                                    <option value="Vilnius">Vilnius</option>
                                    <option value="Kaunas">Kaunas</option>
                                    <option value="Klaipėda">Klaipėda</option>
                                    <option value="Šiauliai">Šiauliai</option>
                                    <option value="Panevėžys">Panevėžys</option>
                                </select>
                                @error('city')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Task Size -->
                            <div class="group">
                                <label for="task_size" class="flex items-center gap-2 mb-3 text-lg font-semibold text-gray-700">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Dydis?
                                </label>
                                <select
                                    id="task_size"
                                    name="task_size"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-700 font-medium
                                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-200
                                           hover:border-gray-300">
                                    <option value="">Pasirinkite dydį</option>
                                    <option value="small">Maža (1-2 val.)</option>
                                    <option value="medium">Vidutinė (2-4 val.)</option>
                                    <option value="big">Didelė (4-8 val.)</option>
                                </select>
                                @error('task_size')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="mt-12 text-center">
                            <button class="group relative inline-flex items-center justify-center px-10 py-4
                                         bg-gradient-to-r from-primary to-primary-light
                                         text-white font-semibold text-lg rounded-xl
                                         shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
                                         transition-all duration-200 ease-in-out
                                         focus:outline-none focus:ring-4 focus:ring-primary/30
                                         active:scale-95"
                                    type="submit"
                                    aria-label="Search for service providers">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Ieškoti paslaugų teikėjų
                                <div class="absolute inset-0 rounded-xl bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-200"></div>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Trust Indicators -->
                <div class="mt-8 text-center">
                    <div class="flex flex-wrap justify-center items-center gap-8 text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Patikrinti specialistai</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm">4.8+ įvertinimas</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">10,000+ klientų</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
