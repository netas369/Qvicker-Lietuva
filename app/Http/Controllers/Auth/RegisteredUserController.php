<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function createSeeker()
    {
        return view('auth.register-seeker');
    }

    // Handle Service Seeker Registration
    public function storeSeeker(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name' => 'required|string|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->full_name,
            'role' => 'seeker', // Set the role to 'seeker'
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    // Show Service Provider Registration Form


    // Handle Service Provider Registration
    public function storeProvider(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
//            'skills' => 'required|string|max:255', // Example additional field
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'provider',
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function createProviderStep1()
    {
        return view('auth.register-provider');
    }

    public function processStep1(Request $request)
    {
        // Validate Step 1 Data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'email' => 'required|email|max:255',
            'miestas' => 'required|string|max:255',
            'adresas' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Store step 1 data in the session
        $request->session()->put('registration_step1', $validatedData);

        // Redirect to step 2
        return redirect()->route('register.provider.step2');
    }

    public function createProviderStep2()
    {
        return view('auth.register-provider-step2'); // Create a separate view for step 2
    }

    public function processStep2(Request $request)
    {
        return redirect()->route('register.provider.step3');
    }

    public function createProviderStep3(Request $request)
    {
        return view('auth.register-provider-step3');
    }

    public function processStep3(Request $request)
    {
        dd('success');
    }

}
