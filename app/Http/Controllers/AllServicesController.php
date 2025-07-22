<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllServicesController extends Controller
{

    public function allservices()
    {
        // Fetch all categories and group them by category
        $categories = DB::table('categories')
            ->select('category', 'subcategory', 'url')
            ->orderBy('category')
            ->orderBy('subcategory')
            ->get()
            ->groupBy('category');

        return view('allservices', compact('categories'));
    }
}
