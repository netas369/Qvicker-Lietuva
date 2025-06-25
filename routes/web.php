<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationSuccessController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchHandymanController;
use App\Http\Controllers\SeekerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/search', [SearchHandymanController::class, 'index'])->name('search');
Route::get('/search/results/show', [SearchHandymanController::class, 'showSearchResults'])->name('search.results.show');
Route::post('/search/results', [SearchHandymanController::class, 'searchResults'])->name('search.results');



Route::get('/partners', [LandingPageController::class, 'partners'])->name('partners');
Route::get('/seekers', [LandingPageController::class, 'seekers'])->name('seekers');

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

// EMAIL VERIFICATION ROUTES HERE:
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('/email/verified', EmailVerificationSuccessController::class)->name('verification.success');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});

// Shared route for both roles
Route::middleware(['auth', 'verified', 'role:provider,seeker'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'myprofile'])->name('myprofile');
    Route::delete('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('profile.dashboard');
});



// Routes for guests
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register/provider', [RegisteredUserController::class, 'createProviderStep1'])->name('register.provider'); // step 1 personal details form
    Route::get('/register', [RegisteredUserController::class, 'providerOrSeeker']);

    Route::get('/register/seeker', [RegisteredUserController::class, 'createSeeker'])->name('register.seeker');
    Route::post('/register/seeker', [RegisteredUserController::class, 'storeSeeker'])->name('register.seeker.store');
});

// Routes for providers
Route::middleware(['auth', 'verified', 'provider'])->group(function () {
    Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');
    Route::get('/provider/calendar', [ProviderController::class, 'calendar'])->name('provider.calendar');
    Route::get('/provider/work', [ProviderController::class, 'work'])->name('provider.work');
    // Reservation management routes
    Route::post('/reservation/{id}/accept', [ReservationController::class, 'accept'])->name('reservation.accept');
    Route::post('/reservation/{id}/complete', [ReservationController::class, 'complete'])->name('reservation.complete');
    Route::get('/provider-reservations', [ReservationController::class, 'providerReservations'])->name('reservations.provider');
    Route::get('/reservation/{id}/modify', [ReservationController::class, 'modifyProvider'])->name('reservation.modify');
    Route::post('/reservation/{id}/decline', [ReservationController::class, 'declineProvider'])->name('reservation.declineProvider');
    Route::put('/reservations/{id}/edit-seeker', [ReservationController::class, 'editProvider'])->name('reservations.editProvider');

});

// Routes for seekers
Route::middleware(['auth', 'verified', 'seeker'])->group(function () {
    Route::get('/seeker/dashboard', [SeekerController::class, 'dashboard'])->name('seeker.dashboard');
    Route::get('/provider/{id}/reserve', [SearchHandymanController::class, 'showReservation'])->name('provider.reserve');
    Route::get('/my-reservations', [ReservationController::class, 'seekerReservations'])->name('reservations.seeker');
    Route::get('/my-reservations/{id}', [ReservationController::class, 'modifySeeker'])->name('reservation.modifySeeker');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.request');
    Route::post('/reservation/{id}/cancel', [ReservationController::class, 'declineSeeker'])->name('reservation.declineSeeker');

});

