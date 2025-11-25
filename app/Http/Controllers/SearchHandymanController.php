<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
        ], [
            'category.required' => 'Pasirinkite kategoriją',
            'subcategory.required' => 'Pasirinkite sub-kategoriją',
            'date.required' => 'Pasirinkite datą',
            'date.after_or_equal' => 'Data negali būti praeityje',
            'city.required' => 'Pasirinkite miestą kurioje reikia paslaugos',
        ]);

        // Get the subcategory from the original request
        $subcategoryId = $request->input('subcategory_id');
        $subcategory = $request->input('subcategory');

        // Get validated data
        $category = $validated['category'];
        $subcategory = $validated['subcategory'];
        $city = $validated['city'];
        $date = $validated['date']; // Use validated date instead of overriding

        $perPage = 10;
        $currentPage = $request->query('page', 1);

        // Redirect to results page with parameters in URL
        return redirect()->route('search.results.show', [
            'category' => $category,
            'city' => $city,
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
        $subcategoryId = $request->query('subcategory_id');
        $subcategory = $request->query('subcategory');
        $date = $request->query('date');

        // If no subcategory_id, try to find it from subcategory name
        if (!$subcategoryId && $subcategory) {
            $subcategoryRecord = Category::where('subcategory', $subcategory)->first();
            if ($subcategoryRecord) {
                $subcategoryId = $subcategoryRecord->id;
            }
        }

        // Pagination parameters
        $perPage = 5; // 5 providers per page
        $currentPage = $request->query('page', 1);

        // Parse date or use current date as default
        $specificDate = $date ? Carbon::parse($date) : now();

        // Build the base query for providers with Unicode-safe city search
        $query = User::where('role', 'provider')
            ->where(function($q) use ($city) {
                // Method 1: Direct JSON search (for non-encoded)
                $q->whereRaw('JSON_CONTAINS(cities, ?)', ['"'.$city.'"']);

                // Method 2: LIKE search (catches both encoded and non-encoded)
                $q->orWhere('cities', 'LIKE', '%'.$city.'%');

                // Method 3: Search for unicode-escaped version
                $unicodeCity = json_encode($city);
                if ($unicodeCity !== '"'.$city.'"') {
                    // Remove quotes and search for the unicode version
                    $unicodeCityClean = trim($unicodeCity, '"');
                    $q->orWhere('cities', 'LIKE', '%'.$unicodeCityClean.'%');
                }
            })
            // EAGER LOAD the categories relationship with pivot data
            ->with(['categories' => function($query) use ($subcategoryId) {
                if ($subcategoryId) {
                    $query->where('categories.id', $subcategoryId);
                }
            }]);

        // Filter by subcategory if specified
        if ($subcategoryId) {
            $query->whereHas('categories', function($q) use ($subcategoryId) {
                $q->where('categories.id', $subcategoryId);
            });
        }

        // Get all potential providers
        $allProviders = $query->get();

        // Arrays to store our results
        $exactlyAvailableProviders = [];
        $soonAvailableProviders = [];

        // Loop through each provider to check availability
        foreach ($allProviders as $provider) {
            // Prepare pricing information for this provider
            $this->preparePricingInfo($provider, $subcategoryId);

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

        // Combine both arrays for pagination
        $allResults = array_merge($exactlyAvailableProviders, $soonAvailableProviders);

        // Create pagination
        $paginatedResults = $this->paginateArray($allResults, $perPage, $currentPage, $request);

        // Separate paginated results back into exact and soon available
        $paginatedExact = [];
        $paginatedSoon = [];

        foreach ($paginatedResults as $result) {
            if ($result['is_exact_match']) {
                $paginatedExact[] = $result;
            } else {
                $paginatedSoon[] = $result;
            }
        }

        // Get total counts for display
        $totalExact = count($exactlyAvailableProviders);
        $totalSoon = count($soonAvailableProviders);

        // Return view with paginated results
        return view('search.results', [
            'exactlyAvailableProviders' => $paginatedExact,
            'soonAvailableProviders' => $paginatedSoon,
            'paginatedResults' => $paginatedResults,
            'totalExact' => $totalExact,
            'totalSoon' => $totalSoon,
            'subcategory' => $subcategory,
            'subcategoryId' => $subcategoryId,
            'city' => $city,
            'date' => $date,
            'specificDate' => $specificDate
        ]);
    }

    /**
     * Prepare pricing information for a provider
     */
    private function preparePricingInfo($provider, $subcategoryId)
    {
        $provider->pricing_info = null;

        if ($subcategoryId) {
            $pivotData = $provider->categories->where('id', $subcategoryId)->first();
            if ($pivotData && $pivotData->pivot) {
                $provider->pricing_info = [
                    'price' => $pivotData->pivot->price,
                    'type' => $pivotData->pivot->type,
                    'experience' => $pivotData->pivot->experience,
                    'formatted_price' => number_format($pivotData->pivot->price, 2),
                    'type_label_full' => $this->getPriceTypeLabel($pivotData->pivot->type, false),
                    'type_label_short' => $this->getPriceTypeLabel($pivotData->pivot->type, true)
                ];
            }
        }
    }

    /**
     * Get price type label
     */
    private function getPriceTypeLabel($type, $short = false)
    {
        if ($short) {
            switch ($type) {
                case 'hourly':
                    return '/val.';
                case 'fixed':
                    return '(fiks.)';
                case 'meter':
                    return '/m';
                default:
                    return '';
            }
        } else {
            switch ($type) {
                case 'hourly':
                    return '/ val.';
                case 'fixed':
                    return '(fiksuotas)';
                case 'meter':
                    return '/ m';
                default:
                    return '';
            }
        }
    }

    /**
     * Paginate an array of results
     */
    private function paginateArray($items, $perPage, $currentPage, $request)
    {
        $currentPage = Paginator::resolveCurrentPage() ?: $currentPage;
        $itemCollection = collect($items);

        $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedItems = new LengthAwarePaginator(
            $currentPageItems,
            $itemCollection->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'pageName' => 'page',
                'query' => $request->query(),
            ]
        );

        return $paginatedItems;
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
        $today = now()->startOfDay();

        for ($i = 1; $i <= $maxDays; $i++) {
            // Check day ahead
            $dayAhead = $targetDate->copy()->addDays($i);
            if ($this->isProviderAvailableOnDate($provider, $dayAhead)) {
                return $dayAhead;
            }

            // Check day behind - but only if it's not in the past
            $dayBehind = $targetDate->copy()->subDays($i);
            if ($dayBehind->gte($today) && $this->isProviderAvailableOnDate($provider, $dayBehind)) {
                return $dayBehind;
            }
        }

        return null;
    }

    public function showReservation(Request $request, $id)
    {
        $subcategory = $request->query('subcategory');
        $subcategoryId = null;

        // Get subcategory ID from name if provided
        if ($subcategory) {
            $subcategoryRecord = Category::where('subcategory', $subcategory)->first();
            if ($subcategoryRecord) {
                $subcategoryId = $subcategoryRecord->id;
            }
        }

        // Load provider with reviews relationship and calculate average rating
        $provider = User::with([
            'reviewsReceived' => function($query) {
                $query->with('seeker')->orderBy('created_at', 'desc');
            },
            'categories' => function($query) use ($subcategoryId) {
                if ($subcategoryId) {
                    $query->where('categories.id', $subcategoryId);
                }
            }
        ])->findOrFail($id);

        // Calculate average rating
        $approvedReviews = $provider->reviewsReceived->where('is_approved', true);
        $averageRating = $approvedReviews->count() > 0 ? $approvedReviews->avg('rating') : 0;

        // Add the average rating as an attribute to the provider
        $provider->average_rating = $averageRating;

        // Prepare pricing information
        $this->preparePricingInfo($provider, $subcategoryId);

        $date = $request->query('date', now()->format('Y-m-d'));
        $city = $request->query('city');
        $portfolioPhotos = json_decode($provider->portfolio_photos ?? '[]', true);

        return view('search.reserve.reserve', compact('provider', 'date', 'subcategory', 'city', 'portfolioPhotos'));
    }

}
