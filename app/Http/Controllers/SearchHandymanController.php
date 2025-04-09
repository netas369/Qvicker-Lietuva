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

        // Get the subcategory from the original request
        $subcategoryId = $request->input('subcategory_id');
        $subcategory = $request->input('subcategory');

        // Get validated data
        $city = $validated['city'];
        $taskSize = $validated['task_size'];
        $date = $request->input('date', now()->format('Y-m-d'));

        // Redirect to results page with parameters in URL
        return redirect()->route('search.results.show', [
            'city' => $city,
            'task_size' => $taskSize,
            'subcategory_id' => $subcategoryId,
            'subcategory' => $subcategory,
            'date' => $date
        ]);
    }

    public function showSearchResults(Request $request)
    {
        // Get parameters from URL
        $city = $request->query('city');
        $taskSize = $request->query('task_size');
        $subcategoryId = $request->query('subcategory_id');
        $subcategory = $request->query('subcategory');
        $date = $request->query('date');
        

        // Parse date or use current date as default
        $specificDate = $date ? Carbon::parse($date) : now();
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

        // Return view with all parameters
        return view('search.results', compact('availableProviders', 'subcategory', 'city', 'taskSize', 'date'));
    }

    public function showReservation(Request $request, $id)
    {
        $provider = User::findOrFail($id);

        $date = $request->query('date', now()->format('Y-m-d'));
        $taskSize = $request->query('task_size');
        $subcategory = $request->query('subcategory');
        $city = $request->query('city');

        return view('search.reserve.reserve', compact('provider', 'date', 'taskSize', 'subcategory', 'city'));
    }

}
