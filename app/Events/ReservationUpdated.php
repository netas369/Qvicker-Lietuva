<?php

namespace App\Events;

use App\Models\Reservation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reservation;
    public $changes;

    /**
     * Create a new event instance.
     */
    public function __construct(Reservation $reservation, array $changes)
    {
        $this->reservation = $reservation;
        $this->changes = $changes;
    }
}
