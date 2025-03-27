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
                        <h3 class="text-gray-700 font-medium mb-2">Rezervacijos data</h3>
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
                        <form method="POST" action="{{ route('reservation.accept', $reservation->id) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 text-sm ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Patvirtinti
                            </button>
                        </form>

                        <form method="POST" action="{{ route('reservation.declineProvider', $reservation->id) }}">
                            @csrf
                            <button type="submit" onclick="return confirm('Ar tikrai norite atmesti šią užklausą?')"
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
                        <div
                            class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-xl font-bold text-white overflow-hidden mr-4">
                            @if($reservation->seeker->image)
                                <img src="{{ asset('storage/' . $reservation->seeker->image) }}"
                                     alt="{{ ucfirst($reservation->seeker->name) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($reservation->seeker->name, 0, 1) }}{{ substr($reservation->seeker->lastname, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{ ucfirst($reservation->seeker->name) }}
                                @if($reservation->status !== 'pending')
                                    {{ ucfirst($reservation->seeker->lastname) }}
                            </h3>
                            <p class="text-gray-600 text-sm">
                                {{ $reservation->seeker->email }}
                            </p>
                            @endif
                        </div>
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
                                {{--                    @elseif($reservation->status == 'processing')--}}
                                {{--                        <div class="bg-primary" style="width: 60%"></div>--}}
                                {{--                    @elseif($reservation->status == 'in_progress')--}}
                                {{--                        <div class="bg-primary" style="width: 80%"></div>--}}
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
                    {{--                @elseif($reservation->status == 'processing')--}}
                    {{--                    Apmokėta (3/5)--}}
                    {{--                @elseif($reservation->status == 'in_progress')--}}
                    {{--                    Vykdoma (3/4)--}}
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
            </div>
            <!-- Chat functionality -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                @livewire('chat-box', ['reservation' => $reservation])
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
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Keisti rezervacijos datą
                                </h3>
                                <p class="text-red-500 mt-3">Turėkite omenyje, kad prieš keičiant datą privalote susitarti su klientu. Tam naudokite
                                 susirašinėjimo funkciją.</p>
                                <div class="mt-4">
                                    <form id="dateChangeForm" method="POST"
                                          action="{{ route('reservations.editProvider', $reservation->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-4">
                                            <label for="date" class="block text-sm font-medium text-gray-700">Nauja
                                                data</label>
                                            <input type="date" id="date" name="date"
                                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                   value="{{ old('date', is_object($reservation->reservation_date) ? $reservation->reservation_date->format('Y-m-d') : $reservation->reservation_date) }}"
                                                   required>
                                            @error('date')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
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
@endsection

        <script>
            function openDateChangeModal() {
                document.getElementById('dateChangeModal').classList.remove('hidden');
            }

            function closeDateChangeModal() {
                document.getElementById('dateChangeModal').classList.add('hidden');
            }

            // Uždaryti modalinį langą paspaudus Escape klavišą
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeDateChangeModal();
                }
            });

            // Jei yra validavimo klaidų, automatiškai atidaryti modalinį langą
            @if($errors->has('date'))
            document.addEventListener('DOMContentLoaded', function() {
                openDateChangeModal();
            });
            @endif
        </script>
