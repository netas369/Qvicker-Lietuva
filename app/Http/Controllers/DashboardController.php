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

        if($user->role == 'provider')
        {
            $upcomingReservations = $user->providerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '=', 'accepted')
                ->orderBy('reservation_date', 'asc')
                ->take(5)
                ->get();

            // Get total count for providers
            $totalProviderReservations = $user->providerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '=', 'accepted')
                ->count();

        } elseif ($user->role === 'seeker') {
            $upcomingReservations = $user->seekerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '=', 'accepted')
                ->orderBy('reservation_date', 'asc')
                ->take(5)
                ->get();

            // Get total count for seekers
            $totalSeekerReservations = $user->seekerReservations()
                ->where('reservation_date', '>=', now()->toDateString())
                ->where('status', '=', 'accepted')
                ->count();
        }

        return view('profile.dashboard', compact('user', 'upcomingReservations', 'totalProviderReservations', 'totalSeekerReservations'));
    }
}
