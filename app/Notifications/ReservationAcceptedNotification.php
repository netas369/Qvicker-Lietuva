<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationAcceptedNotification extends Notification
{
    use Queueable;

    protected Reservation $reservation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $provider = $this->reservation->provider;
        $seeker = $notifiable;
        $reservation = $this->reservation;

        return (new MailMessage)
            ->subject('🎉 Jūsų Rezervacija Patvirtinta - Qvicker')
            ->view('emails.reservation-accepted', [
                'seeker' => $seeker,
                'provider' => $provider,
                'reservation' => $reservation
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'provider_id' => $this->reservation->provider_id,
            'provider_name' => $this->reservation->provider->name,
            'city' => $this->reservation->city,
            'date' => $this->reservation->reservation_date,
            'time' => $this->reservation->reservation_time,
            'price' => $this->reservation->price,
            'type' => $this->reservation->type,
            'message' => 'Jūsų rezervacija Nr. ' . $this->reservation->id . ' buvo patvirtinta paslaugos tiekėjo ' . $this->reservation->provider->name . '.',
        ];
    }

    /**
     * Get price type label in Lithuanian
     */
    private function getPriceTypeLabel(string $type): string
    {
        return match($type) {
            'hourly' => ' / val.',
            'fixed' => ' (fiksuotas)',
            'meter' => ' / m',
            default => ''
        };
    }
}
