<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationSuccessController extends Controller
{
    /**
     * Show the email verification success page.
     */
    public function __invoke(Request $request): View
    {
        // Make sure user is authenticated and verified
        if (!$request->user() || !$request->user()->hasVerifiedEmail()) {
            return redirect()->route('landingpage');
        }

        return view('auth.email-verified', [
            'user' => $request->user()
        ]);
    }
}
