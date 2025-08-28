@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto p-4 md:p-6">
        <!-- Back button -->
        <a href="{{ route('reservations.provider') }}"
           class="inline-flex items-center text-primary hover:underline mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                      clip-rule="evenodd"/>
            </svg>
            Grįžti į užklausų sąrašą
        </a>

        <!-- Header -->
        <div class="mb-2">
            <h1 class="text-2xl font-bold text-primary">Užklausa Nr. {{ $reservation->id }}</h1>
        </div>
    </div>

    @if($reservation->status == 'completed' && $reviewIsLeft)
        @livewire('reservation-feedback', ['reservation' => $reservation])
    @endif

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-8 gap-6">
        <!-- Left column: Service details -->
        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-start">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $reservation->subcategory ?? 'Bendra paslauga' }}</h2>
                        <p class="text-gray-600">{{ $reservation->city ?? 'Valencia' }}</p>

                        @if(isset($reservation->task_size))
                            <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                @if($reservation->task_size == 'small')
                                    Maža (1-2 val.)
                                @elseif($reservation->task_size == 'medium')
                                    Vidutinė (2-4 val.)
                                @else
                                    Didelė (4-8 val.)
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                @if(isset($reservation->description))
                    <div class="mt-6">
                        <h3 class="text-gray-700 font-medium mb-2">Užduoties aprašymas</h3>
                        <p class="text-gray-600">{{ $reservation->description }}</p>
                    </div>
                @endif

                @if(isset($provider->pricing_info) && $provider->pricing_info)
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <h3 class="text-gray-700 font-medium mb-2">Jūsų kainos šiai paslaugai</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-2 sm:space-y-0">
                            <!-- Price -->
                            @if($provider->pricing_info['price'])
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-700 mr-2">Kaina:</span>
                                    <span class="font-bold text-primary text-lg">{{ $reservation->price }}€</span>
                                    @if($reservation->type)
                                        <span class="text-gray-600 ml-1">
        @switch($reservation->type)
                                                @case('hourly')
                                                    / val.
                                                    @break
                                                @case('fixed')
                                                    (fiksuotas)
                                                    @break
                                                @case('meter')
                                                    / m
                                                    @break
                                                @default

                                            @endswitch
    </span>
                                    @endif
                                </div>
                            @endif

                            <!-- Experience -->
                            @if($provider->pricing_info['experience'])
                                <div class="flex items-center text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    <span class="text-sm font-medium">{{ $provider->pricing_info['experience'] }} m. patirtis</span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-2 text-xs text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tai jūsų nustatyta bazinė kaina šiai paslaugai. Galutinę kainą aptarkite su klientu.
                        </div>
                    </div>
                @endif

                <!-- Continue with the existing date section -->
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-gray-700 font-medium mb-2">Darbo data</h3>
                        <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}
                            @if(isset($reservation->time))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-4 mr-2 text-gray-400"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $reservation->time }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4 mt-4">
                    @if($reservation->status == 'pending')
                        <form id="acceptForm" method="POST" action="{{ route('reservation.accept', $reservation->id) }}">
                            @csrf
                            <button type="button"
                                    onclick="showConfirmationModal('accept')"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-3 py-2 bg-primary-light text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Patvirtinti
                            </button>
                        </form>

                        <form id="declineForm" method="POST" action="{{ route('reservation.declineProvider', $reservation->id) }}">
                            @csrf
                            <button type="button"
                                    onclick="showConfirmationModal('decline')"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-3 py-2 border border-red-600 text-red-600 rounded-md hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Atmesti
                            </button>
                        </form>
                    @elseif($reservation->status == 'accepted')
                        <form id="completeForm" method="POST" action="{{ route('reservation.complete', $reservation->id) }}">
                            @csrf
                            <button type="button"
                                    onclick="showConfirmationModal('complete')"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-green-700 text-white mt-4 rounded-md hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Pažymėti kaip užbaigtą
                            </button>
                        </form>
                    @endif
                </div>

                @if($reservation->status == 'pending')
                    <div class="mt-4">
                        <button type="button"
                                class="text-primary-light hover:text-primary-dark underline focus:outline-none text-sm"
                                onclick="openDateChangeModal()">
                            Keisti rezervacijos detales...
                        </button>
                    </div>
                @endif
            </div>

            @if($reservation->status == 'accepted' || $reservation->status == 'completed' || $reservation->status == 'pending')
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Klientas</h2>
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-xl font-bold text-white overflow-hidden mr-4">
                            @if($reservation->seeker->image)
                                <img src="{{ asset('storage/' . $reservation->seeker->image) }}"
                                     alt="{{ ucfirst($reservation->seeker->name) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($reservation->seeker->name, 0, 1) }}{{ substr($reservation->seeker->lastname, 0, 1) }}
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-800">
                                {{ ucfirst($reservation->seeker->name) }}
                                @if($reservation->status !== 'pending')
                                    {{ ucfirst($reservation->seeker->lastname) }}
                                @endif
                            </h3>
                            @if($reservation->status !== 'pending')
                                <p class="text-gray-600 text-sm">
                                    {{ $reservation->seeker->email }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Profile View Button -->
                    <div class="mb-4">
                        <button onclick="openSeekerProfileModal()"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Peržiūrėti Profilį
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        @if($reservation->status !== 'pending')
                            <div>
                                <h3 class="text-gray-600 text-sm mb-1">Adresas</h3>
                                <p class="text-gray-800">{{ $reservation->address . ', ' .  $reservation->city ?? 'Nepateiktas' }}</p>
                            </div>

                            <div>
                                <h3 class="text-gray-600 text-sm mb-1">Telefono numeris</h3>
                                <p class="text-gray-800">{{ '+370' . $reservation->phone ?? 'Nepateiktas' }}</p>
                            </div>
                        @endif
                    </div>

                    @if($reservation->status == 'pending')
                        <div>
                            <p class="text-gray-800">Daugiau informacijos matoma patvirtinus rezervaciją.</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Right column: Status updates and chat -->
        <div class="col-span-5">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <!-- Progress tracker -->
                <div class="bg-white rounded-lg p-4 md:p-6">
                    <div class="relative">
                        <!-- Status labels - hidden on mobile, visible on larger screens -->
                        <div class="hidden md:flex justify-between mb-2">
                            @if($reservation->status !== 'declined')
                                <div class="text-center {{ $reservation->status == 'pending' ? 'text-primary font-medium' : '' }}">
                                    <span>Užklausa</span>
                                </div>
                                <div class="text-center {{ $reservation->status == 'accepted' ? 'text-primary font-medium' : '' }}">
                                    <span>Patvirtinta</span>
                                </div>
                                <div class="text-center {{ $reservation->status == 'completed' ? 'text-primary font-medium' : '' }}">
                                    <span>Užbaigta</span>
                                </div>
                            @else
                                <div class="text-center {{ $reservation->status == 'declined' ? 'text-red-800 font-medium' : '' }}">
                                    <span>Atmesta</span>
                                </div>
                            @endif
                        </div>

                        <!-- Progress bar -->
                        <div class="overflow-hidden h-2 mb-4 flex bg-gray-200 rounded">
                            @if($reservation->status == 'pending')
                                <div class="bg-primary" style="width: 25%"></div>
                            @elseif($reservation->status == 'accepted')
                                <div class="bg-primary" style="width: 60%"></div>
                            @elseif($reservation->status == 'completed')
                                <div class="bg-primary" style="width: 100%"></div>
                            @else
                                <div class="bg-red-900" style="width: 100%"></div>
                            @endif
                        </div>

                        <!-- Mobile-friendly status indicator -->
                        <div class="md:hidden text-center mb-2">
                            <span class="font-medium text-primary">
                                @if($reservation->status == 'pending')
                                    Užklausa (1/3)
                                @elseif($reservation->status == 'accepted')
                                    Patvirtinta (2/3)
                                @elseif($reservation->status == 'completed')
                                    Užbaigta (3/3)
                                @elseif($reservation->status == 'declined')
                                    <span class="text-red-800">Atmesta</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <h2 class="text-lg font-semibold text-primary mb-4">Užklausos statusas</h2>
                    <div class="mb-4">
                        @if($reservation->status == 'pending')
                            <div class="flex items-center">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-yellow-100 text-yellow-800 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                <span class="text-yellow-800 font-medium">Laukiama patvirtinimo</span>
                            </div>
                        @elseif($reservation->status == 'accepted')
                            <div class="flex items-center">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100 text-green-800 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                <span class="text-green-800 font-medium">Patvirtinta</span>
                            </div>
                        @elseif($reservation->status == 'completed')
                            <div class="flex items-center">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-800 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                <span class="text-blue-800 font-medium">Užbaigta</span>
                            </div>
                        @elseif($reservation->status == 'declined')
                            <div class="flex items-center">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-red-100 text-red-800 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                <span class="text-red-800 font-medium">Atmesta</span>
                            </div>
                        @endif
                    </div>

                    <h3 class="text-gray-700 font-medium mb-2">Mokėjimas</h3>
                    <p class="text-gray-600 mb-4">Vietoje tiesiogiai</p>

                    <h3 class="text-gray-700 font-medium mb-2">Sukurta</h3>
                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($reservation->created_at)->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <!-- Chat functionality -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                @livewire('chat-box', ['reservation' => $reservation])
            </div>
        </div>
    </div>

    <!-- Modalinis langas datos keitimui -->
    <div id="dateChangeModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Tamsus fonas -->
            <div class="fixed inset-0 transition-opacity" onclick="closeDateChangeModal()">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modalinio lango turinys -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <form id="dateChangeForm" method="POST" action="{{ route('reservations.editProvider', $reservation->id) }}">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Keisti rezervacijos datą
                                </h3>
                                <p class="text-red-500 mt-3">Turėkite omenyje, kad prieš keičiant datą ar kainą privalote susitarti su klientu. Tam naudokite susirašinėjimo funkciją.</p>
                                <div class="mt-4">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label for="date" class="block text-sm font-medium text-gray-700">Nauja data</label>
                                        <input type="date" id="date" name="date"
                                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                               value="{{ old('date', is_object($reservation->reservation_date) ? $reservation->reservation_date->format('Y-m-d') : $reservation->reservation_date) }}"
                                               required>
                                        @error('date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Keisti kainą
                                </h3>
                                <div class="mt-4">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Nauja kaina</label>
                                    <input type="number" id="price" name="price"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                           value="{{ old('price', $reservation->price) }}"
                                           required>
                                    @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="dateChangeForm"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Išsaugoti
                    </button>
                    <button type="button" onclick="closeDateChangeModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Atšaukti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" onclick="closeConfirmationModal()">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- Icon -->
                        <div id="modalIcon" class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Icon will be dynamically updated -->
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">
                                <!-- Title will be dynamically updated -->
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="modalMessage">
                                    <!-- Message will be dynamically updated -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="confirmButton" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-3 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm sm:py-2">
                        <!-- Button text and color will be dynamically updated -->
                    </button>
                    <button type="button" onclick="closeConfirmationModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-3 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm sm:py-2">
                        Atšaukti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Seeker Profile Modal -->
    <div id="seekerProfileModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Kliento Profilis</h3>
                <button onclick="closeSeekerProfileModal()" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4 max-h-96 overflow-y-auto">
                <!-- Profile Photo -->
                <div class="flex justify-center mb-6">
                    <div class="w-40 h-40 rounded-full bg-gray-300 overflow-hidden shadow-lg">
                        @if($reservation->seeker->image)
                            <img src="{{ asset('storage/' . $reservation->seeker->image) }}"
                                 alt="{{ $reservation->seeker->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-white">
                                {{ substr($reservation->seeker->name, 0, 1) }}{{ substr($reservation->seeker->lastname, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vardas</label>
                        <p class="text-gray-900">{{ ucfirst($reservation->seeker->name) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pavardė</label>
                        <p class="text-gray-900">{{ ucfirst($reservation->seeker->lastname) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amžius</label>
                        <p class="text-gray-900">
                            @if($reservation->seeker->birthday)
                                {{ \Carbon\Carbon::parse($reservation->seeker->birthday)->age }} metai
                            @else
                                Nenurodyta
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lytis</label>
                        <p class="text-gray-900">
                            @if($reservation->seeker->gender == 'male')
                                Vyras
                            @elseif($reservation->seeker->gender == 'female')
                                Moteris
                            @else
                                Nenurodyta
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Languages -->
                @if($reservation->seeker->languages)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kalbos</label>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $languages = is_string($reservation->seeker->languages)
                                    ? json_decode($reservation->seeker->languages, true)
                                    : $reservation->seeker->languages;
                            @endphp
                            @if($languages)
                                @foreach($languages as $language)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $language }}
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif

                <!-- About Me -->
                @if($reservation->seeker->aboutme)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apie mane</label>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700">{{ $reservation->seeker->aboutme }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end pt-4 border-t">
                <button onclick="closeSeekerProfileModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Uždaryti
                </button>
            </div>
        </div>
    </div>

    <script>
        function openDateChangeModal() {
            document.getElementById('dateChangeModal').classList.remove('hidden');
        }

        function closeDateChangeModal() {
            document.getElementById('dateChangeModal').classList.add('hidden');
        }

        // Seeker Profile Modal Functions
        function openSeekerProfileModal() {
            const modal = document.getElementById('seekerProfileModal');
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeSeekerProfileModal() {
            const modal = document.getElementById('seekerProfileModal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Uždaryti modalinį langą paspaudus Escape klavišą
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDateChangeModal();
                closeConfirmationModal();
                closeSeekerProfileModal();
            }
        });

        // Jei yra validavimo klaidų, automatiškai atidaryti modalinį langą
        @if($errors->has('date'))
        document.addEventListener('DOMContentLoaded', function() {
            openDateChangeModal();
        });
        @endif

        let currentAction = '';

        function showConfirmationModal(action) {
            currentAction = action;
            const modal = document.getElementById('confirmationModal');
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const confirmButton = document.getElementById('confirmButton');

            if (action === 'accept') {
                // Accept configuration
                modalIcon.innerHTML = '<svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                modalIcon.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10';
                modalTitle.textContent = 'Patvirtinti užklausą';
                modalMessage.textContent = 'Ar tikrai norite patvirtinti šią užklausą? Po patvirtinimo galėsite matyti kliento kontaktinius duomenis.';
                confirmButton.textContent = 'Taip, patvirtinti';
                confirmButton.className = 'w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-3 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm sm:py-2';
            } else if (action === 'decline') {
                // Decline configuration
                modalIcon.innerHTML = '<svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L5.732 15.5c-.77.833.192 2.5 1.732 2.5z" /></svg>';
                modalIcon.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10';
                modalTitle.textContent = 'Atmesti užklausą';
                modalMessage.textContent = 'Ar tikrai norite atmesti šią užklausą? Šio veiksmo nebegalėsite atšaukti.';
                confirmButton.textContent = 'Taip, atmesti';
                confirmButton.className = 'w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-3 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm sm:py-2';
            } else if (action === 'complete') {
                // Complete configuration
                modalIcon.innerHTML = '<svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                modalIcon.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10';
                modalTitle.textContent = 'Užbaigti užklausą';
                modalMessage.textContent = 'Ar tikrai norite pažymėti šią užklausą kaip užbaigtą? Po to klientas galės palikti atsiliepimą apie jūsų paslaugas.';
                confirmButton.textContent = 'Taip, užbaigti';
                confirmButton.className = 'w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-3 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm sm:py-2';
            }

            confirmButton.onclick = function() {
                executeAction();
            };

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeConfirmationModal() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
            currentAction = '';
        }

        function executeAction() {
            if (currentAction === 'accept') {
                document.getElementById('acceptForm').submit();
            } else if (currentAction === 'decline') {
                document.getElementById('declineForm').submit();
            } else if (currentAction === 'complete') {
                document.getElementById('completeForm').submit();
            }
            closeConfirmationModal();
        }

        // Prevent modal from closing when clicking inside the modal content
        document.addEventListener('DOMContentLoaded', function() {
            // Confirmation modal click outside handler
            const confirmationModal = document.getElementById('confirmationModal');
            if (confirmationModal) {
                const modalContent = confirmationModal.querySelector('.inline-block');
                if (modalContent) {
                    modalContent.addEventListener('click', function(event) {
                        event.stopPropagation();
                    });
                }
            }

            // Seeker profile modal click outside handler
            const seekerProfileModal = document.getElementById('seekerProfileModal');
            if (seekerProfileModal) {
                seekerProfileModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeSeekerProfileModal();
                    }
                });
            }
        });
    </script>
@endsection
