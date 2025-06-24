<?php

namespace App\Notifications;

use App\Enums\NotificationType;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;

    protected $reservation;

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
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $isProvider = $notifiable->role === 'provider';

        if ($isProvider) {
            $notification_text = 'Naujas užsakymas! ' . $this->reservation->seeker->name . ' reikia paslaugos mieste ' . $this->reservation->city . '. Data: ' . $this->reservation->reservation_date;
        } else {
            $notification_text = 'Užsakymas išsiųstas! Jūsų užklausa darbui mieste ' . $this->reservation->city . ' perduota paslaugų teikėjui';
        }

        return [
            'reservation_id' => $this->reservation->id,
            'type' => NotificationType::NEW_RESERVATION,
            'notification_text' => $notification_text,
            // Add these for template compatibility
            'seeker_name' => $this->reservation->seeker->name,
            'provider_name' => $this->reservation->provider->name,
            'city' => $this->reservation->city,
            'reservation_data' => [
                'city' => $this->reservation->city,
                'date' => $this->reservation->reservation_date,
            ]
        ];
    }
}
