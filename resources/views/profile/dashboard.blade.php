@extends('layouts.main')

@section('content')

    <x-profile-nav-tabs/>
    <div class="grid grid-cols-12 gap-6 px-4 sm:px-6 max-w-5xl mx-auto">

        <!-- Profile Column -->
        <div class="col-span-12 lg:col-span-4">
            <!-- Profile Card - Enhanced -->
            <div class="mb-6 mt-6 bg-gradient-to-b from-white to-gray-50 rounded-xl shadow-lg p-6 sm:p-8 border border-gray-100">
                <!-- Profile Picture and Name -->
                <div class="flex flex-col items-center">
                    <div class="relative group">
                        @if($user->image)
                            <img src="{{ $user->profile_photo_url }}"
                                 class="w-32 h-32 sm:w-36 sm:h-36 md:w-44 md:h-44 rounded-full object-cover ring-4 ring-white shadow-xl transition-transform duration-300 group-hover:scale-105"
                                 alt="Current profile photo">
                        @else
                            <div
                                class="w-32 h-32 sm:w-36 sm:h-36 md:w-44 md:h-44 rounded-full flex items-center justify-center bg-primary-light text-white text-4xl sm:text-5xl md:text-6xl font-bold ring-4 ring-white shadow-xl transition-transform duration-300 group-hover:scale-105">
                                {{ strtoupper(substr($user->name, 0, 1) . substr($user->lastname, 0, 1)) }}
                            </div>
                        @endif
                        <!-- Status indicator -->
                        <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                    </div>
                    <h2 class="text-primary-light text-2xl sm:text-3xl font-bold mt-6">{{ ucfirst($user->name) }}</h2>
                    <p class="text-gray-500 text-sm font-medium mt-2">
                        Narys nuo <span class="text-primary-light font-semibold">{{ $user->created_at->format('Y') }}</span>
                    </p>
                </div>
            </div>

            <!-- Upcoming Reservations Card - Enhanced -->
            <div class="mb-6 bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                @if($user->role == 'provider')
                    <!-- Provider Content -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-primary-light">Artimiausi</h3>
                        <span class="bg-primary-light/10 text-primary-light text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $activeReservationsCount }} aktyvūs
                        </span>
                    </div>

                    <div class="space-y-3">
                        @if($upcomingReservations && $upcomingReservations->count() > 0)
                            @foreach($upcomingReservations as $reservation)
                                <a href="{{ route('reservation.modify', ['id' => $reservation->id]) }}"
                                   class="block group hover:scale-[1.02] transition-all duration-200">
                                    <div class="p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border-l-4 border-primary-light hover:shadow-md transition-all duration-200">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <!-- Date with better formatting -->
                                                <div class="flex items-center mb-2">
                                                    <div class="w-8 h-8 bg-primary-light/10 rounded-full flex items-center justify-center mr-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-sm font-bold text-gray-900">
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

                                                @if($reservation->seeker)
                                                    <div class="flex items-center mb-1 ml-11">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        <span class="text-sm text-gray-600">{{ $reservation->seeker->name }}</span>
                                                    </div>
                                                @endif

                                                @if($reservation->subcategory)
                                                    <div class="flex items-center ml-11">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                                        </svg>
                                                        <span class="text-xs text-gray-500">{{ $reservation->subcategory }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex flex-col items-end gap-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                    @if($reservation->status == 'accepted') bg-green-100 text-green-700
                                                    @elseif($reservation->status == 'pending') bg-amber-100 text-amber-700 animate-pulse
                                                    @endif">
                                                    {{ ucfirst($reservation->status) }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            @if($activeReservationsCount > 5)
                                <div class="text-center pt-4 border-t border-gray-100">
                                    <a href="{{route('reservations.provider')}}"
                                       class="inline-flex items-center gap-2 text-sm font-medium text-primary-light hover:text-primary transition-colors duration-200">
                                        <span>Visi Užsakymai</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-900 font-medium">Nėra ateinančių užsakymų</p>
                                <p class="text-gray-500 text-sm mt-1">Nauji užsakymai atsiras čia</p>
                            </div>
                        @endif
                    </div>
                @else
                    <!-- Seeker Content -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-primary-light">Artimiausi</h3>
                        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $activeReservationsCount }} aktyvūs
                        </span>
                    </div>

                    <div class="space-y-3">
                        @if($upcomingReservations && $upcomingReservations->count() > 0)
                            @foreach($upcomingReservations as $reservation)
                                <a href="{{ route('reservation.modifySeeker', ['id' => $reservation->id]) }}"
                                   class="block group hover:scale-[1.02] transition-all duration-200">
                                    <div class="p-4  rounded-lg border-l-4 border-primary-light hover:shadow-md transition-all duration-200">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <!-- Date -->
                                                <div class="flex items-center mb-2">
                                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-sm font-bold text-gray-900">
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
                                                    <div class="flex items-center mb-1 ml-11">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        <span class="text-sm text-gray-600">{{ $reservation->provider->name }}</span>
                                                    </div>
                                                @endif

                                                @if($reservation->subcategory)
                                                    <div class="flex items-center mb-1 ml-11">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                                        </svg>
                                                        <span class="text-xs text-gray-500">{{ $reservation->subcategory }}</span>
                                                    </div>
                                                @endif

                                                @if($reservation->city)
                                                    <div class="flex items-center ml-11">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        <span class="text-xs text-gray-500">{{ $reservation->city }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex flex-col items-end gap-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                    @if($reservation->status == 'accepted') bg-green-100 text-green-700
                                                    @elseif($reservation->status == 'pending') bg-amber-100 text-amber-700 animate-pulse
                                                    @endif">
                                                    {{ ucfirst($reservation->status) }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            @if($activeReservationsCount > 5)
                                <div class="text-center pt-4 border-t border-gray-100">
                                    <a href="{{route('reservations.seeker')}}"
                                       class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                        <span>Visi Užsakymai</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <p class="text-gray-900 font-medium">Nėra aktyvių užsakymų</p>
                                <p class="text-gray-500 text-sm mt-1">Padarykite naują užsakymą</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Stats Column -->
        <div class="col-span-12 lg:col-span-8">
            <!-- Statistics Card - Enhanced -->
            <div class="bg-white mb-6 mt-6 rounded-xl shadow-lg p-6 sm:p-8 border border-gray-100">
                <h3 class="text-2xl font-bold text-primary-light mb-8">Mano Statistika</h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @if($user->role == 'provider')
                        <!-- Rating -->
                        <div class="p-6 rounded-xl border border-yellow-100 hover:shadow-md transition-all duration-200">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ number_format($user->average_rating, 1) }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-7 w-7 ml-2 text-yellow-400"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Jūsų Reitingas</span>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div class="p-6 rounded-xl border border-indigo-100 hover:shadow-md transition-all duration-200">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ $user->reviewsReceived()->count() }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-7 w-7 ml-2 text-indigo-500"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 12h.01M12 12h.01M16 12h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">
                                    {{ $user->reviewsReceived()->count() == 1 ? 'Atsiliepimas' : 'Atsiliepimai' }}
                                </span>
                            </div>
                        </div>

                        <!-- Completed -->
                        <div class="p-6 rounded-xl border border-teal-100 hover:shadow-md transition-all duration-200">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ $user->getTotalReservationsDone() }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-7 w-7 ml-2 text-teal-500"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Užsakymai</span>
                            </div>
                        </div>
                    @else
                        <!-- Seeker Statistics -->

                        <!-- Total Reservations -->
                        <div class="p-6 rounded-xl border border-blue-100 hover:shadow-md transition-all duration-200">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ $user->getTotalReservationsMade() }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-7 w-7 ml-2 text-blue-500"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Viso Užklausų</span>
                            </div>
                        </div>

                        <!-- Reviews Given -->
                        <div class="p-6 rounded-xl border border-purple-100 hover:shadow-md transition-all duration-200">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ $user->reviewsGiven()->count() }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-7 w-7 ml-2 text-purple-500"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">
                                    {{ $user->reviewsGiven()->count() == 1 ? 'Paliktas Atsiliepimas' : 'Palikti Atsiliepimai' }}
                                </span>
                            </div>
                        </div>

                        <!-- Active Reservations -->
                        <div class="p-6 rounded-xl border border-green-100 hover:shadow-md transition-all duration-200">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ $user->getActiveReservations() }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-7 w-7 ml-2 text-green-500"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Aktyvūs Užsakymai</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Notifications Component -->
            <div class="w-full mb-6">
                @livewire('notifications-component')
            </div>

            <div class="w-full mb-6">
                @include('components.reviews-in-dashboard')
            </div>

            <!-- Last Messages Component -->
            <div class="w-full mb-6">
                @livewire('last-messages-component')
            </div>

        </div>
    </div>
@endsection
