<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Fetch categories and subcategories using Eloquent
        $categoriesData = Category::select('category as name', 'subcategory')
            ->orderBy('category')
            ->orderBy('subcategory')
            ->get();

        // Process data into the needed structure
        $categories = [];
        foreach ($categoriesData as $item) {
            if (!isset($categories[$item->name])) {
                $categories[$item->name] = [
                    'name' => $item->name,
                    'subcategories' => []
                ];
            }

            $categories[$item->name]['subcategories'][] = [
                'name' => $item->subcategory
            ];
        }

        // Convert to indexed array for blade template
        $categories = array_values($categories);

        return view('landingpage', compact('categories'));
    }

    public function partners()
    {
        return view('forpartners');
    }
}
