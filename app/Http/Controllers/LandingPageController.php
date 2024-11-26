<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $categories = include app_path('data/categories.php');

        return view('landingpage', compact('categories'));
    }
}
