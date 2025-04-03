<div class="w-full max-w-4xl mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Calendar Header -->
        <div class="bg-gray-100 p-4 flex items-center justify-between">
            <button wire:click="prevMonth" class="p-2 rounded hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <h2 class="text-xl font-bold text-gray-800">{{ $currentMonth }}</h2>

            <button wire:click="nextMonth" class="p-2 rounded hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Calendar Controls -->
        <div class="bg-gray-50 p-2 flex justify-end">
            <button
                wire:click="openRecurringModal"
                class="px-3 py-1 bg-primary-light text-white rounded text-sm hover:bg-primary transition"
            >
                Savaitės dienų nustatymai
            </button>
        </div>

        <!-- Day Headers -->
        <div class="grid grid-cols-7 bg-gray-50">
            @foreach(['Sek', 'Pir', 'Ant', 'Tre', 'Ket', 'Pen', 'Šeš'] as $dayName)
                <div class="py-2 text-center text-sm font-medium text-gray-500">
                    <!-- Full day name on larger screens -->
                    <span class="hidden md:inline">{{ $dayName }}</span>
                    <!-- First letter only on mobile -->
                    <span class="md:hidden">{{ substr($dayName, 0, 1) }}</span>
                </div>
            @endforeach
        </div>

        <!-- Calendar Grid -->
        <div class="divide-y">
            @foreach($calendar as $week)
                <div class="grid grid-cols-7 divide-x">
                    @foreach($week as $day)
                        <div
                            @if($day && !$day['isPastDate'])
                                wire:click="toggleDate('{{ $day['date'] }}')"
                            class="h-16 md:h-24 p-1 relative {{ $day['isToday'] ? 'bg-blue-50' : '' }} {{ $day['isUnavailable'] ? 'bg-red-50' : '' }} {{ $day['isRecurringUnavailable'] && !$day['isPastDate'] ? 'bg-red-100' : '' }} {{ $day['isException'] ? 'bg-green-50' : '' }} hover:bg-gray-100 cursor-pointer transition"
                            @else
                                class="h-16 md:h-24 p-1 relative {{ $day && $day['isPastDate'] ? 'bg-gray-200' : 'bg-gray-50' }} {{ $day && $day['isToday'] ? 'bg-blue-50' : '' }}"
                            @endif
                        >
                            @if($day)
                                <div class="flex flex-col h-full">
                                    <!-- Day Number -->
                                    <div class="text-sm font-medium {{ $day['isToday'] ? 'text-blue-600' : 'text-gray-700' }}">
                                        {{ $day['day'] }}

                                        <!-- Reservation count badge -->
                                        @if($day['reservationCount'] > 0)
                                            <span class="ml-1 inline-flex items-center justify-center w-5 h-5 text-xs font-bold bg-yellow-500 text-white rounded-full">
                                                {{ $day['reservationCount'] }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Reservations indicator (only visible on non-mobile) -->
                                    @if($day['hasReservations'] && !$day['isPastDate'])
                                        <div class="hidden md:flex mt-1 flex-wrap gap-1">
                                            @foreach($day['reservations'] as $index => $reservation)
                                                @if($index < 2 || count($day['reservations']) <= 3)
                                                    <div class="px-1 py-0.5 bg-yellow-100 text-yellow-800 text-xs rounded truncate max-w-full" title="{{ $reservation->description }}">
                                                        {{ \Illuminate\Support\Str::limit($reservation->subcategory, 10) }}
                                                    </div>
                                                @elseif($index == 2)
                                                    <div class="px-1 py-0.5 bg-yellow-100 text-yellow-800 text-xs rounded">
                                                        +{{ count($day['reservations']) - 2 }}
                                                    </div>
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Unavailable Indicator - text for future unavailable dates only -->
                                    @if($day['isUnavailable'] && !$day['isPastDate'] && !$day['hasReservations'])
                                        <div class="mt-1 flex-grow flex items-center justify-center">
                                            <!-- Text for larger screens -->
                                            <span class="hidden md:inline-block bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded">
                                                Nepasiekiamas
                                            </span>

                                            <!-- Circle indicator for mobile screens -->
                                            <span class="md:hidden w-4 h-4 bg-red-500 rounded-full"></span>
                                        </div>
                                    @endif

                                    <!-- Recurring Unavailable Indicator -->
                                    @if($day['isRecurringUnavailable'] && !$day['isPastDate'] && !$day['hasReservations'])
                                        <div class="mt-1 flex-grow flex items-center justify-center">
                                            <span class="hidden md:inline-block bg-orange-100 text-orange-800 text-xs font-medium px-1 py-0.5 rounded-full">
                                                Kartojasi
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Exception Indicator -->
                                    @if($day['isException'] && !$day['hasReservations'])
                                        <div class="mt-1 flex-grow flex items-center justify-center">
                                            <span class="hidden md:inline-block bg-green-100 text-green-800 text-xs font-medium px-1 py-0.5 rounded-full">
                                                Išimtis
                                            </span>
                                            <!-- Circle indicator for mobile screens -->
                                            <span class="md:hidden w-4 h-4 bg-green-500 rounded-full"></span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Legend -->
        <div class="bg-gray-50 p-4 flex flex-wrap items-center gap-3 text-sm text-gray-600">
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-blue-100 rounded-full mr-1"></span>
                <span>Šiandien</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-1"></span>
                <span>Nepasiekiamas</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-orange-100 rounded-full mr-1"></span>
                <span>Kartojasi</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-1"></span>
                <span>Išimtis</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-1"></span>
                <span>Užsakymai</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-gray-200 rounded-full mr-1"></span>
                <span>Praeities dienos</span>
            </div>
            <div class="hidden md:block">
                <p>Spustelėkite dieną, kad pažymėtumėte ją kaip nepasiekiamą/pasiekiamą</p>
            </div>
        </div>
    </div>

    <!-- Recurring Unavailability Modal -->
    @if($showRecurringModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Savaitės dienų nustatymai</h3>
                    <button wire:click="closeRecurringModal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <p class="mb-4 text-gray-600">Pažymėkite dienas, kuriomis jūs visada esate nepasiekiamas</p>

                <div class="space-y-3">
                    @foreach([
                        0 => 'Sekmadienis',
                        1 => 'Pirmadienis',
                        2 => 'Antradienis',
                        3 => 'Trečiadienis',
                        4 => 'Ketvirtadienis',
                        5 => 'Penktadienis',
                        6 => 'Šeštadienis'
                    ] as $dayValue => $dayName)
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="day-{{ $dayValue }}"
                                wire:click="toggleRecurringDay({{ $dayValue }})"
                                @if(in_array($dayValue, $recurringUnavailableDays)) checked @endif
                                class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-600"
                            >
                            <label for="day-{{ $dayValue }}" class="ml-2 text-gray-700">{{ $dayName }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        wire:click="closeRecurringModal"
                        class="px-4 py-2 bg-primary-light text-white rounded hover:bg-primary transition"
                    >
                        Uždaryti
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
