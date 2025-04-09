<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelPendingReservations extends Command
{
    protected $signature = 'reservations:cancel-pending';
    protected $description = 'Cancel reservations that have been pending for more than 24 hours';

    public function handle()
    {
        // Find reservations that are:
        // 1. Still in "pending" status
        // 2. Created more than 24 hours ago
        // 3. Not yet accepted (accepted_at is null)
        $reservations = Reservation::where('status', 'pending')
            ->whereNull('accepted_at')
            ->where('created_at', '<', Carbon::now()->subHours(24))
            ->get();

        $count = 0;

        foreach ($reservations as $reservation) {
            // Update the reservation
            $reservation->status = 'cancelled';
            $reservation->cancellation_reason = 'Automatiškai atšaukta - nepriimta per 24 val.';
            $reservation->cancellation_details = 'Sistema automatiškai atšaukė rezervaciją, nes paslaugų teikėjas nepriėmė jos per 24 valandas.';
            $reservation->cancelled_by = 'system';
            $reservation->save();

            // Optionally send notifications here
            // You could notify both the seeker and provider

            $count++;
        }

        $this->info("Successfully cancelled {$count} pending reservations.");

        return 0;
    }
}
