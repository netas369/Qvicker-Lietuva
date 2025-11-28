<?php

namespace App\Http\Controllers\Auth;

use App\Http\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeekerRegistrationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly RegisterUserAction $registerUserAction
    ) {}

    /**
     * Display the choice between provider or seeker registration
     */
    public function providerOrSeeker(): View
    {
        return view('auth.providerorseeker');
    }

    /**
     * Display the basic registration view (if still needed)
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Display the seeker registration page
     */
    public function createSeeker(): View
    {
        return view('auth.register-seeker');
    }

    /**
     * Display the provider registration page (multi-step wizard)
     */
    public function createProviderStep1(): View
    {
        return view('auth.register-provider');
    }

    /**
     * Handle basic registration request (if still needed)
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'seeker', // Default role
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('landingpage');
    }

    /**
     * Handle service seeker registration
     */
    public function storeSeeker(SeekerRegistrationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'seeker',
        ]);

        event(new Registered($user));
        Auth::login($user);

        return $this->redirectAfterRegistration($user);
    }

    /**
     * Handle service provider registration (legacy - if not using Livewire wizard)
     * Note: This is kept for backwards compatibility
     * The new multi-step registration is handled by the Livewire RegistrationWizard component
     */
    public function storeProvider(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'provider',
        ]);

        event(new Registered($user));
        Auth::login($user);

        return $this->redirectAfterRegistration($user);
    }

    /**
     * Determine where to redirect after successful registration
     */
    private function redirectAfterRegistration(User $user): RedirectResponse
    {
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('myprofile');
        }

        return redirect()->route('verification.notice');
    }
}
