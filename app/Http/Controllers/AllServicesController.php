<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllServicesController extends Controller
{
    public function allservices()
    {
        $categories = DB::table('categories')
            ->select('category', 'subcategory', 'url')
            ->orderBy('category')
            ->orderBy('subcategory')
            ->get()
            ->groupBy('category');

        return view('allservices', compact('categories'));
    }

    public function showService($service)
    {
        // Check if this service exists in categories
        $serviceData = DB::table('categories')
            ->where('url', $service)
            ->first();


        if (!$serviceData) {
            abort(404);
        }

        // Get SEO data if you have the service_pages table
        $seoData = DB::table('service_pages')
            ->where('slug', $service)
            ->first();

        // Get related services from same category
        $relatedServices = DB::table('categories')
            ->where('category', $serviceData->category)
            ->where('url', '!=', $service)
            ->limit(6)
            ->get();

        return view('service-page', compact('serviceData', 'seoData', 'relatedServices'));
    }
}
