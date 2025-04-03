@extends('layouts.main')

@section('content')

    <x-profile-nav-tabs/>
    <div class="grid grid-cols-12 gap-4 px-2 sm:px-4 max-w-5xl mx-auto">

        <!-- Profile Column -->
        <div class="col-span-12 md:col-span-4 lg:col-span-4">
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
