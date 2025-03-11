@extends('layouts.main')

@section('content')
    <div class="w-full max-w-4xl mx-auto p-2 md:p-4">
        <div class="mb-4 md:mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-primary mb-2">Meistro rezervacija</h1>

            <!-- Search parameters summary -->
            <div class="mb-3">
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
                    <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">
                    Data: {{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}
                </span>
                </div>
            </div>
        </div>

        <!-- Provider details card -->
        <div class="border rounded-lg shadow-sm overflow-hidden bg-white mb-4 md:mb-6">
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
                    <h2 class="text-base md:text-xl font-semibold text-primary-dark">{{ ucfirst($provider->name) }} {{ ucfirst($provider->lastname) }}</h2>
                    <p class="text-xs md:text-base text-gray-600">
                        {{ \Carbon\Carbon::parse($provider->birthday)->age }} m.
                    </p>

                    @if($provider->aboutme)
                        <div class="mt-1 md:mt-4">
                            <p class="text-xs md:text-base text-gray-600">
                                {{ $provider->aboutme }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Provider specializations -->
            @if($provider->specializations && count($provider->specializations) > 0)
                <div class="px-2 pb-2 md:px-4 md:pb-3">
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

        <!-- Reservation form -->
        <div class="border rounded-lg shadow-sm overflow-hidden bg-white">
            <div class="p-3 md:p-5">
                <h3 class="text-lg md:text-xl font-semibold text-primary-dark mb-3">Užpildykite užklausos formą</h3>
                <form action="{{ route('reservation.request') }}" method="POST">
                    @csrf
                    <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="task_size" value="{{ $taskSize }}">
                    <input type="hidden" name="subcategory" value="{{ $subcategory }}">
                    <input type="hidden" name="city" value="{{ $city }}">

                    <div class="space-y-3 md:space-y-4">
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm md:text-base font-medium text-gray-700 mb-1">Aprašykite užduotį:</label>
                            <textarea id="description" name="description" rows="4"
                                      class="w-full rounded-md border @error('description') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                      placeholder="Detaliai aprašykite, kokią užduotį reikia atlikti...">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm md:text-base font-medium text-gray-700 mb-1">Adresas:</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                   class="w-full rounded-md border @error('address') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                   placeholder="Įveskite tikslų adresą...">
                            @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm md:text-base font-medium text-gray-700 mb-1">Telefono numeris:</label>
                            <div class="flex">
                            <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                             +370
                             </span>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                       class="w-full rounded-none rounded-r-md border @error('phone') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                       placeholder="6XXXXXXX"
                                       pattern="[6]{1}[0-9]{7}"
                                       title="Įveskite 8 skaitmenis, prasidedančius 6">
                            </div>
                            <small class="text-gray-500 mt-1 block">Formatas: 6XXXXXXX (be +370)</small>
                            @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <small class="text-red-500">Jūsų asmeninė informacija nebus matoma ligi kol užsakymas nebus patvirtintas.</small>

                        <!-- Submit button -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                    class="inline-block rounded-md bg-gradient-to-tr from-primary to-primary-light py-2 px-4 md:py-3 md:px-6 border border-transparent
                            text-center text-sm md:text-base text-white font-sans hover:from-primary-dark hover:to-primary-light transition">
                                Siųsti užklausą
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 md:mt-6">
            <a href="{{ url()->previous() }}" class="text-primary hover:text-primary-dark text-sm md:text-base">
                &larr; Grįžti į paiešką
            </a>
        </div>
    </div>
@endsection
