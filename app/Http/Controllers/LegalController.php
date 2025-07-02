<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function cookiesPolicy()
    {
        return view('legal.cookies');
    }

    public function termsOfUse()
    {
        return view('legal.termsofuse');
    }

    public function privacyPolicy()
    {
        return view('legal.privacypolicy');
    }
}
