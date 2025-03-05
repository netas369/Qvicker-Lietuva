<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderCalendarController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchHandymanController;
use App\Http\Controllers\SeekerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/search', [SearchHandymanController::class, 'index'])->name('search');
Route::post('/search/results', [SearchHandymanController::class, 'searchResults'])->name('search.results');


Route::get('/partners', [LandingPageController::class, 'partners'])->name('partners');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Shared route for both roles
Route::middleware(['auth', 'role:provider,seeker'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'myprofile'])->name('myprofile');
    Route::get('/provider/{id}/reserve', [SearchHandymanController::class, 'showReservation'])->name('provider.reserve');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.request');
    Route::delete('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});



// Routes for guests
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register/provider', [RegisteredUserController::class, 'createProviderStep1'])->name('register.provider'); // step 1 personal details form
    Route::get('register', [RegisteredUserController::class, 'providerOrSeeker']);

    Route::get('/register/seeker', [RegisteredUserController::class, 'createSeeker'])->name('register.seeker');
    Route::post('/register/seeker', [RegisteredUserController::class, 'storeSeeker'])->name('register.seeker.store');
});

// Routes for providers
Route::middleware(['auth', 'provider'])->group(function () {
    Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');
    Route::get('/provider/calendar', [ProviderController::class, 'calendar'])->name('provider.calendar');
    Route::get('/provider/work', [ProviderController::class, 'work'])->name('provider.work');
    // Reservation management routes
    Route::post('/reservation/{id}/accept', [ReservationController::class, 'accept'])->name('reservation.accept');
    Route::post('/reservation/{id}/decline', [ReservationController::class, 'decline'])->name('reservation.decline');
    Route::post('/reservation/{id}/complete', [ReservationController::class, 'complete'])->name('reservation.complete');
    Route::get('/provider-reservations', [ReservationController::class, 'providerReservations'])->name('reservations.provider');
    Route::get('/reservation/{id}/modify', [ReservationController::class, 'modify'])->name('reservation.modify');

});

// Routes for seekers
Route::middleware(['auth', 'seeker'])->group(function () {
    Route::get('/seeker/dashboard', [SeekerController::class, 'dashboard'])->name('seeker.dashboard');
    Route::get('/provider/{id}', function($id) {
        $provider = \App\Models\User::findOrFail($id);
        return view('provider.profile', compact('provider'));
    })->name('provider.profile');
    Route::get('/my-reservations', [ReservationController::class, 'seekerReservations'])->name('reservations.seeker');


});

