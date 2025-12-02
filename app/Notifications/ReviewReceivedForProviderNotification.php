<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewReceivedForProviderNotification extends Notification
{
    use Queueable;

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
        $provider = $notifiable;
        $provider_name = $this->reservation->provider;
        $seeker = $this->reservation->seeker;
        $reservation = $this->reservation;

        return (new MailMessage)
                    ->subject('Gavote atsiliepimą - Qvicker')
                    ->view('emails.review-received-for-provider', [
                        'provider_name' => $provider_name,
                        'reservation' => $reservation,
                        'seeker' => $seeker,
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
            'notification_text' => 'Gavote atsiliepimą nuo ' . $this->reservation->seeker->name . '. Rezervacijos Nr. ' . $this->reservation->id . '.',
        ];
    }
}
