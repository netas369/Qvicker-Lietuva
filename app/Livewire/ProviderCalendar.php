<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Unavailability;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ProviderCalendar extends Component
{
    public $month;
    public $year;
    public $providerId;
    public $unavailableDates = [];
    public $calendar = [];

    public function mount($providerId = null)
    {
        // Set default month and year to current date
        $today = Carbon::today();
        $this->month = $today->month;
        $this->year = $today->year;

        // Set provider ID (you would get this from your authentication or session)
        $this->providerId = $providerId ?? auth()->id();

        // Load unavailable dates from the database
        $this->loadUnavailableDates();

        // Generate the calendar
        $this->generateCalendar();
    }

    public function loadUnavailableDates()
    {
        // Get all unavailable dates for this provider in this month
        $dates = Unavailability::where('provider_id', $this->providerId)
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->pluck('date')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })
            ->toArray();

        $this->unavailableDates = $dates;
    }

    public function generateCalendar()
    {
        // Get the first day of the month
        $firstDay = Carbon::createFromDate($this->year, $this->month, 1);

        // Get the last day of the month
        $lastDay = $firstDay->copy()->endOfMonth();

        // Get the day of week for the first day (0 = Sunday, 6 = Saturday)
        $firstDayOfWeek = $firstDay->dayOfWeek;

        // Get today's date for comparison
        $today = Carbon::today();

        // Prepare calendar array
        $calendar = [];
        $day = 1;

        // Generate up to 6 weeks to ensure we cover the full month
        for ($week = 0; $week < 6; $week++) {
            $weekData = [];

            for ($dayOfWeek = 0; $dayOfWeek < 7; $dayOfWeek++) {
                // If we're before the first day of the month or after the last day
                if (($week === 0 && $dayOfWeek < $firstDayOfWeek) || $day > $lastDay->day) {
                    $weekData[] = null; // Empty cell
                } else {
                    // Create date for current calendar day
                    $currentDate = Carbon::createFromDate($this->year, $this->month, $day);

                    // Create date string in Y-m-d format
                    $dateString = $currentDate->format('Y-m-d');

                    // Check if this date is unavailable
                    $isUnavailable = in_array($dateString, $this->unavailableDates);

                    // Check if this date is in the past
                    $isPastDate = $currentDate->lt($today);

                    $weekData[] = [
                        'day' => $day,
                        'date' => $dateString,
                        'isToday' => $dateString === $today->format('Y-m-d'),
                        'isUnavailable' => $isUnavailable || $isPastDate,
                        'isPastDate' => $isPastDate,
                    ];

                    $day++;
                }
            }

            $calendar[] = $weekData;

            // If we've gone past the end of the month, break the loop
            if ($day > $lastDay->day) {
                break;
            }
        }

        $this->calendar = $calendar;
    }

    public function toggleDate($date)
    {
        // Check if the date is in the past
        if (Carbon::parse($date)->lt(Carbon::today())) {
            // Don't allow changes to past dates
            return;
        }

        // Toggle the date's availability status
        if (in_array($date, $this->unavailableDates)) {
            // If date is currently unavailable, make it available
            $key = array_search($date, $this->unavailableDates);
            unset($this->unavailableDates[$key]);

            // Delete from database
            Unavailability::where('provider_id', $this->providerId)
                ->where('date', $date)
                ->delete();
        } else {
            // If date is currently available, make it unavailable
            $this->unavailableDates[] = $date;

            // Add to database
            Unavailability::create([
                'provider_id' => $this->providerId,
                'date' => $date,
            ]);
        }

        // Regenerate calendar to reflect changes
        $this->generateCalendar();
    }

    public function prevMonth()
    {
        // Go to previous month
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->month = $date->month;
        $this->year = $date->year;

        // Reload data for new month
        $this->loadUnavailableDates();
        $this->generateCalendar();
    }

    public function nextMonth()
    {
        // Go to next month
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->month = $date->month;
        $this->year = $date->year;

        // Reload data for new month
        $this->loadUnavailableDates();
        $this->generateCalendar();
    }

    public function render()
    {
        // Create date for current month
        $currentDate = Carbon::createFromDate($this->year, $this->month, 1);

        // Lithuanian month names
        $lithuanianMonths = [
            1 => 'Sausis',
            2 => 'Vasaris',
            3 => 'Kovas',
            4 => 'Balandis',
            5 => 'Gegužė',
            6 => 'Birželis',
            7 => 'Liepa',
            8 => 'Rugpjūtis',
            9 => 'Rugsėjis',
            10 => 'Spalis',
            11 => 'Lapkritis',
            12 => 'Gruodis',
        ];

        // Get Lithuanian month name and year
        $lithuanianMonth = $lithuanianMonths[$this->month];
        $currentMonth = $lithuanianMonth . ' ' . $this->year;

        return view('livewire.provider-calendar', [
            'currentMonth' => $currentMonth,
        ]);
    }
}
