<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchHandymanController extends Controller
{
    public function index(Request $request)
    {
        $subcategory = $request->query('subcategory'); // Retrieve 'subcategory' from the URL
        return view('search', compact('subcategory'));
    } // da

}
