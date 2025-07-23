<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingPageController extends Controller
{
    public function index()
    {
        // Cache the categories for 1 hour since they don't change frequently
        $categories = Cache::remember('landing_page_categories', 3600, function () {
            return $this->getProcessedCategories();
        });

        return view('landingpage', compact('categories'));
    }

    private function getProcessedCategories()
    {
        // Define which categories to show and their order
        $displayCategories = [
            'Namų priežiūra ir valymas',
            'Kūrybinės Paslaugos',
            'Meistrai ir remontas',
            'Perkraustymo ir pakavimo paslaugos',
//            'Transporto paslaugos',
            'Sodininkystės ir lauko paslaugos',
            'Fitnesas ir Sveikatingumas',
//            'Renginių Pagalba',
//            'Turizmas',
//            'IT Pagalba',
//            'Ezoterija',
            'Statyba',
            'Grožio Paslaugos'
        ];

        // Fetch categories more efficiently using groupBy in database
        $categoriesData = Category::select('category', 'subcategory', 'url')
            ->whereIn('category', $displayCategories)
            ->orderByRaw("FIELD(category, '" . implode("','", $displayCategories) . "')")
            ->orderBy('subcategory')
            ->get()
            ->groupBy('category');

        // Process into the structure needed by the view
        $processedCategories = [];

        foreach ($displayCategories as $categoryName) {
            if (isset($categoriesData[$categoryName])) {
                $processedCategories[] = [
                    'name' => $categoryName,
                    'slug' => $this->getCategorySlug($categoryName),
                    'subcategories' => $categoriesData[$categoryName]->map(function ($item) {
                        return [
                            'name' => $item->subcategory,
                            'url' => $item->subcategory
                        ];
                    })->toArray()
                ];
            }
        }

        return $processedCategories;
    }

    private function getCategorySlug($categoryName)
    {
        $slugMap = [
            'Namų priežiūra ir valymas' => 'valymas',
            'Kūrybinės Paslaugos' => 'kuryba',
            'Meistrai ir remontas' => 'meistrai',
            'Perkraustymo ir pakavimo paslaugos' => 'kraustymas',
            'Transporto paslaugos' => 'transportas',
            'Sodininkystės ir lauko paslaugos' => 'sodininkyste',
            'Fitnesas ir Sveikatingumas' => 'fitnesas',
            'Renginių Pagalba' => 'organizavimas',
            'Turizmas' => 'turizmas',
            'IT Pagalba' => 'IT pagalba',
            'Ezoterija' => 'ezoterija',
            'Statyba' => 'statyba',
            'Grožio Paslaugos' => 'grozis'
        ];

        return $slugMap[$categoryName] ?? str_slug($categoryName);
    }

    public function partners()
    {
        return view('forpartners');
    }

    public function seekers()
    {
        return view('forseekers');
    }

    public function duk()
    {
        return view('duk');
    }

    public function aboutus()
    {
        return view('aboutus');
    }
}
