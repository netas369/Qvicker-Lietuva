<?php

namespace App\Listeners;

use App\Events\ReservationUpdated;
use App\Services\NotificationService;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class HandleReservationUpdated
{
    protected $notificationService;

    /**
     * Create the event listener.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(ReservationUpdated $event): void
    {
        $reservation = $event->reservation;
        $changes = $event->changes;
        $changeMessages = [];

        // Handle price change
        if (isset($changes['price'])) {
            $this->notificationService->notifyReservationPriceChanged($reservation);

            $typeLabel = $this->getPriceTypeLabel($reservation->type);
            $changePriceMessage = 'Rezervacijos kaina buvo pakeista į ' .
                number_format($reservation->price, 2) . '€' . $typeLabel . '.';

            $changeMessages[] = $changePriceMessage;
        }

        // Handle date change
        if (isset($changes['date'])) {
            $this->notificationService->notifyReservationDayChanged($reservation);

            $changeDayMessage = 'Rezervacijos data pakeista į ' . $reservation->reservation_date . '.';
            $changeMessages[] = $changeDayMessage;
        }

        // Create a single combined chat message
        if (!empty($changeMessages)) {
            $combinedMessage = implode(' ', $changeMessages);

            Message::create([
                'reservation_id' => $reservation->id,
                'sender_id' => Auth::id(),
                'sender_type' => 'provider',
                'message' => $combinedMessage,
            ]);
        }
    }

    private function getPriceTypeLabel($type): string
    {
        return match($type) {
            'hourly' => ' / val.',
            'fixed' => ' (fiksuotas)',
            'meter' => ' / m',
            default => ''
        };
    }
}
