<?php

namespace App\Console\Commands;

use App\Services\NotificationService;
use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class AutoCompleteReservations extends Command
{
    protected $signature = 'reservations:auto-complete';
    protected $description = 'Auto-complete accepted reservations that are 3 days past their reservation date';
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function handle(): int
    {
        // Find reservations that are accepted and 3+ days past their date
        $cutoffDate = Carbon::now()->subDays(3)->format('Y-m-d');

        // Get all matching reservations instead of doing a mass update
        $reservations = Reservation::where('status', 'accepted')
            ->whereDate('reservation_date', '<', $cutoffDate)
            ->get();

        $count = 0;

        // Process each reservation individually
        foreach ($reservations as $reservation) {
            // Update status
            $reservation->status = 'completed';
            $reservation->save();

            // Send notification for this specific reservation
            $this->notificationService->notifyReservationAutoCompleted($reservation);
            $this->notificationService->notifyReservationCompleted($reservation);

            $count++;
        }

        $this->info("{$count} reservations were automatically marked as completed.");

        return Command::SUCCESS;
    }
}
