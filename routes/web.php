<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SearchHandymanController;
use App\Http\Controllers\SeekerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/search', [SearchHandymanController::class, 'index'])->name('search');
Route::get('/partners', [LandingPageController::class, 'partners'])->name('partners');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Shared route for both roles
Route::middleware(['auth', 'role:provider,seeker'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'myprofile'])->name('myprofile');
});

Route::get('register', [RegisteredUserController::class, 'providerOrSeeker']);

// Service Seeker Registration
Route::get('/register/seeker', [RegisteredUserController::class, 'createSeeker'])->name('register.seeker');
Route::post('/register/seeker', [RegisteredUserController::class, 'storeSeeker'])->name('register.seeker.store');



// Service Provider Registration
Route::get('/register/provider', [RegisteredUserController::class, 'createProviderStep1'])->name('register.provider'); // step 1 personal details form
Route::post('/register/provider/step1', [RegisteredUserController::class, 'processStep1'])->name('register.provider.processStep1'); // Process Step 1


Route::get('/register/provider/step2', [RegisteredUserController::class, 'createProviderStep2'])->name('register.provider.step2'); // Step 2 (Skills Form)
Route::post('/register/provider/step2', [RegisteredUserController::class, 'processStep2'])->name('register.provider.processStep2'); // Process Step 2

Route::post('/register/provider/step3', [RegisteredUserController::class, 'createProviderStep3'])->name('register.provider.step3');
Route::get('/register/provider/step3', [RegisteredUserController::class, 'processStep3'])->name('register.provider.processStep3');


// Login routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Routes for providers
Route::middleware(['auth', 'provider'])->group(function () {
    Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');
});

// Routes for seekers
Route::middleware(['auth', 'seeker'])->group(function () {
    Route::get('/seeker/dashboard', [SeekerController::class, 'dashboard'])->name('seeker.dashboard');

    // ... other seeker routes
});
