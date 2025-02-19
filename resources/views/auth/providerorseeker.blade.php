@extends('layouts.main')

@section('content')

    <div class="min-h-[90vh] flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-primary">
                Prisijunkite kaip Paslaugų Ieškotojas arba Teikėjas
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Pasirinkite savo paskyros tipą, kad pradėtumėte
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-2xl">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 px-4">
                {{-- Seeker Card --}}
                <a href="{{ route('register.seeker') }}" class="relative flex flex-col items-center p-8 bg-white border border-gray-200 rounded-lg shadow-sm hover:border-primary-verylight hover:shadow-md transition duration-150 ease-in-out">
                    <div class="flex-shrink-0 inline-flex items-center justify-center h-12 w-12 rounded-full text-primary-light mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-primary mb-2">Aš Esu Paslaugos Ieškotojas</h3>
                    <p class="text-sm text-gray-500 text-center">Ieškau paslaugų, kad man atliktu darbus</p>
                    <div class="absolute top-0 right-0 p-2">
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                {{-- Provider Card --}}
                <a href="{{ route('register.provider') }}" class="relative flex flex-col items-center p-8 bg-white border border-gray-200 rounded-lg shadow-sm hover:border-primary-verylight hover:shadow-md transition duration-150 ease-in-out">
                    <div class="flex-shrink-0 inline-flex items-center justify-center h-12 w-12 rounded-full text-primary-light mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-primary mb-2">Aš Esu Paslaugų Teikėjas</h3>
                    <p class="text-sm text-gray-500 text-center">Siūlau profesionalias paslaugas ir plėtoju savo verslą.</p>
                    <div class="absolute top-0 right-0 p-2">
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Jau turite paskyrą?
                    <a href="{{ route('login') }}" class="font-medium text-primary-light hover:text-primary-dark">
                        Prisijunkite
                    </a>
                </p>
            </div>
        </div>
    </div>

@endsection
