<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchHandymanController extends Controller
{
    public function index()
    {
        return view('search');
    }
}
