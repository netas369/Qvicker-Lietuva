<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $upcomingReservations = null;
        $totalProviderReservations = 0;
        $totalSeekerReservations = 0;
        $activeReservationsCount = 0; // Add this

        if($user->role == 'provider')
        {
            // Get limited reservations for display
            $upcomingReservations = $user->providerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '!=', 'declined')
                ->orderBy('reservation_date', 'asc')
                ->take(5)
                ->get();

            // Get count for badge (same criteria as display)
            $activeReservationsCount = $user->providerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '!=', 'declined')
                ->count();

            // Get total count for "view all" link
            $totalProviderReservations = $user->providerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '=', 'accepted')
                ->count();

        } elseif ($user->role === 'seeker') {
            // Get limited reservations for display
            $upcomingReservations = $user->seekerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '!=', 'declined')
                ->orderBy('reservation_date', 'asc')
                ->take(5)
                ->get();

            // Get count for badge (same criteria as display)
            $activeReservationsCount = $user->seekerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '!=', 'declined')
                ->count();

            // Get total count for "view all" link
            $totalSeekerReservations = $user->seekerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '=', 'accepted')
                ->count();
        }

        return view('profile.dashboard', compact('user', 'upcomingReservations', 'totalProviderReservations', 'totalSeekerReservations', 'activeReservationsCount'));
    }
}
