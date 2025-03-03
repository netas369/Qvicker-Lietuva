<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function calendar()
    {
        return view('profile.calendar');
    }

    public function work()
    {
        return view('profile.work');
    }
}
