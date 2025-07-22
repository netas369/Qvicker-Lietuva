@extends('layouts.main')

@section('content')

    <!-- Hero Section -->
    <div class="relative py-16 overflow-hidden bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <!-- Background decorative blobs -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-20 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center space-y-6">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="block bg-gradient-to-r from-blue-600 via-primary-light to-blue-600 bg-clip-text text-transparent pb-2">
                        Visos paslaugos
                    </span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    Raskite tinkamą specialistą bet kokiai užduočiai. Nuo namų remonto iki verslo paslaugų.
                </p>
            </div>
        </div>
    </div>

    <!-- Services Grid Section -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">

            <!-- Search Bar -->
            <div class="max-w-xl mx-auto mb-12">
                <div class="relative">
                    <input type="text"
                           id="serviceSearch"
                           placeholder="Ieškoti paslaugos..."
                           class="w-full px-4 py-3 pr-10 text-base rounded-lg border border-gray-300 focus:border-primary-light focus:outline-none focus:ring-2 focus:ring-primary-light/20 transition-all duration-300">
                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($categories as $categoryName => $subcategories)
                    <div class="category-section" data-category="{{ strtolower($categoryName) }}">
                        <!-- Category Header -->
                        <h2 class="text-lg font-semibold text-gray-900 mb-3 pb-2 border-b border-gray-200">
                            {{ $categoryName }}
                        </h2>

                        <!-- Subcategories List -->
                        <ul class="space-y-2">
                            @foreach($subcategories as $item)
                                <li class="service-item" data-service="{{ strtolower($item->subcategory) }}">
                                    <a href="{{ url($item->url) }}"
                                       class="text-primary-light hover:text-primary-verylight hover:underline transition-colors duration-200 text-sm block py-1">
                                        {{ $item->subcategory }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-12">
                <div class="inline-block">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Paslaugų nerasta</h3>
                    <p class="text-gray-600 text-sm">Pabandykite pakeisti paieškos užklausą</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Services Section -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Populiariausios paslaugos</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <h3 class="font-medium text-gray-800 mb-2">Namų valymas</h3>
                    <p class="text-sm text-gray-600">Profesionalus namų valymas</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <h3 class="font-medium text-gray-800 mb-2">Baldų surinkimas</h3>
                    <p class="text-sm text-gray-600">IKEA ir kitų baldų surinkimas</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <h3 class="font-medium text-gray-800 mb-2">Pervežimo paslaugos</h3>
                    <p class="text-sm text-gray-600">Greitas ir saugus pervežimas</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <h3 class="font-medium text-gray-800 mb-2">Remonto darbai</h3>
                    <p class="text-sm text-gray-600">Smulkūs namų remonto darbai</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-light via-blue-600 to-primary-verylight"></div>

        <div class="absolute top-0 left-0 w-72 h-72 bg-white rounded-full mix-blend-overlay opacity-10 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay opacity-10 translate-x-1/2 translate-y-1/2"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Nematote savo paslaugos?</h2>
                <p class="text-white/90 text-lg mb-8 leading-relaxed">
                    Tapkite partneriu, susisiekite su mumis ir pradėkite teikti savo paslaugas per Qvicker platformą
                </p>

                <div class="inline-block relative group">
                    <div class="absolute -inset-1 bg-white rounded-xl blur-md opacity-25 group-hover:opacity-50 transition duration-300"></div>
                    <a href="/register/provider" class="relative block">
                        <button class="relative bg-white text-primary-light font-bold py-4 px-8 rounded-xl hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 text-lg shadow-2xl">
                            Tapti Partneriu
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('serviceSearch');
            const categorySections = document.querySelectorAll('.category-section');
            const serviceItems = document.querySelectorAll('.service-item');
            const noResults = document.getElementById('noResults');

            // Function to normalize Lithuanian characters
            function normalizeText(text) {
                const lithuanianMap = {
                    'ą': 'a', 'č': 'c', 'ę': 'e', 'ė': 'e', 'į': 'i',
                    'š': 's', 'ų': 'u', 'ū': 'u', 'ž': 'z',
                    'Ą': 'A', 'Č': 'C', 'Ę': 'E', 'Ė': 'E', 'Į': 'I',
                    'Š': 'S', 'Ų': 'U', 'Ū': 'U', 'Ž': 'Z'
                };

                return text.split('').map(char => lithuanianMap[char] || char).join('');
            }

            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                const normalizedSearchTerm = normalizeText(searchTerm);
                let hasVisibleServices = false;

                categorySections.forEach(section => {
                    const categoryName = section.dataset.category;
                    const normalizedCategoryName = normalizeText(categoryName);
                    const items = section.querySelectorAll('.service-item');
                    let hasVisibleItems = false;

                    items.forEach(item => {
                        const serviceName = item.dataset.service;
                        const normalizedServiceName = normalizeText(serviceName);

                        // Check if either the original or normalized text matches
                        const isMatch = serviceName.includes(searchTerm) ||
                            normalizedServiceName.includes(normalizedSearchTerm) ||
                            categoryName.includes(searchTerm) ||
                            normalizedCategoryName.includes(normalizedSearchTerm);

                        if (isMatch || searchTerm === '') {
                            item.style.display = '';
                            hasVisibleItems = true;
                            hasVisibleServices = true;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Hide/show entire category section
                    section.style.display = hasVisibleItems ? '' : 'none';
                });

                // Show/hide no results message
                noResults.classList.toggle('hidden', hasVisibleServices || searchTerm === '');
            });
        });
    </script>

@endsection
