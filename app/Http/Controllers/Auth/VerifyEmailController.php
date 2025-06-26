<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // Get user by ID from the URL parameter
        $user = User::findOrFail($request->route('id'));

        // Verify the hash matches the user's email
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        // Check if the signed URL is valid
        if (!$request->hasValidSignature()) {
            abort(403, 'Invalid or expired verification link.');
        }

        // Check if already verified
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('verification.success')
                ->with('message', 'Email already verified.');
        }

        // Mark as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('verification.success')
            ->with('message', 'Email verified successfully!');
    }
}
