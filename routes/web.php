<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllServicesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationSuccessController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing & Marketing Pages
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/apiemus', [LandingPageController::class, 'aboutus'])->name('aboutus');
Route::get('/partneriams', [LandingPageController::class, 'partners'])->name('partners');
Route::get('/naudotojams', [LandingPageController::class, 'seekers'])->name('seekers');
Route::get('/duk', [LandingPageController::class, 'duk'])->name('duk');

// Legal Pages
Route::prefix('legal')->name('legal.')->group(function () {
    Route::get('/cookies-policy', [LegalController::class, 'cookiesPolicy'])->name('cookies');
    Route::get('/terms-of-use', [LegalController::class, 'termsOfUse'])->name('terms');
    Route::get('/privacy-policy', [LegalController::class, 'privacyPolicy'])->name('privacy');
});

// Backward compatibility for old URLs
Route::get('/cookies/policy', fn() => redirect()->route('legal.cookies'));
Route::get('/termsofuse', fn() => redirect()->route('legal.terms'));
Route::get('/privacy/policy', fn() => redirect()->route('legal.privacy'));

// Search & Services
Route::controller(SearchHandymanController::class)->group(function () {
    Route::get('/search', 'index')->name('search');
    Route::get('/search/results/show', 'showSearchResults')->name('search.results.show');
    Route::post('/search/results', 'searchResults')->name('search.results');
});

Route::get('/visos-paslaugos', [AllServicesController::class, 'allservices'])->name('allservices');

// Public Support
Route::get('/seeker/support', [SeekerController::class, 'support'])->name('seeker.support');
Route::post('/seeker/support/send', [SeekerController::class, 'sendSeekerSupport'])->name('seeker.support.send');

// Sitemap
Route::get('/sitemap.xml', fn() => response()->file(public_path('sitemap.xml')));

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->name('api.')->group(function () {
    Route::get('/search-categories', [SearchHandymanController::class, 'searchCategories'])
        ->name('search.categories');
});

/*
|--------------------------------------------------------------------------
| Guest Routes (Authentication)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('/prisijungti', 'create')->name('login');
        Route::post('/prisijungti', 'store')->name('login.store');
    });

    // Registration
    Route::controller(RegisteredUserController::class)->prefix('registruotis')->group(function () {
        Route::get('/', 'providerOrSeeker')->name('register');
        Route::get('/partneriui', 'createProviderStep1')->name('register.provider');
        Route::get('/naudotojui', 'createSeeker')->name('register.seeker');
        Route::post('/naudotojui', 'storeSeeker')->name('register.seeker.store');
    });

    // Password Reset
    Route::controller(PasswordResetLinkController::class)->group(function () {
        Route::get('/pamirsau-slaptazodi', 'create')->name('password.request');
        Route::post('/forgot-password', 'store')->name('password.email');
    });

    Route::controller(NewPasswordController::class)->group(function () {
        Route::get('/reset-password/{token}', 'create')->name('password.reset');
        Route::post('/reset-password', 'store')->name('password.store');
    });
});

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('/email/verified', EmailVerificationSuccessController::class)
        ->name('verification.success');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (All Users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Verified User Routes (Both Roles)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:provider,seeker'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'myprofile'])->name('myprofile');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('profile.dashboard');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    // Shared Reservation Routes
    Route::delete('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])
        ->name('reservation.cancel');
});

/*
|--------------------------------------------------------------------------
| Provider Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'provider'])->prefix('provider')->name('provider.')->group(function () {
    // Dashboard & Calendar
    Route::get('/dashboard', [ProviderController::class, 'dashboard'])->name('dashboard');
    Route::get('/calendar', [ProviderController::class, 'calendar'])->name('calendar');
    Route::get('/work', [ProviderController::class, 'work'])->name('work');

    // Support
    Route::get('/support', [ProviderController::class, 'support'])->name('support');
    Route::post('/support', [ProviderController::class, 'sendSupport'])->name('support.send');
});

// Provider Reservation Routes (outside prefix for cleaner URLs)
Route::middleware(['auth', 'verified', 'provider'])->group(function () {
    Route::get('/provider-reservations', [ReservationController::class, 'providerReservations'])
        ->name('reservations.provider');

    Route::controller(ReservationController::class)->prefix('reservation')->group(function () {
        Route::get('/{id}/modify', 'modifyProvider')->name('reservation.modify');
        Route::post('/{id}/accept', 'accept')->name('reservation.accept');
        Route::post('/{id}/complete', 'complete')->name('reservation.complete');
        Route::post('/{id}/decline', 'declineProvider')->name('reservation.declineProvider');
        Route::put('/{id}/edit-seeker', 'editProvider')->name('reservations.editProvider');
    });
});

/*
|--------------------------------------------------------------------------
| Seeker Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SeekerController::class, 'dashboard'])->name('dashboard');
});

// Seeker Reservation Routes (outside prefix for cleaner URLs)
Route::middleware(['auth', 'verified', 'seeker'])->group(function () {
    Route::get('/provider/{id}/reserve', [SearchHandymanController::class, 'showReservation'])
        ->name('provider.reserve');

    Route::controller(ReservationController::class)->group(function () {
        Route::get('/my-reservations', 'seekerReservations')->name('reservations.seeker');
        Route::get('/my-reservations/{id}', 'modifySeeker')->name('reservation.modifySeeker');
        Route::post('/reservation', 'store')->name('reservation.request');
        Route::post('/reservation/{id}/cancel', 'declineSeeker')->name('reservation.declineSeeker');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Categories
    Route::controller(AdminController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::post('/categories', 'storeCategory')->name('categories.store');
    });

    // Service Pages (SEO)
    Route::controller(AdminController::class)->prefix('service-pages')->name('service-pages.')->group(function () {
        Route::get('/', 'servicePages')->name('index');
        Route::get('/{slug}/edit', 'editServicePage')->name('edit');
        Route::put('/{slug}', 'updateServicePage')->name('update');
        Route::delete('/{slug}', 'deleteServicePage')->name('delete');
        Route::post('/bulk-create', 'bulkCreateSeoPages')->name('bulk-create');
    });
});

/*
|--------------------------------------------------------------------------
| Catch-All Route (Must be last!)
|--------------------------------------------------------------------------
*/

Route::get('/{service}', [AllServicesController::class, 'showService'])
    ->name('service.show')
    ->where('service', '.*');
