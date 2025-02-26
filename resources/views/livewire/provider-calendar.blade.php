{{-- resources/views/livewire/provider-calendar.blade.php --}}
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
                            @if($day)
                                wire:click="toggleDate('{{ $day['date'] }}')"
                            class="h-16 md:h-24 p-1 {{ $day['isToday'] ? 'bg-blue-50' : '' }} {{ $day['isUnavailable'] ? 'bg-red-50' : '' }} hover:bg-gray-100 cursor-pointer transition"
                            @else
                                class="h-16 md:h-24 p-1 bg-gray-50"
                            @endif
                        >
                            @if($day)
                                <div class="flex flex-col h-full">
                                    <!-- Day Number -->
                                    <div class="text-sm font-medium {{ $day['isToday'] ? 'text-blue-600' : 'text-gray-700' }}">
                                        {{ $day['day'] }}
                                    </div>

                                    <!-- Unavailable Indicator -->
                                    @if($day['isUnavailable'])
                                        <div class="mt-1 flex-grow flex items-center justify-center">
                                            <!-- Text for larger screens -->
                                            <span class="hidden md:inline-block bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded">
                                                Nepasiekiamas
                                            </span>

                                            <!-- Circle indicator for mobile screens -->
                                            <span class="md:hidden w-4 h-4 bg-red-500 rounded-full"></span>
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
        <div class="bg-gray-50 p-4 flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4 text-sm text-gray-600">
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-blue-100 rounded-full mr-1"></span>
                <span>Šiandien</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 bg-red-500 md:bg-red-100 rounded-full mr-1"></span>
                <span>Nepasiekiamas</span>
            </div>
            <div class="hidden md:block">
                <p>Spustelėkite dieną, kad pažymėtumėte ją kaip nepasiekiamą/pasiekiamą</p>
            </div>
        </div>
    </div>
</div>
