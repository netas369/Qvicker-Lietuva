<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllServicesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationSuccessController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchHandymanController;
use App\Http\Controllers\SeekerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;


Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/search', [SearchHandymanController::class, 'index'])->name('search');
Route::get('/search/results/show', [SearchHandymanController::class, 'showSearchResults'])->name('search.results.show');
Route::post('/search/results', [SearchHandymanController::class, 'searchResults'])->name('search.results');
Route::get('/cookies/policy', [LegalController::class, 'cookiesPolicy'])->name('cookies.policy');
Route::get('/termsofuse', [LegalController::class, 'termsOfUse'])->name('termsofuse');
Route::get('/privacy/policy', [LegalController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/duk', [LandingPageController::class, 'duk'])->name('duk');
Route::get('/apiemus', [LandingPageController::class, 'aboutus'])->name('aboutus');
Route::get('/partneriams', [LandingPageController::class, 'partners'])->name('partners');
Route::get('/naudotojams', [LandingPageController::class, 'seekers'])->name('seekers');
Route::get('/seeker/support', [SeekerController::class, 'support'])->name('seeker.support');
Route::post('/seeker/support/send', [SeekerController::class, 'sendSeekerSupport'])->name('seeker.support.send');
Route::get('/visos-paslaugos', [AllServicesController::class, 'allservices'])->name('allservices');


Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


Route::get('/pamirsau-slaptazodi', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

// Send password reset link
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

// Show reset password form
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

// Process password reset
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

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
    Route::get('/prisijungti', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/prisijungti', [AuthenticatedSessionController::class, 'store']);

    Route::get('/registruotis/partneriui', [RegisteredUserController::class, 'createProviderStep1'])->name('register.provider'); // step 1 personal details form
    Route::get('/registruotis', [RegisteredUserController::class, 'providerOrSeeker'])->name('register');

    Route::get('/registruotis/naudotojui', [RegisteredUserController::class, 'createSeeker'])->name('register.seeker');
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
    Route::get('/provider/support', [ProviderController::class, 'support'])->name('provider.support');
    Route::post('/provider/support', [ProviderController::class, 'sendSupport'])->name('provider.support.send');

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

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/service-pages', [AdminController::class, 'servicePages'])->name('service-pages.index');
        Route::get('/service-pages/{slug}/edit', [AdminController::class, 'editServicePage'])->name('service-pages.edit');
        Route::put('/service-pages/{slug}', [AdminController::class, 'updateServicePage'])->name('service-pages.update');
        Route::delete('/service-pages/{slug}', [AdminController::class, 'deleteServicePage'])->name('service-pages.delete');
        Route::post('/service-pages/bulk-create', [AdminController::class, 'bulkCreateSeoPages'])->name('service-pages.bulk-create');
    });
});

// CATCH ALL ROUTE
Route::get('/{service}', [AllServicesController::class, 'showService'])->name('service.show')
    ->where('service', '.*');
