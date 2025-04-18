<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Models\Reservation;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelPendingReservations extends Command
{
    protected $signature = 'reservations:cancel-pending';
    protected $description = 'Cancel reservations that have been pending for more than 24 hours';
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        parent::__construct(); // Don't forget this line!
        $this->notificationService = $notificationService;
    }

    public function handle()
    {
        // Find reservations that are:
        // 1. Still in "pending" status
        // 2. Created more than 36 hours ago
        // 3. Not yet accepted (accepted_at is null)
        $reservations = Reservation::where('status', 'pending')
            ->whereNull('accepted_at')
            ->where('created_at', '<', Carbon::now()->subHours(36))
            ->get();

        $count = 0;

        foreach ($reservations as $reservation) {
            // Update the reservation
            $reservation->status = 'declined';
            $reservation->cancellation_reason = 'Automatiškai atšaukta - nepriimta per 36 val.';
            $reservation->cancellation_details = 'Sistema automatiškai atšaukė rezervaciją, nes paslaugų teikėjas nepriėmė jos per 36 valandas.';
            $reservation->cancelled_by = 'system';
            $reservation->save();


            // Send notifications
            try {
                $this->notificationService->notifyReservationCancelledSeeker($reservation);
                $this->notificationService->notifyReservationCancelledProvider( $reservation);

                $cancellation_message = Message::create([
                    'reservation_id' => $reservation->id,
                    'sender_id' => $reservation->provider_id,
                    'receiver_id' => $reservation->seeker_id,
                    'sender_type' => 'system',
                    'message' => 'Rezervacija automatiškai buvo atšaukta, kadangi nebuvo priimta per 36 valandas.'
                ]);

                $cancellation_message->save();

                $this->line("Sent cancellation notifications for reservation #{$reservation->id}");
            } catch (\Exception $e) {
                $this->error("Failed to send notification for reservation #{$reservation->id}: " . $e->getMessage());
            }

            $count++;
        }

        $this->info("Successfully cancelled {$count} pending reservations.");

        return 0;
    }
}
