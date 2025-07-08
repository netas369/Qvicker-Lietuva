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

        $categoriesData = Category::select('category', 'subcategory')->get();

        $categories = $categoriesData->pluck('category')->unique()->values();

        // Group subcategories by category for JavaScript
        $subcategoriesData = $categoriesData->groupBy('category')->map(function ($items) {
            return $items->pluck('subcategory')->unique()->values();
        });

        // Handle URL parameter for subcategory
        $selectedSubcategory = $request->get('subcategory');
        $selectedCategory = null;
        $subcategories = collect();

        if ($selectedSubcategory) {
            // Find the category for the given subcategory
            $categoryRecord = Category::where('subcategory', $selectedSubcategory)->first();

            if ($categoryRecord) {
                $selectedCategory = $categoryRecord->category;

                // Get all subcategories for this category
                $subcategories = Category::where('category', $selectedCategory)
                    ->pluck('subcategory')
                    ->unique()
                    ->values();
            }
        }


        return view('search', compact(
            'categories',
            'subcategoriesData',
            'selectedCategory',
            'selectedSubcategory',
            'subcategories'
        ));
    }


    public function searchResults(Request $request)
    {

        $validated = $request->validate([
            'category' => 'required|string|exists:categories,category',
            'subcategory' => 'required|string|exists:categories,subcategory',
            'date' => 'required|after_or_equal:today',
            'city' => 'required',
            'task_size' => 'required'
        ], [
            'category.required' => 'Pasirinkite kategoriją',
            'subcategory.required' => 'Pasirinkite sub-kategoriją',
            'date.required' => 'Pasirinkite datą',
            'date.after_or_equal' => 'Data negali būti praeityje',
            'city.required' => 'Pasirinkite miestą kurioje reikia paslaugos',
            'task_size.required' => 'Pasirinkite užduoties dydį'
        ]);

        // Get the subcategory from the original request
        $subcategoryId = $request->input('subcategory_id');
        $subcategory = $request->input('subcategory');

        // Get validated data
        $category = $validated['category'];
        $subcategory = $validated['subcategory'];
        $city = $validated['city'];
        $taskSize = $validated['task_size'];
        $date = $validated['date']; // Use validated date instead of overriding

        // Redirect to results page with parameters in URL
        return redirect()->route('search.results.show', [
            'category' => $category,
            'city' => $city,
            'task_size' => $taskSize,
            'subcategory_id' => $subcategoryId,
            'subcategory' => $subcategory,
            'date' => $date
        ]);
    }

    // API endpoint to get subcategories for a specific category (if needed for AJAX)
    public function getSubcategories($category)
    {
        $subcategories = Category::where('category', $category)
            ->pluck('subcategory')
            ->unique()
            ->values();

        return response()->json($subcategories);
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

        // Build the base query for providers with Unicode-safe city search
        $query = User::where('role', 'provider')
            ->where(function($q) use ($city) {
                // Method 1: Direct JSON search (for non-encoded)
                $q->whereRaw('JSON_CONTAINS(cities, ?)', ['"'.$city.'"']);

                // Method 2: LIKE search (catches both encoded and non-encoded)
                $q->orWhere('cities', 'LIKE', '%'.addslashes($city).'%');

                // Method 3: Search for unicode-escaped version
                $unicodeCity = json_encode($city);
                if ($unicodeCity !== '"'.$city.'"') {
                    // Remove quotes and search for the unicode version
                    $unicodeCityClean = trim($unicodeCity, '"');
                    $q->orWhere('cities', 'LIKE', '%'.$unicodeCityClean.'%');
                }
            });

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

        // Get all potential providers
        $allProviders = $query->get();

        // Arrays to store our results
        $exactlyAvailableProviders = [];
        $soonAvailableProviders = [];

        // Loop through each provider to check availability
        foreach ($allProviders as $provider) {
            // Check if provider is available on the specific date
            if ($this->isProviderAvailableOnDate($provider, $specificDate)) {
                // Add to exactly available providers
                $exactlyAvailableProviders[] = [
                    'provider' => $provider,
                    'available_date' => $specificDate,
                    'is_exact_match' => true
                ];
            } else {
                // Find the closest available date within +/- 4 days
                $closestDate = $this->findClosestAvailableDate($provider, $specificDate, 4);

                if ($closestDate) {
                    // Add to soon available providers
                    $soonAvailableProviders[] = [
                        'provider' => $provider,
                        'available_date' => $closestDate,
                        'is_exact_match' => false,
                        'days_difference' => $specificDate->diffInDays($closestDate, false)
                    ];
                }
            }
        }

        // Sort soon available providers by how close their available date is to the requested date
        usort($soonAvailableProviders, function($a, $b) {
            return abs($a['days_difference']) - abs($b['days_difference']);
        });

        // Return view with all parameters
        return view('search.results', [
            'exactlyAvailableProviders' => $exactlyAvailableProviders,
            'soonAvailableProviders' => $soonAvailableProviders,
            'subcategory' => $subcategory,
            'city' => $city,
            'taskSize' => $taskSize,
            'date' => $date,
            'specificDate' => $specificDate
        ]);
    }

    /**
     * Check if a provider is available on a specific date
     */
    private function isProviderAvailableOnDate($provider, $date)
    {
        $dayOfWeek = $date->dayOfWeek;

        // Check if provider has a specific unavailability for this date
        $hasUnavailability = $provider->unavailabilities()
            ->whereDate('date', $date)
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
                ->whereDate('date', $date)
                ->exists();

            if (!$hasException) {
                return false; // Provider is unavailable on this recurring day
            }
        }

        return true; // Provider is available
    }

    /**
     * Find the closest available date for a provider within a given range of days
     */
    private function findClosestAvailableDate($provider, $targetDate, $maxDays)
    {
        // Check days forward and backward from the target date, prioritizing closer dates
        for ($i = 1; $i <= $maxDays; $i++) {
            // Check day ahead
            $dayAhead = $targetDate->copy()->addDays($i);
            if ($this->isProviderAvailableOnDate($provider, $dayAhead)) {
                return $dayAhead;
            }

            // Check day behind
            $dayBehind = $targetDate->copy()->subDays($i);
            if ($this->isProviderAvailableOnDate($provider, $dayBehind)) {
                return $dayBehind;
            }
        }

        return null; // No available date found within range
    }

    public function showReservation(Request $request, $id)
    {
        // Load provider with reviews relationship and calculate average rating
        $provider = User::with([
            'reviewsReceived' => function($query) {
                $query->with('seeker')->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);

        // Calculate average rating
        $approvedReviews = $provider->reviewsReceived->where('is_approved', true);
        $averageRating = $approvedReviews->count() > 0 ? $approvedReviews->avg('rating') : 0;

        // Add the average rating as an attribute to the provider
        $provider->average_rating = $averageRating;

        $date = $request->query('date', now()->format('Y-m-d'));
        $taskSize = $request->query('task_size');
        $subcategory = $request->query('subcategory');
        $city = $request->query('city');
        $portfolioPhotos = json_decode($provider->portfolio_photos ?? '[]', true);

        return view('search.reserve.reserve', compact('provider', 'date', 'taskSize', 'subcategory', 'city', 'portfolioPhotos'));
    }
}
