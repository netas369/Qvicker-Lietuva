<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class AutoCompleteReservations extends Command
{
    protected $signature = 'reservations:auto-complete';
    protected $description = 'Auto-complete accepted reservations that are 3 days past their reservation date';

    public function handle(): int
    {
        // Find reservations that are accepted and 3+ days past their date
        $cutoffDate = Carbon::now()->subDays(3)->format('Y-m-d');

        $count = Reservation::where('status', 'accepted')
            ->whereDate('reservation_date', '<', $cutoffDate)
            ->update(['status' => 'completed']);

        $this->info("{$count} reservations were automatically marked as completed.");

        return Command::SUCCESS;
    }
}
