@extends('layouts.main')

@section('content')

    <x-profile-nav-tabs/>
    <div class="grid grid-cols-12 gap-4 px-2 sm:px-4 max-w-5xl mx-auto">

        <!-- Profile Column -->
        <div class="col-span-12 md:col-span-4 lg:col-span-4">
            <!-- Existing Profile Block -->
            <div class="mb-4 mt-4 bg-white rounded-lg shadow p-4 sm:p-6">
                <!-- Profile Picture and Name (Centered) -->
                <div class="flex flex-col items-center">
                    @if($user->image)
                        <img src="{{ $user->profile_photo_url }}"
                             class="w-24 h-24 sm:w-28 sm:h-28 md:w-40 md:h-40 rounded-full mb-4 object-cover"
                             alt="Current profile photo">
                    @else
                        <div
                            class="w-24 h-24 sm:w-28 sm:h-28 md:w-40 md:h-40 rounded-full mb-4 flex items-center justify-center bg-gray-400 text-white text-3xl sm:text-4xl md:text-5xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1) . substr($user->lastname, 0, 1)) }}
                        </div>
                    @endif
                    <p class="text-primary-light text-lg sm:text-xl md:text-2xl font-bold text-center mt-4">{{ ucfirst($user->name) }}</p>
                </div>
                <div class="flex flex-col items-center mt-10">
                    <p class="text-primary text-md md:text-lg font-light text-center">
                        Narys nuo <span
                            class="text-primary-verylight italic">{{ $user->created_at->format('Y') }}</span>
                    </p>
                </div>
            </div>

            <!-- New Additional Block -->
            <div class="mb-4 bg-white rounded-lg shadow p-4 sm:p-6">
                @if($user->role == 'provider')
                    <!-- Content for Providers -->
                    <div class="flex flex-col items-center">
                        <h3 class="text-primary-light text-lg sm:text-xl font-semibold mb-4">Artimiausi užsakymai</h3>
                        <div class="w-full">
                            @if($upcomingReservations && $upcomingReservations->count() > 0)
                                @foreach($upcomingReservations as $reservation)
                                    <div class="mb-3 p-3 bg-gray-50 rounded-lg border-l-4 border-primary-light">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center mb-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="text-sm font-semibold text-gray-800">
                                            {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}
                                        </span>
                                                </div>
                                                @if($reservation->seeker)
                                                    <div class="flex items-center mb-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        <span class="text-sm text-gray-600">{{ $reservation->seeker->name }}</span>
                                                    </div>
                                                @endif
                                                @if($reservation->subcategory)
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                        </svg>
                                                        <span class="text-xs text-gray-500">{{ $reservation->subcategory }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($reservation->status == 'accepted') bg-green-100 text-green-800
                                        @elseif($reservation->status == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if(isset($totalProviderReservations) && $totalProviderReservations > 5)
                                    <div class="text-center mt-3">
                                        <a href="{{route('reservations.provider')}}" class="text-primary-light text-sm hover:underline">
                                            Žiūrėti visus užsakymus ({{ $totalProviderReservations }})
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-gray-500 text-center">Nėra ateinančių užsakymų</p>
                                    <p class="text-gray-400 text-sm text-center mt-1">Nauji užsakymai atsiras čia</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Content for Seekers -->
                    <div class="flex flex-col items-center">
                        <h3 class="text-primary-light text-lg sm:text-xl font-semibold mb-4">Mano užsakymai</h3>
                        <div class="w-full">
                            @if($upcomingReservations && $upcomingReservations->count() > 0)
                                @foreach($upcomingReservations as $reservation)
                                    <div class="mb-3 p-3 bg-gray-50 rounded-lg border-l-4 border-primary-light">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center mb-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="text-sm font-semibold text-gray-800">
    @php
        $date = \Carbon\Carbon::parse($reservation->reservation_date);
        $months = [
            1 => 'Sausis', 2 => 'Vasaris', 3 => 'Kovas', 4 => 'Balandis',
            5 => 'Gegužė', 6 => 'Birželis', 7 => 'Liepa', 8 => 'Rugpjūtis',
            9 => 'Rugsėjis', 10 => 'Spalis', 11 => 'Lapkritis', 12 => 'Gruodis'
        ];
        $monthName = $months[$date->month];
    @endphp
                                                        {{ $monthName }} {{ $date->day }}, {{ $date->year }}
</span>
                                                </div>
                                                @if($reservation->provider)
                                                    <div class="flex items-center mb-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        <span class="text-sm text-gray-600">{{ $reservation->provider->name }}</span>
                                                    </div>
                                                @endif
                                                @if($reservation->subcategory)
                                                    <div class="flex items-center mb-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                        </svg>
                                                        <span class="text-xs text-gray-500">{{ $reservation->subcategory }}</span>
                                                    </div>
                                                @endif
                                                @if($reservation->city)
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        <span class="text-xs text-gray-500">{{ $reservation->city }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        bg-green-100 text-green-800
                                        ">
                                        Priimta
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if(isset($totalSeekerReservations) && $totalSeekerReservations > 5)
                                    <div class="text-center mt-3">
                                        <a href="{{route('reservations.seeker')}}}" class="text-blue-500 text-sm hover:underline">
                                            Žiūrėti visus užsakymus ({{ $totalSeekerReservations }})
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h10a2 2 0 002-2V7a2 2 0 00-2-2H9m0 0V3m0 2v2" />
                                    </svg>
                                    <p class="text-gray-500 text-center">Nėra aktyvių užsakymų</p>
                                    <p class="text-gray-400 text-sm text-center mt-1">Padarykite naują užsakymą</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Stats Column -->
        <div class="col-span-12 md:col-span-8 lg:col-span-8">
            <div class="bg-white mb-4 mt-4 rounded-lg shadow p-4 sm:p-6">
                <p class="text-primary-light text-lg sm:text-xl md:text-2xl font-medium mb-4">Mano Statistika</p>

                <div class="flex flex-col sm:flex-row justify-between items-start px-2 sm:px-6 md:px-8 lg:px-10">
                    @if($user->role == 'provider')
                        <!-- Rating Display -->
                        <div class="flex flex-col items-center w-full sm:w-auto mb-4 sm:mb-0">
                            <div class="flex items-center">
                            <span class="text-2xl sm:text-3xl font-bold text-primary-verylight">
                             {{ number_format($user->average_rating, 1) }}
                              </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 sm:h-6 sm:w-6 ml-1 text-yellow-400"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500 mt-1">Jūsų Reitingas</span>
                        </div>


                        <!-- Received Reviews - New Element -->
                        <div class="flex flex-col items-center w-full sm:w-auto mb-4 sm:mb-0">
                            <!-- Review Count with Icon -->
                            <div class="flex items-center">
                            <span class="text-2xl sm:text-3xl font-bold text-indigo-600">
                             {{ $user->reviewsReceived()->count() }}
                             </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 sm:h-6 sm:w-6 ml-1 text-indigo-500"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 12h.01M12 12h.01M16 12h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500 mt-1">
                             {{ $user->reviewsReceived()->count() == 1 ? 'Atsiliepimas' : 'Atsiliepimai' }}
                             </span>
                        </div>
                        <!-- Completed Orders - Styled like Rating -->
                        <div class="flex flex-col items-center w-full sm:w-auto">
                            <!-- Order Count with Icon -->
                            <div class="flex items-center">
                            <span class="text-2xl sm:text-3xl font-bold text-teal-600">
                            {{$user->getTotalReservationsDone()}}
                            </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 sm:h-6 sm:w-6 ml-1 text-primary-light"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd"
                                          d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500 mt-1">Įvykdyti Užsakymai</span>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Notifications Component -->
            <div class="w-full mb-4">
                @livewire('notifications-component')
            </div>

            <div class="w-full mb-4">
                @livewire('last-messages-component')
            </div>
        </div>
    </div>
@endsection
