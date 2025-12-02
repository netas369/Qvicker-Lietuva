<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCompletedNotification extends Notification
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
        $seeker_name = $this->reservation->seeker;
        $provider = $this->reservation->provider;
        $seeker = $notifiable;
        $reservation = $this->reservation;

        return (new MailMessage)
                    ->subject('Jūsų Užklausos Statusas Pakeistas Į Užbaigtą, Palikite Atsiliepimą - Qvicker')
                    ->view('emails.reservation-completed', [
                        'seeker_name' => $seeker_name,
                        'provider' => $provider,
                        'reservation' => $reservation,
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
            'reservation_date' => $this->reservation->reservation_date,
            'time' => $this->reservation->reservation_time,
            'price' => $this->reservation->price,
            'type' => $this->reservation->type,
            'notification_text' => 'Jūsų rezervacija Nr. ' . $this->reservation->id . ' buvo užbaigta paslaugos tiekėjo ' . $this->reservation->provider->name . '.',
        ];
    }
}
