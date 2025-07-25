<?php

namespace App\Notifications;

use App\Enums\NotificationType;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class MessageReceivedProvider extends Notification
{
    use Queueable;

    protected $reservation;
    protected $seeker;
    protected $messageCount;

    /**
     * Create a new notification instance.
     */
    public function __construct(Reservation $reservation, User $seeker, int $messageCount = 1)
    {
        $this->reservation = $reservation;
        $this->seeker = $seeker;
        $this->messageCount = $messageCount;
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
        $subject = $this->messageCount > 1
            ? "💬 {$this->messageCount} naujos žinutės nuo {$this->seeker->name} - Qvicker"
            : "💬 Nauja žinutė nuo {$this->seeker->name} - Qvicker";

        $actionText = $this->messageCount > 1
            ? "Peržiūrėti {$this->messageCount} žinutes"
            : "Peržiūrėti žinutę";

        $introLine = $this->messageCount > 1
            ? "Gavote {$this->messageCount} naujas žinutes nuo kliento {$this->seeker->name} rezervacijoje Nr. {$this->reservation->id}."
            : "Gavote naują žinutę nuo kliento {$this->seeker->name} rezervacijoje Nr. {$this->reservation->id}.";

        return (new MailMessage)
            ->subject($subject)
            ->view('emails.message-received-provider', [
                'notifiable' => $notifiable,
                'reservation' => $this->reservation,
                'seeker' => $this->seeker,
                'messageCount' => $this->messageCount,
                'actionUrl' => route('reservation.modify', $this->reservation->id),
                'introLine' => $introLine,
                'actionText' => $actionText
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $notification_text = $this->messageCount > 1
            ? "Gavote {$this->messageCount} žinutes nuo {$this->seeker->name}! Rezervacijos Nr. {$this->reservation->id}. Paspauskite, kad peržiūrėti."
            : "Gavote žinutę nuo {$this->seeker->name}! Rezervacijos Nr. {$this->reservation->id}. Paspauskite, kad peržiūrėti.";

        return [
            'reservation_id' => $this->reservation->id,
            'type' => NotificationType::NEW_MESSAGE_FOR_PROVIDER,
            'notification_text' => $notification_text,
            'seeker_name' => $this->seeker->name,
            'provider_name' => $notifiable->name,
            'message_count' => $this->messageCount,
            'reservation_data' => [
                'status' => $this->reservation->status,
                'date' => $this->reservation->reservation_date,
                'city' => $this->reservation->city,
            ]
        ];
    }

    /**
     * Handle the notification logic with message counting
     */
    public static function notifyWithMessageCount(Reservation $reservation): void
    {
        $provider = User::find($reservation->provider_id);
        $seeker = User::find($reservation->seeker_id);

        // Use Laravel's notification system to find existing notifications
        $existingNotification = $provider->notifications()
            ->where('type', self::class)
            ->whereNull('read_at')
            ->where('data->reservation_id', $reservation->id)
            ->first();

        if ($existingNotification) {
            // EXISTING NOTIFICATION - JUST UPDATE, NO EMAIL
            $data = $existingNotification->data;
            $messageCount = isset($data['message_count']) ? $data['message_count'] + 1 : 2;

            // Update notification text
            $notification_text = "Gavote {$messageCount} žinutes nuo {$seeker->name}! Rezervacijos Nr. {$reservation->id}. Paspauskite, kad peržiūrėti.";

            // Update the existing notification
            $data['notification_text'] = $notification_text;
            $data['message_count'] = $messageCount;

            $existingNotification->update([
                'data' => $data,
                'updated_at' => now()
            ]);

        } else {
            // NEW NOTIFICATION - SEND EMAIL + CREATE DATABASE ENTRY
            $notification = new self($reservation, $seeker, 1);
            $provider->notify($notification);
        }
    }
}
