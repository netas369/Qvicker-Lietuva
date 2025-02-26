@extends('layouts.main')

@section('content')
    <!-- Responsive Tabs Navigation -->
    <div class="bg-gray-50 border-b shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap -mb-px justify-center">
                <a href="{{ route('myprofile') }}"
                   class="w-1/2 sm:w-auto whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm sm:text-base md:text-lg transition duration-150 ease-in-out
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

                <a href="{{ route('provider.calendar') }}"
                   class="w-1/2 sm:w-auto whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm sm:text-base md:text-lg transition duration-150 ease-in-out ml-0 sm:ml-8 md:ml-12
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
            </nav>
        </div>
    </div>

{{--    <!-- Calendar Section -->--}}
{{--    <div class="container mx-auto px-4 py-6">--}}
{{--        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-4 md:p-6">--}}
{{--            <form id="calendar-form" method="POST" action="{{ route('provider.calendar.store') }}">--}}
{{--                @csrf--}}

{{--                <!-- Success/Error messages -->--}}
{{--                @if(session('success'))--}}
{{--                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">--}}
{{--                        {{ session('success') }}--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                @if(session('error'))--}}
{{--                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">--}}
{{--                        {{ session('error') }}--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <h3 class="text-xl font-semibold text-gray-800 mb-4">Pasirinkite datas</h3>--}}

{{--                <!-- Calendar Container - ONLY ONE -->--}}
{{--                <div id="calendar-container" class="mb-6 bg-white border border-gray-200 rounded-lg shadow-sm overflow-x-auto"></div>--}}

{{--                <!-- Action buttons -->--}}
{{--                <div class="grid grid-cols-2 gap-2 mb-4">--}}
{{--                    <button type="button" id="select-dates-btn" class="inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">--}}
{{--                        Pasirinkti datas--}}
{{--                    </button>--}}

{{--                    <button type="button" id="mark-unavailable-btn" class="inline-flex justify-center py-2 px-3 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--                        Pažymėti kaip užimtą--}}
{{--                    </button>--}}
{{--                </div>--}}

{{--                <!-- Hidden inputs -->--}}
{{--                <input type="hidden" id="start_date" name="start_date">--}}
{{--                <input type="hidden" id="end_date" name="end_date">--}}
{{--                <input type="hidden" id="unavailable_dates" name="unavailable_dates">--}}

{{--                <!-- Selected Dates Summary -->--}}
{{--                <div id="date-summary" class="hidden mb-4 p-3 bg-gray-50 rounded-md border border-gray-200">--}}
{{--                    <h3 class="font-medium text-gray-700 mb-2">Pasirinktos datos:</h3>--}}
{{--                    <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center">--}}
{{--                        <div>--}}
{{--                            <span class="text-sm text-gray-500">Nuo:</span>--}}
{{--                            <span id="summary-start-date" class="ml-2 font-medium"></span>--}}
{{--                        </div>--}}
{{--                        <div class="mt-2 sm:mt-0">--}}
{{--                            <span class="text-sm text-gray-500">Iki:</span>--}}
{{--                            <span id="summary-end-date" class="ml-2 font-medium"></span>--}}
{{--                        </div>--}}
{{--                        <div class="mt-2 sm:mt-0">--}}
{{--                            <span class="text-sm text-gray-500">Iš viso dienų:</span>--}}
{{--                            <span id="total-days" class="ml-2 font-medium"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Submit Button -->--}}
{{--                <div id="submit-container" class="hidden">--}}
{{--                    <div class="flex justify-center">--}}
{{--                        <button type="submit" class="w-1/2 inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-light hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light">--}}
{{--                            Išsaugoti pakeitimus--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Hidden input for existing unavailable dates -->--}}
{{--                <input type="hidden" id="existing_unavailable_dates" value="{{ $unavailableDates ?? '[]' }}">--}}
{{--            </form>--}}

{{--            <!-- Calendar Legend -->--}}
{{--            <div class="flex items-center justify-start space-x-4 mt-4 text-sm">--}}
{{--                <div class="flex items-center">--}}
{{--                    <div class="w-4 h-4 bg-blue-600 rounded-full mr-2"></div>--}}
{{--                    <span>Pasirinkta</span>--}}
{{--                </div>--}}
{{--                <div class="flex items-center">--}}
{{--                    <div class="w-4 h-4 rounded-full mr-2" style="background-color: #ffebee;"></div>--}}
{{--                    <span>Nepasiekiama</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <livewire:provider-calendar />
@endsection

{{--@push('styles')--}}
{{--    <style>--}}
{{--        /* Make Flatpickr responsive */--}}
{{--        .flatpickr-calendar {--}}
{{--            width: 100% !important;--}}
{{--            max-width: 100% !important;--}}
{{--        }--}}

{{--        .flatpickr-days {--}}
{{--            width: 100% !important;--}}
{{--        }--}}

{{--        .dayContainer {--}}
{{--            width: 100% !important;--}}
{{--            min-width: 100% !important;--}}
{{--            max-width: 100% !important;--}}
{{--        }--}}

{{--        .flatpickr-day {--}}
{{--            max-width: 14.28% !important;--}}
{{--            flex-basis: 14.28% !important;--}}
{{--        }--}}

{{--        /* Custom styling for unavailable dates */--}}
{{--        .flatpickr-day.flatpickr-disabled,--}}
{{--        .flatpickr-day.flatpickr-disabled:hover,--}}
{{--        .flatpickr-day.prevMonthDay.flatpickr-disabled,--}}
{{--        .flatpickr-day.nextMonthDay.flatpickr-disabled,--}}
{{--        .flatpickr-day.notAllowed,--}}
{{--        .flatpickr-day.notAllowed.prevMonthDay,--}}
{{--        .flatpickr-day.notAllowed.nextMonthDay {--}}
{{--            background-color: #FFA500 !important; /* Orange background */--}}
{{--            color: white !important; /* White text for contrast */--}}
{{--            text-decoration: line-through !important;--}}
{{--            border-color: transparent !important;--}}
{{--            cursor: not-allowed !important;--}}
{{--            font-weight: bold !important;--}}
{{--            opacity: 0.8 !important;--}}
{{--        }--}}

{{--        /* When hovering over a disabled date */--}}
{{--        .flatpickr-day.flatpickr-disabled:hover {--}}
{{--            background-color: #FF8C00 !important; /* Darker orange on hover */--}}
{{--            color: white !important;--}}
{{--        }--}}

{{--        @media screen and (max-width: 767px) {--}}
{{--            .flatpickr-calendar {--}}
{{--                font-size: 14px !important;--}}
{{--            }--}}

{{--            /* Force single month mode on mobile regardless of the showMonths setting */--}}
{{--            .flatpickr-months .flatpickr-month:not(:first-child) {--}}
{{--                display: none !important;--}}
{{--            }--}}

{{--            .flatpickr-current-month {--}}
{{--                left: 12.5% !important;--}}
{{--                right: 12.5% !important;--}}
{{--                width: 75% !important;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}
