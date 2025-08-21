@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto p-4 md:p-6">
        <!-- Back button -->
        <a href="{{ route('reservations.seeker') }}"
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

    @if($reservation->status == 'completed')
        @livewire('reservation-feedback', ['reservation' => $reservation])
    @endif

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-8 gap-6">
        <!-- Left column: Service details -->
        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-start">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $reservation->subcategory ?? 'Bendra paslauga' }}</h2>
                        <p class="text-gray-600">{{ $reservation->city }}</p>

                        @if(isset($reservation->task_size))
                            <div
                                class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
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
                <div class="flex flex-col sm:flex-row justify-left space-y-3 sm:space-y-0 sm:space-x-4 mt-4">
                    @if($reservation->status == 'pending')

                        <form method="POST" action="{{ route('reservation.declineSeeker', $reservation->id) }}">
                            @csrf
                            <button type="submit" onclick="return confirm('Ar tikrai norite atmesti šią užklausą?')"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-2 py-1 border border-red-600 text-red-600 rounded-md hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Atšaukti užklausą
                            </button>
                        </form>

                    @elseif($reservation->status == 'accepted' && $user->role == 'provider' )
                        <form method="POST" action="{{ route('reservation.complete', $reservation->id) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
            </div>

            @if($reservation->status == 'accepted' || $reservation->status == 'completed' || $reservation->status == 'pending')
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Meistras</h2>
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-xl font-bold text-white overflow-hidden mr-4">
                            @if($reservation->provider->image)
                                <img src="{{ asset('storage/' . $reservation->provider->image) }}"
                                     alt="{{ ucfirst($reservation->provider->name . ' ' . ucfirst($reservation->provider->lastname)) }}"
                                     class="w-full h-full object-cover">
                            @else
                                {{ substr($reservation->provider->name, 0, 1) }}{{ substr($reservation->provider->lastname, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{ ucfirst($reservation->provider->name) }} {{ ucfirst($reservation->provider->lastname) }}</h3>
                            @if($reservation->status == 'accepted')
                                <p class="text-gray-600 text-sm">
                                    {{ $reservation->provider->email }}
                                </p>
                            @elseif($reservation->status == 'pending')
                                <p class="text-gray-600 text-sm">
                                    Daugiau informacijos matysite kai bus patvirtinta rezervacija.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- ADD PRICING INFORMATION HERE -->
                    @if(isset($reservation->provider->pricing_info) && $reservation->provider->pricing_info)
                        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                            <h3 class="text-gray-700 font-medium mb-2">Kainos informacija</h3>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-2 sm:space-y-0">
                                <!-- Price -->
                                @if($reservation->provider->pricing_info['price'])
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-700 mr-2">Kaina:</span>
                                        <span class="font-bold text-primary text-lg">{{ $reservation->provider->pricing_info['formatted_price'] }}€</span>
                                        @if($reservation->provider->pricing_info['type'])
                                            <span class="text-gray-600 ml-1">{{ $reservation->provider->pricing_info['type_label_full'] }}</span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Experience -->
                                @if($reservation->provider->pricing_info['experience'])
                                    <div class="flex items-center text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                        <span class="text-sm font-medium">{{ $reservation->provider->pricing_info['experience'] }} m. patirtis</span>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-2 text-xs text-gray-500">
                                * Galutinė kaina bus aptarta su meistru priklausomai nuo darbo specifikos
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        @if($reservation->status == 'accepted')
                            <div>
                                <h3 class="text-gray-600 text-sm mb-1">Telefono numeris</h3>
                                <p class="text-gray-800">{{  $reservation->provider->phone }}</p>
                            </div>
                        @endif
                    </div>
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
                                <div
                                    class="text-center {{ $reservation->status == 'pending' ? 'text-primary font-medium' : '' }}">
                                    <span>Užklausa</span>
                                </div>
                                <div
                                    class="text-center {{ $reservation->status == 'accepted' ? 'text-primary font-medium' : '' }}">
                                    <span>Patvirtinta</span>
                                </div>
                                <div
                                    class="text-center {{ $reservation->status == 'completed' ? 'text-primary font-medium' : '' }}">
                                    <span>Užbaigta</span>
                                </div>
                            @else
                                <div
                                    class="text-center  {{ $reservation->status == 'declined' ? 'text-red-800 font-medium' : '' }}">
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
                </div>
                <h2 class="text-lg font-semibold text-primary mb-4">Užklausos statusas</h2>
                <div class="mb-4">
                    @if($reservation->status == 'pending')
                        <div class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-yellow-100 text-yellow-800 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="text-yellow-800 font-medium">Laukiama patvirtinimo</span>
                        </div>
                    @elseif($reservation->status == 'accepted')
                        <div class="flex items-center">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100 text-green-800 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            <span class="text-green-800 font-medium">Patvirtinta</span>
                        </div>
                    @elseif($reservation->status == 'completed')
                        <div class="flex items-center">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-800 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            <span class="text-blue-800 font-medium">Užbaigta</span>
                        </div>
                    @elseif($reservation->status == 'declined')
                        <div class="flex items-center">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-red-100 text-red-800 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            <span class="text-red-800 font-medium">Atmesta</span>
                        </div>
                    @endif
                </div>

                <h3 class="text-gray-700 font-medium mb-2">Mokėjimas</h3>
                <p class="text-gray-600 mb-4">
                    Vietoje tiesiogiai
                </p>

                <h3 class="text-gray-700 font-medium mb-2">Sukurta</h3>
                <p class="text-gray-600">{{ \Carbon\Carbon::parse($reservation->created_at)->format('Y-m-d H:i') }}</p>
            </div>

            <!-- Chat functionality -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                @livewire('chat-box', ['reservation' => $reservation])
            </div>
        </div>
    </div>
@endsection
