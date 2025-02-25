<?php

namespace App\Http\Controllers;

use App\Models\ProviderAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProviderCalendarController extends Controller
{
    public function index()
    {
        // Get the current user's unavailable dates to display in the calendar
        $unavailableDates = auth()->user()->availabilities()
            ->where('status', 'unavailable')
            ->pluck('date')
            ->map(function($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })
            ->toArray();


        return view('profile.calendar', [
            'unavailableDates' => json_encode($unavailableDates)
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'unavailable_dates' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Begin transaction to ensure data consistency
        DB::beginTransaction();

        try {
            $userId = auth()->id();
            $dates = [];

            // Handle unavailable dates (multiple individual dates)
            if (!empty($validated['unavailable_dates'])) {
                $unavailableDates = json_decode($validated['unavailable_dates'], true);

                if (is_array($unavailableDates) && count($unavailableDates) > 0) {
                    foreach ($unavailableDates as $date) {
                        $dates[] = [
                            'user_id' => $userId,
                            'date' => $date,
                            'status' => 'unavailable',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }

            // Handle date range (start_date to end_date)
            if (!empty($validated['start_date']) && !empty($validated['end_date'])) {
                $startDate = Carbon::parse($validated['start_date']);
                $endDate = Carbon::parse($validated['end_date']);

                // Generate all dates in the range
                $currentDate = $startDate->copy();
                while ($currentDate->lte($endDate)) {
                    $dates[] = [
                        'user_id' => $userId,
                        'date' => $currentDate->format('Y-m-d'),
                        'status' => 'unavailable',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $currentDate->addDay();
                }
            }

            if (count($dates) > 0) {
                // First, delete any existing records for these dates
                $allDates = array_column($dates, 'date');
                ProviderAvailability::where('user_id', $userId)
                    ->whereIn('date', $allDates)
                    ->delete();

                // Then insert the new records
                ProviderAvailability::insert($dates);
            }

            DB::commit();

            return redirect()->route('provider.calendar')
                ->with('success', 'Jūsų kalendorius sėkmingai atnaujintas!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('provider.calendar')
                ->with('error', 'Įvyko klaida. Prašome bandyti dar kartą.');
        }
    }

    public function getUnavailableDates()
    {
        // API endpoint to get unavailable dates for AJAX requests
        $unavailableDates = auth()->user()->availabilities()
            ->where('status', 'unavailable')
            ->pluck('date')
            ->map(function($date) {
                return Carbon::parse($date)->format('Y-m-d');
            });

        return response()->json([
            'unavailable_dates' => $unavailableDates
        ]);
    }
}
