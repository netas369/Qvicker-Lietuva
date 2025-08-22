@extends('layouts.main')

@section('content')
    <div class="w-full max-w-4xl mx-auto p-2 md:p-4">
        <div class="mb-4 md:mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-primary mb-2">Rasti meistrai</h1>

            <!-- Search filters with date change functionality -->
            <div class="mb-3">
                <form action="{{ route('search.results.show') }}" method="GET" class="flex flex-wrap items-end gap-2">
                    <!-- Hidden fields to preserve current search parameters -->
                    <input type="hidden" name="subcategory" value="{{ $subcategory ?? '' }}">
                    @if(isset($subcategoryId))
                        <input type="hidden" name="subcategory_id" value="{{ $subcategoryId }}">
                    @endif
                    <input type="hidden" name="city" value="{{ $city }}">
                    <input type="hidden" name="task_size" value="{{ $taskSize }}">

                    <!-- Current filters display -->
                    <div class="flex flex-wrap gap-1 md:gap-2 text-xs md:text-sm text-gray-600">
                        @if($subcategory)
                            <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">{{ $subcategory }}</span>
                        @endif
                        <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">{{ $city }}</span>
                        <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">
                            @if($taskSize == 'small')
                                Maža (1-2 val.)
                            @elseif($taskSize == 'medium')
                                Vidutinė (2-4 val.)
                            @else
                                Didelė (4-8 val.)
                            @endif
                        </span>
                    </div>

                    <!-- Date filter input -->
                    <div class="flex items-center gap-2 ml-auto mt-2 md:mt-0">
                        <label for="date-filter" class="text-xs md:text-sm text-gray-600">Pasirinkite datą:</label>
                        <input
                            type="text"
                            id="date-filter"
                            name="date"
                            value="{{ $date }}"
                            readonly
                            placeholder="Pasirinkite datą"
                            class="text-xs md:text-sm border border-gray-300 rounded px-2 py-1 md:px-3 md:py-1.5 cursor-pointer"
                        >
                    </div>
                </form>
            </div>
        </div>
        <!-- Check if there are any providers (exact or soon available) -->
        @if(empty($exactlyAvailableProviders) && empty($soonAvailableProviders))
            <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200 text-yellow-700 text-sm md:text-base">
                <p>Deja, šiuo metu nėra pasiekiamų meistrų pagal jūsų paieškos kriterijus.</p>
            </div>
        @else
            <!-- Providers available on exact date -->
            @if(!empty($exactlyAvailableProviders))
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-primary mb-2">Laisvi {{ $specificDate->format('Y-m-d') }}</h2>
                    <div class="space-y-3 md:space-y-4">
                        @foreach($exactlyAvailableProviders as $item)
                            @php $provider = $item['provider']; @endphp
                            <div class="border rounded-lg shadow-sm overflow-hidden bg-white">
                                <div class="p-2 md:p-4 flex flex-row gap-2 md:gap-4">
                                    <!-- Provider Image - Much smaller on mobile -->
                                    <div class="w-20 h-20 md:w-36 md:h-36 flex-shrink-0">
                                        @if($provider->image)
                                            <img src="{{ asset('storage/' . $provider->image) }}"
                                                 alt="{{ $provider->name }}"
                                                 class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-16 md:w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Provider Information -->
                                    <div class="flex-grow">
                                        <div class="flex flex-col justify-between h-full">
                                            <div>
                                                <!-- Desktop layout -->
                                                <div class="hidden md:block">
                                                    <div class="flex items-center justify-between">
                                                        <!-- Provider name on the left -->
                                                        <h2 class="text-xl font-semibold text-primary">
                                                            {{ ucfirst($provider->name) }} {{ ucfirst($provider->lastname) }}
                                                        </h2>

                                                        <div class="flex items-center space-x-4">
                                                            <!-- Availability badge -->
                                                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                                Laisvas
                                                            </div>

                                                            <!-- Rating with star -->
                                                            <div class="flex items-center">
                                                                <span class="text-base font-medium text-gray-700">{{ number_format($provider->average_rating, 1) }}</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                </svg>
                                                            </div>

                                                            <!-- Divider -->
                                                            <div class="h-5 w-px bg-gray-300"></div>

                                                            <!-- Reservation count -->
                                                            <div class="text-sm text-gray-600">
                                                                <span class="font-medium">{{ $provider->getTotalReservationsDone() }}</span> užsakymai
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="text-base text-gray-600 mt-1">
                                                        {{ \Carbon\Carbon::parse($provider->birthday)->age }} m.
                                                    </p>

                                                    <!-- Pricing information for desktop -->
                                                    @if($provider->pricing_info)
                                                        <div class="mt-2 flex items-center space-x-4 text-sm">
                                                            <!-- Price -->
                                                            @if($provider->pricing_info['price'])
                                                                <div class="flex items-center">
                                                                    <span class="font-bold text-primary text-lg">{{ $provider->pricing_info['formatted_price'] }}€</span>
                                                                    @if($provider->pricing_info['type'])
                                                                        <span class="text-gray-600 ml-1">{{ $provider->pricing_info['type_label_full'] }}</span>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <!-- Experience -->
                                                            @if($provider->pricing_info['experience'])
                                                                <div class="flex items-center text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                                    </svg>
                                                                    <span>{{ $provider->pricing_info['experience'] }} m. patirtis</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Mobile layout -->
                                                <div class="md:hidden">
                                                    <!-- First row: Name and availability badge -->
                                                    <div class="flex items-center justify-between">
                                                        <h2 class="text-base font-semibold text-primary">
                                                            {{ ucfirst($provider->name) }} {{ ucfirst($provider->lastname) }}
                                                        </h2>
                                                        <div class="bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-xs font-medium">
                                                            Laisvas
                                                        </div>
                                                    </div>

                                                    <!-- Second row: Age, Rating and reservations -->
                                                    <div class="flex items-center mt-1.5">
                                                        <p class="text-xs text-gray-600">
                                                            {{ \Carbon\Carbon::parse($provider->birthday)->age }} m.
                                                        </p>
                                                        <div class="mx-2 h-3.5 w-px bg-gray-300"></div>
                                                        <div class="flex items-center">
                                                            <span class="text-sm font-medium text-gray-700">{{ number_format($provider->average_rating, 1) }}</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mx-2 h-3.5 w-px bg-gray-300"></div>
                                                        <div class="text-xs text-gray-600">
                                                            <span class="font-medium">{{ $provider->providerReservations->count() }}</span> užsakymai
                                                        </div>
                                                    </div>

                                                    <!-- Pricing information for mobile -->
                                                    @if($provider->pricing_info)
                                                        <div class="mt-1.5 flex items-center space-x-3 text-xs">
                                                            <!-- Price -->
                                                            @if($provider->pricing_info['price'])
                                                                <div class="flex items-center">
                                                                    <span class="font-medium text-primary">{{ $provider->pricing_info['formatted_price'] }}€</span>
                                                                    @if($provider->pricing_info['type'])
                                                                        <span class="text-gray-600 ml-1">{{ $provider->pricing_info['type_label_short'] }}</span>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <!-- Experience -->
                                                            @if($provider->pricing_info['experience'])
                                                                <div class="flex items-center text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                                    </svg>
                                                                    <span>{{ $provider->pricing_info['experience'] }}m. patirtis</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- About text -->
                                                @if($provider->aboutme)
                                                    <div class="mt-1 md:mt-3">
                                                        <!-- Mobile: Shorter, 2-line limit -->
                                                        <p class="text-xs text-gray-600 line-clamp-2 md:hidden">
                                                            {{ Str::limit($provider->aboutme, 100, '...') }}
                                                            @if(strlen($provider->aboutme) > 100)
                                                                <span class="text-primary ml-1">Daugiau</span>
                                                            @endif
                                                        </p>

                                                        <!-- Desktop: Longer with read more link -->
                                                        <p class="hidden md:block text-base text-gray-600">
                                                            {{ Str::limit($provider->aboutme, 150, '') }}
                                                            @if(strlen($provider->aboutme) > 150)
                                                                <span id="more-text-{{ $provider->id }}" class="hidden">
                                                                    {{ substr($provider->aboutme, 150) }}
                                                                </span>
                                                                <button
                                                                    onclick="toggleMoreText('{{ $provider->id }}')"
                                                                    id="read-more-btn-{{ $provider->id }}"
                                                                    class="text-primary font-medium hover:underline focus:outline-none ml-1"
                                                                >
                                                                    Skaityti daugiau
                                                                </button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Button -->
                                            <div class="mt-2 md:mt-3 flex justify-end">
                                                <a href="{{ route('provider.reserve', ['id' => $provider->id, 'date' => $date, 'task_size' => $taskSize, 'subcategory' => $subcategory, 'city' => $city]) }}"
                                                   class="inline-block rounded-md bg-gradient-to-tr from-primary to-primary-light py-1 px-3 md:py-2 md:px-4 border border-transparent
                                                    text-center text-xs md:text-base text-white font-sans hover:from-primary-dark hover:to-primary-light transition">
                                                    Plačiau..
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Specializations -->
                                @if($provider->specializations && count($provider->specializations) > 0)
                                    <div class="px-2 pb-2 md:px-4 md:pb-3 hidden md:block">
                                        <div class="flex flex-wrap gap-1 md:gap-2">
                                            @foreach($provider->specializations as $specialization)
                                                <span class="bg-primary-50 text-primary-600 px-2 py-0.5 md:px-3 md:py-1 rounded-full text-xs md:text-sm">
                                                    {{ $specialization->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Providers available on nearby dates -->
            @if(!empty($soonAvailableProviders))
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-yellow-700 mb-2">Laisvi artimiausiomis dienomis</h2>
                    <div class="space-y-3 md:space-y-4">
                        @foreach($soonAvailableProviders as $item)
                            @php
                                $provider = $item['provider'];
                                $availableDate = $item['available_date'];
                                $daysDiff = $item['days_difference'];
                                $dateLabel = $daysDiff > 0 ? $daysDiff . ' d. vėliau' : abs($daysDiff) . ' d. anksčiau';
                            @endphp
                            <div class="border rounded-lg shadow-sm overflow-hidden bg-white">
                                <div class="p-2 md:p-4 flex flex-row gap-2 md:gap-4">
                                    <!-- Provider Image -->
                                    <div class="w-20 h-20 md:w-36 md:h-36 flex-shrink-0">
                                        @if($provider->image)
                                            <img src="{{ asset('storage/' . $provider->image) }}"
                                                 alt="{{ $provider->name }}"
                                                 class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-16 md:w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Provider Information -->
                                    <div class="flex-grow">
                                        <div class="flex flex-col justify-between h-full">
                                            <div>
                                                <!-- Desktop layout -->
                                                <div class="hidden md:block">
                                                    <div class="flex items-center justify-between">
                                                        <!-- Provider name on the left -->
                                                        <h2 class="text-xl font-semibold text-primary">
                                                            {{ ucfirst($provider->name) }} {{ ucfirst($provider->lastname) }}
                                                        </h2>

                                                        <div class="flex items-center space-x-4">
                                                            <!-- Availability badge -->
                                                            <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                                                {{ $dateLabel }}
                                                            </div>

                                                            <!-- Rating with star -->
                                                            <div class="flex items-center">
                                                                <span class="text-base font-medium text-gray-700">{{ number_format($provider->average_rating, 1) }}</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                </svg>
                                                            </div>

                                                            <!-- Divider -->
                                                            <div class="h-5 w-px bg-gray-300"></div>

                                                            <!-- Reservation count -->
                                                            <div class="text-sm text-gray-600">
                                                                <span class="font-medium">{{ $provider->getTotalReservationsDone() }}</span> užsakymai
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="text-base text-gray-600 mt-1">
                                                        {{ \Carbon\Carbon::parse($provider->birthday)->age }} m.
                                                    </p>

                                                    <!-- Available date information -->
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        <span class="font-medium">Laisvas:</span> {{ $availableDate->format('Y-m-d') }}
                                                    </p>

                                                    <!-- Pricing information for desktop -->
                                                    @if($provider->pricing_info)
                                                        <div class="mt-2 flex items-center space-x-4 text-sm">
                                                            <!-- Price -->
                                                            @if($provider->pricing_info['price'])
                                                                <div class="flex items-center">
                                                                    <span class="font-bold text-primary text-lg">{{ $provider->pricing_info['formatted_price'] }}€</span>
                                                                    @if($provider->pricing_info['type'])
                                                                        <span class="text-gray-600 ml-1">{{ $provider->pricing_info['type_label_full'] }}</span>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <!-- Experience -->
                                                            @if($provider->pricing_info['experience'])
                                                                <div class="flex items-center text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                                    </svg>
                                                                    <span>{{ $provider->pricing_info['experience'] }} m. patirtis</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Mobile layout -->
                                                <div class="md:hidden">
                                                    <!-- First row: Name and badge -->
                                                    <div class="flex items-center justify-between">
                                                        <h2 class="text-base font-semibold text-primary">
                                                            {{ ucfirst($provider->name) }} {{ ucfirst($provider->lastname) }}
                                                        </h2>
                                                        <div class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full text-xs font-medium">
                                                            {{ $dateLabel }}
                                                        </div>
                                                    </div>

                                                    <!-- Available date information -->
                                                    <p class="text-xs text-gray-600 mt-0.5">
                                                        <span class="font-medium">Laisvas:</span> {{ $availableDate->format('Y-m-d') }}
                                                    </p>

                                                    <!-- Second row: Age, Rating and reservations -->
                                                    <div class="flex items-center mt-1.5">
                                                        <p class="text-xs text-gray-600">
                                                            {{ \Carbon\Carbon::parse($provider->birthday)->age }} m.
                                                        </p>
                                                        <div class="mx-2 h-3.5 w-px bg-gray-300"></div>
                                                        <div class="flex items-center">
                                                            <span class="text-sm font-medium text-gray-700">{{ number_format($provider->average_rating, 1) }}</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mx-2 h-3.5 w-px bg-gray-300"></div>
                                                        <div class="text-xs text-gray-600">
                                                            <span class="font-medium">{{ $provider->providerReservations->count() }}</span> užsakymai
                                                        </div>
                                                    </div>

                                                    <!-- Pricing information for mobile -->
                                                    @if($provider->pricing_info)
                                                        <div class="mt-1.5 flex items-center space-x-3 text-xs">
                                                            <!-- Price -->
                                                            @if($provider->pricing_info['price'])
                                                                <div class="flex items-center">
                                                                    <span class="font-medium text-primary">{{ $provider->pricing_info['formatted_price'] }}€</span>
                                                                    @if($provider->pricing_info['type'])
                                                                        <span class="text-gray-600 ml-1">{{ $provider->pricing_info['type_label_short'] }}</span>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <!-- Experience -->
                                                            @if($provider->pricing_info['experience'])
                                                                <div class="flex items-center text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                                    </svg>
                                                                    <span>{{ $provider->pricing_info['experience'] }}m. patirtis</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- About text -->
                                                @if($provider->aboutme)
                                                    <div class="mt-1 md:mt-3">
                                                        <!-- Mobile: Shorter, 2-line limit -->
                                                        <p class="text-xs text-gray-600 line-clamp-2 md:hidden">
                                                            {{ Str::limit($provider->aboutme, 100, '...') }}
                                                            @if(strlen($provider->aboutme) > 100)
                                                                <span class="text-primary ml-1">Daugiau</span>
                                                            @endif
                                                        </p>

                                                        <!-- Desktop: Longer with read more link -->
                                                        <p class="hidden md:block text-base text-gray-600">
                                                            {{ Str::limit($provider->aboutme, 150, '') }}
                                                            @if(strlen($provider->aboutme) > 150)
                                                                <span id="more-text-{{ $provider->id }}-soon" class="hidden">
                                                                    {{ substr($provider->aboutme, 150) }}
                                                                </span>
                                                                <button
                                                                    onclick="toggleMoreText('{{ $provider->id }}-soon')"
                                                                    id="read-more-btn-{{ $provider->id }}-soon"
                                                                    class="text-primary font-medium hover:underline focus:outline-none ml-1"
                                                                >
                                                                    Skaityti daugiau
                                                                </button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Button -->
                                            <div class="mt-2 md:mt-3 flex justify-end">
                                                <a href="{{ route('provider.reserve', ['id' => $provider->id, 'date' => $availableDate->format('Y-m-d'), 'task_size' => $taskSize, 'subcategory' => $subcategory, 'city' => $city]) }}"
                                                   class="inline-block rounded-md bg-gradient-to-tr from-primary to-primary-light py-1 px-3 md:py-2 md:px-4 border border-transparent
                                                    text-center text-xs md:text-base text-white font-sans hover:from-primary-dark hover:to-primary-light transition">
                                                    Plačiau..
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Specializations -->
                                @if($provider->specializations && count($provider->specializations) > 0)
                                    <div class="px-2 pb-2 md:px-4 md:pb-3 hidden md:block">
                                        <div class="flex flex-wrap gap-1 md:gap-2">
                                            @foreach($provider->specializations as $specialization)
                                                <span class="bg-primary-50 text-primary-600 px-2 py-0.5 md:px-3 md:py-1 rounded-full text-xs md:text-sm">
                                                    {{ $specialization->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <!-- Pagination Links -->
        @if(isset($paginatedResults) && $paginatedResults->hasPages())
            <div class="mt-6 mb-4 flex justify-center">
                <div class="pagination-wrapper">
                    {{ $paginatedResults->appends(request()->query())->links() }}
                </div>
            </div>
        @endif

        <!-- Results count -->
        @if(isset($paginatedResults) && ($totalExact > 0 || $totalSoon > 0))
            <div class="mb-3 text-sm text-gray-600">
                Rasta {{ $totalExact + $totalSoon }} meistrų
                ({{ $totalExact }} laisvi, {{ $totalSoon }} artimiausiomis dienomis)
                @if($paginatedResults->total() > 0)
                    - Rodoma {{ $paginatedResults->firstItem() ?? 0 }}-{{ $paginatedResults->lastItem() ?? 0 }}
                @endif
            </div>
        @endif

        <div class="mt-4 md:mt-6">
            <a href="{{ route('search') }}?subcategory={{ urlencode($subcategory ?? '') }}" class="text-primary hover:text-primary-dark text-sm md:text-base">
                &larr; Grįžti į paiešką
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .pagination-wrapper .pagination {
            @apply flex items-center space-x-1 text-sm;
        }

        .pagination-wrapper .pagination .page-link {
            @apply px-2 py-1 md:px-3 md:py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded;
        }

        .pagination-wrapper .pagination .page-item.active .page-link {
            @apply bg-primary text-white border-primary;
        }

        .pagination-wrapper .pagination .page-item.disabled .page-link {
            @apply text-gray-400 cursor-not-allowed;
        }

        /* Mobile responsive pagination */
        @media (max-width: 640px) {
            .pagination-wrapper .pagination {
                @apply text-xs space-x-0.5;
            }

            .pagination-wrapper .pagination .page-link {
                @apply px-1.5 py-1 text-xs;
            }
        }
    </style>
@endpush

@once
    @push('scripts')
        <script>
            function toggleMoreText(providerId) {
                const moreText = document.getElementById('more-text-' + providerId);
                const readMoreBtn = document.getElementById('read-more-btn-' + providerId);

                if (moreText.classList.contains('hidden')) {
                    moreText.classList.remove('hidden');
                    readMoreBtn.textContent = 'Rodyti mažiau';
                } else {
                    moreText.classList.add('hidden');
                    readMoreBtn.textContent = 'Skaityti daugiau';
                }
            }
        </script>
    @endpush
@endonce


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date-filter", {
                locale: window.flatpickrLithuanian,
                dateFormat: "Y-m-d",
                minDate: "today",
                defaultDate: "{{ $date }}",
                onChange: function(selectedDates, dateStr, instance) {
                    document.querySelector('form').submit();
                }
            });
        });
    </script>
@endpush
