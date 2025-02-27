<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchHandymanController extends Controller
{
    public function index(Request $request)
    {
        $subcategory = $request->query('subcategory');
        $subcategoryId = $request->query('subcategory_id');

        return view('search', compact('subcategory', 'subcategoryId'));
    }

    public function searchResults(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'city' => 'required|string',
            'task_size' => 'required|string|in:small,medium,big',
        ]);

        // Get the subcategory from the original request, not from validation
        // as it might not be passed in the form but received from the query string
        $subcategoryId = $request->query('subcategory_id') ?? $request->input('subcategory_id');
        $subcategory = $request->query('subcategory') ?? $request->input('subcategory');

        $city = $validated['city'];
        $taskSize = $validated['task_size'];

        // Default to current date if not specified
        $date = $request->input('date', now()->format('Y-m-d'));
        $specificDate = Carbon::parse($date);
        $dayOfWeek = $specificDate->dayOfWeek;

        // Build the base query for providers
        $query = User::where('role', 'provider')
            ->where('city', $city);

        // Filter by subcategory if specified
        if ($subcategoryId) {
            $query->whereHas('subcategories', function($q) use ($subcategoryId) {
                $q->where('subcategory_id', $subcategoryId);
            });
        } elseif ($subcategory) {
            // Try to find subcategory ID from name
            $subcategoryRecord = Category::where('subcategory', $subcategory)->first();
            if ($subcategoryRecord) {
                $query->whereHas('subcategories', function($q) use ($subcategoryRecord) {
                    $q->where('subcategory_id', $subcategoryRecord->id);
                });
            }
        }

        // Find providers who don't have specific unavailability for this date
        $availableProviders = $query->get()->filter(function($provider) use ($specificDate, $dayOfWeek) {
            // Check if provider has a specific unavailability for this date
            $hasUnavailability = $provider->unavailabilities()
                ->whereDate('date', $specificDate)
                ->exists();

            if ($hasUnavailability) {
                return false; // Provider is unavailable
            }

            // Check if provider has a recurring unavailability for this day of week
            $hasRecurringUnavailability = $provider->recurringUnavailabilities()
                ->where('day_of_week', $dayOfWeek)
                ->exists();

            if ($hasRecurringUnavailability) {
                // Check if there's an exception for this specific date
                $hasException = $provider->availabilityExceptions()
                    ->whereDate('date', $specificDate)
                    ->exists();

                if (!$hasException) {
                    return false; // Provider is unavailable on this recurring day
                }
            }

            return true; // Provider is available
        });

        return view('search.results', compact('availableProviders', 'subcategory', 'city', 'taskSize', 'date'));
    }

}
