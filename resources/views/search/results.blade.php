@extends('layouts.main')

@section('content')
    <div class="w-full max-w-4xl mx-auto p-2 md:p-4">
        <div class="mb-4 md:mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-primary mb-2">Rasti meistrai</h1>

            <!-- Search filters with date change functionality -->
            <div class="mb-3">
                <form action="{{ route('search.results') }}" method="POST" class="flex flex-wrap items-end gap-2">
                    @csrf
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
                        <label for="date-filter" class="text-xs md:text-sm text-gray-600">Data:</label>
                        <input
                            type="date"
                            id="date-filter"
                            name="date"
                            value="{{ $date }}"
                            min="{{ date('Y-m-d') }}"
                            class="text-xs md:text-sm border border-gray-300 rounded px-2 py-1 md:px-3 md:py-1.5"
                        >
                        <button type="submit" class="bg-primary text-white text-xs md:text-sm rounded px-2 py-1 md:px-3 md:py-1.5 hover:bg-primary-dark transition">
                            Atnaujinti
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($availableProviders->isEmpty())
            <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200 text-yellow-700 text-sm md:text-base">
                <p>Deja, šiuo metu nėra pasiekiamų meistrų pagal jūsų paieškos kriterijus.</p>
            </div>
        @else
            <div class="space-y-3 md:space-y-4">
                @foreach($availableProviders as $provider)
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
                                        <h2 class="text-base md:text-xl font-semibold text-primary-dark">{{ ucfirst($provider->name) }} {{ ucfirst($provider->lastname) }}</h2>
                                        <p class="text-xs md:text-base text-gray-600">
                                            {{ \Carbon\Carbon::parse($provider->birthday)->age }} m.
                                        </p>

                                        <!-- Only show limited about text on mobile -->
                                        @if($provider->aboutme)
                                            <div class="mt-1 md:mt-4">
                                                <p class="text-xs md:text-base text-gray-600 line-clamp-4 md:line-clamp-none">
                                                    {{ Str::limit($provider->aboutme, 200, '...') }}
                                                    <span class="hidden md:inline">
                                                        {{ strlen($provider->aboutme) > 200 ? substr($provider->aboutme, 200, 100) : '' }}
                                                        @if(strlen($provider->aboutme) > 300)
                                                            <a href="{{ route('provider.profile', $provider->id) }}" class="text-primary hover:underline">Skaityti daugiau</a>
                                                        @endif
                                                    </span>
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Mobile: Button at the bottom right corner -->
                                    <div class="mt-2 md:mt-3 flex justify-end">
                                        <a href="{{ route('provider.reserve', ['id' => $provider->id, 'date' => $date, 'task_size' => $taskSize, 'subcategory' => $subcategory, 'city' => $city]) }}"
                                           class="inline-block rounded-md bg-gradient-to-tr from-primary to-primary-light py-1 px-3 md:py-2 md:px-4 border border-transparent
                                           text-center text-xs md:text-base text-white font-sans hover:from-primary-dark hover:to-primary-light transition">
                                            Rezervuoti
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Only show specializations if desktop or if we have them -->
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
        @endif

        <div class="mt-4 md:mt-6">
            <a href="{{ route('search') }}?subcategory={{ urlencode($subcategory ?? '') }}" class="text-primary hover:text-primary-dark text-sm md:text-base">
                &larr; Grįžti į paiešką
            </a>
        </div>
    </div>
@endsection
