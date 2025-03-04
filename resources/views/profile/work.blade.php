@extends('layouts.main')

@section('content')
    <!-- Responsive Tabs Navigation -->
    <div class="bg-gray-50 border-b shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap -mb-px justify-center">
                <a href="{{ route('myprofile') }}"
                   class="w-1/3 sm:w-auto whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm sm:text-base md:text-lg transition duration-150 ease-in-out
               {{ Route::currentRouteName() == 'myprofile'
                  ? 'border-primary-light text-primary-light'
                  : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <div class="flex items-center justify-center sm:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profilis</span>
                    </div>
                </a>

                @if(auth()->user()->role === 'provider')
                    <a href="{{ route('provider.work') }}"
                       class="w-1/3 sm:w-auto whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm sm:text-base md:text-lg transition duration-150 ease-in-out ml-0 sm:ml-8 md:ml-12
               {{ Route::currentRouteName() == 'provider.work'
                  ? 'border-primary-light text-primary-light'
                  : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center justify-center sm:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Darbas</span>
                        </div>
                    </a>

                    <a href="{{ route('provider.calendar') }}"
                       class="w-1/3 sm:w-auto whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm sm:text-base md:text-lg transition duration-150 ease-in-out ml-0 sm:ml-8 md:ml-12
               {{ Route::currentRouteName() == 'provider.calendar'
                  ? 'border-primary-light text-primary-light'
                  : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center justify-center sm:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Kalendorius</span>
                        </div>
                    </a>
                @endif
            </nav>
        </div>
    </div>

    <div class="w-full max-w-4xl mx-auto p-4">
    <livewire:provider-work-categories />
    </div>

@endsection
