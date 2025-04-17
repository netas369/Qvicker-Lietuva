<?php

namespace App\Services;

use App\Enums\NotificationType;
use App\Models\Notification;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Message;
use App\Models\Review;

class NotificationService
{
    public function notifyProviderCanceledReservation(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacija Nr. ' . $reservation->id . ' mieste ' . $reservation->city . ' buvo atšaukta paslaugos tiekėjo.';

        $notification = Notification::create([
           'user_id' => $seeker->id,
           'type' => NotificationType::RESERVATION_CANCELLED_BY_PROVIDER,
           'data' => [
               'reservation_id' => $reservation->id,
               'provider_id' => $provider->id,
               'provider_name' => $provider->name,
               'city' => $reservation->city,
               'date' => $reservation->reservation_date,
               'notification_text' => $notification_text,
               'timestamp' => now()->toIso8601String(),
           ],
           'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    public function notifySeekerCanceledReservation(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacija Nr. ' . $reservation->id . ' mieste ' . $reservation->city . ' buvo atšaukta paslaugos ieškotojo.';

        $notification = Notification::create([
           'user_id' => $provider->id,
           'type' => NotificationType::RESERVATION_CANCELLED_BY_SEEKER,
            'data' => [
                'reservation_id' => $reservation->id,
                'seeker_id' => $seeker->id,
                'seeker_name' => $seeker->name,
                'city' => $reservation->city,
                'date' => $reservation->reservation_date,
                'notification_text' => $notification_text,
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    /**
     * Create a notification for a new reservation
     */
    public function notifyNewReservation(User $provider, Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);

        $notification = Notification::create([
            'user_id' => $provider->id,
            'type' => NotificationType::NEW_RESERVATION,
            'data' => [
                'reservation_id' => $reservation->id,
                'seeker_id' => $seeker->id,
                'seeker_name' => $seeker->name,
                'description' => substr($reservation->description, 0, 100) . (strlen($reservation->description) > 100 ? '...' : ''),
                'city' => $reservation->city,
                'date' => $reservation->reservation_date,
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    public function notifyNewReservationSeeker(User $seeker, Reservation $reservation): Notification
    {
        $provider = User::find($reservation->provider_id);

        $notification = Notification::create([
           'user_id' => $seeker->id,
           'type' => NotificationType::RESERVATION_REQUESTED,
           'data' => [
               'reservation_id' => $reservation->id,
               'provider_id' => $provider->id,
               'provider_name' => $provider->name,
               'description' => substr($reservation->description, 0, 100) . (strlen($reservation->description) > 100 ? '...' : ''),
               'city' => $reservation->city,
               'date' => $reservation->reservation_date,
               'timestamp' => now()->toIso8601String(),
           ],
           'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    public function notifyReservationCancelledSeeker(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification = Notification::create([
            'user_id' => $seeker->id,
            'type' => NotificationType::RESERVATION_CANCELLED,
            'data' => [
                'reservation_id' => $reservation->id,
                'provider_id' => $provider->id,
                'provider_name' => $provider->name,
                'description' => substr($reservation->description, 0, 100) . (strlen($reservation->description) > 100 ? '...' : ''),
                'city' => $reservation->city,
                'date' => $reservation->reservation_date,
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    public function notifyReservationCancelledProvider(Reservation $reservation): Notification
    {
        $provider = User::find($reservation->provider_id);
        $seeker = User::find($reservation->seeker_id);

        $notification = Notification::create([
            'user_id' => $provider->id,
            'type' => NotificationType::RESERVATION_CANCELLED,
            'data' => [
                'reservation_id' => $reservation->id,
                'seeker_id' => $seeker->id,
                'seeker_name' => $seeker->name,
                'description' => substr($reservation->description, 0, 100) . (strlen($reservation->description) > 100 ? '...' : ''),
                'city' => $reservation->city,
                'date' => $reservation->reservation_date,
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;

    }

    /**
     * Create a notification for a reservation status change
     */
    public function notifyReservationStatusChange(User $seeker, Reservation $reservation, bool $accepted): Notification
    {
        $provider = User::find($reservation->provider_id);

        $notification = Notification::create([
            'user_id' => $seeker->id,
            'type' => $accepted ? NotificationType::RESERVATION_ACCEPTED : NotificationType::RESERVATION_DECLINED,
            'data' => [
                'reservation_id' => $reservation->id,
                'provider_id' => $provider->id,
                'provider_name' => $provider->name,
                'description' => substr($reservation->description, 0, 100) . (strlen($reservation->description) > 100 ? '...' : ''),
                'city' => $reservation->city,
                'date' => $reservation->reservation_date,
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    /**
     * Create a notification for a new message
     */
    public function notifyNewMessage(User $receiver, Message $message): Notification
    {
        $sender = User::find($message->sender_id);

        $notification = Notification::create([
            'user_id' => $receiver->id,
            'type' => NotificationType::NEW_MESSAGE,
            'data' => [
                'message_id' => $message->id,
                'sender_id' => $sender->id,
                'sender_name' => $sender->name,
                'content_preview' => substr($message->content, 0, 100) . (strlen($message->content) > 100 ? '...' : ''),
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    /**
     * Create a notification for a new review
     */
    public function notifyReviewReceived(User $provider, Review $review): Notification
    {
        $seeker = User::find($review->seeker_id);

        $notification = Notification::create([
            'user_id' => $provider->id,
            'type' => NotificationType::REVIEW_RECEIVED,
            'data' => [
                'review_id' => $review->id,
                'seeker_id' => $seeker->id,
                'seeker_name' => $seeker->name,
                'rating' => $review->rating,
                'comment_preview' => substr($review->comment, 0, 100) . (strlen($review->comment) > 100 ? '...' : ''),
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null,
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($notificationId)
    {
        $this->notificationService->markAsRead($notificationId);
        $this->loadNotifications();
    }

    public function markAllAsRead()
    {
        $user = auth()->user();
        $this->notificationService->markAllAsRead($user);
        $this->loadNotifications();
    }

    /**
     * Emit Livewire event to refresh notifications
     */
    private function emitLivewireEvent(): void
    {
        // For Livewire v3
        if (class_exists('\Livewire\Facades\Livewire')) {
            \Livewire\Facades\Livewire::dispatch('refreshNotifications');
        }
    }
}
