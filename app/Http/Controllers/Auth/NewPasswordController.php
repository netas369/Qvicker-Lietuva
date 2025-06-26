<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        // Check if token and email are valid first
        $token = $request->route('token');
        $email = $request->query('email');

        if (!$token || !$email) {
            abort(404, 'Invalid password reset link.');
        }

        // DON'T logout user here - only show the form
        // Let them decide if they want to proceed with reset

        return view('auth.reset-password', [
            'request' => $request,
            'token' => $token,
            'email' => $email
        ]);
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ], [
            'email.required' => 'El. pašto adresas yra privalomas.',
            'email.email' => 'Įveskite galiojantį el. pašto adresą.',
            'password.required' => 'Slaptažodis yra privalomas.',
            'password.confirmed' => 'Slaptažodžių patvirtinimas nesutampa.',
            'password.min' => 'Slaptažodis turi būti bent :min simbolių ilgio.',
            'password.letters' => 'Slaptažodis turi turėti bent vieną raidę.',
            'password.mixed_case' => 'Slaptažodis turi turėti didžiųjų ir mažųjų raidžių.',
            'password.numbers' => 'Slaptažodis turi turėti bent vieną skaičių.',
            'password.symbols' => 'Slaptažodis turi turėti bent vieną specialų simbolį.',
            'password.uncompromised' => 'Šis slaptažodis yra nesaugus. Pasirinkite kitą slaptažodį.',
        ]);

        // Reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            // ONLY logout AFTER successful password reset
            if (Auth::check()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return redirect()->route('login')->with('status', 'Jūsų slaptažodis sėkmingai pakeistas! Prisijunkite su nauju slaptažodžiu.');
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'Neteisingas el. pašto adresas arba netinkama nuoroda.']);
    }
}
