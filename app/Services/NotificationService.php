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
    /**
     * Private function to reduce redundant code for making notifications
     */
    private function createNotification($userId, $notificationType, Reservation $reservation, User $provider, User $seeker, $notificationText)
    {
        $notification = Notification::create([
            'user_id' => $userId,
            'type' => $notificationType,
            'data' => [
                'reservation_id' => $reservation->id,
                'provider_id' => $provider->id,
                'seeker_id' => $seeker->id,
                'provider_name' => $provider->name,
                'seeker_name' => $seeker->name,
                'city' => $reservation->city,
                'date' => $reservation->reservation_date,
                'notification_text' => $notificationText,
                'timestamp' => now()->toIso8601String(),
            ],
            'read_at' => null
        ]);

        $this->emitLivewireEvent();

        return $notification;
    }

    public function notifyReservationDayChanged(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacijos Nr. ' . $reservation->id . ' diena buvo pakeista į  ' . $reservation->reservation_date . '.';

        return $this->createNotification(
            $seeker->id,
            NotificationType::RESERVATION_DAY_CHANGED,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );

    }


    public function notifySeekerReservationAccepted(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacija Nr. ' . $reservation->id . ' buvo priimta paslaugos tiekėjo ' . $provider->name . '.';

        return $this->createNotification(
            $seeker->id,
            NotificationType::RESERVATION_ACCEPTED,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );

    }

    public function notifyProviderCanceledReservation(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacija Nr. ' . $reservation->id . ' mieste ' . $reservation->city . ' buvo atšaukta paslaugos tiekėjo.';

        return $this->createNotification(
            $seeker->id,
            NotificationType::RESERVATION_CANCELLED_BY_PROVIDER,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );

    }

    public function notifySeekerCanceledReservation(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacija Nr. ' . $reservation->id . ' mieste ' . $reservation->city . ' buvo atšaukta paslaugos ieškotojo.';

        return $this->createNotification(
            $provider->id,
            NotificationType::RESERVATION_CANCELLED_BY_SEEKER,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
    }

    /**
     * Create a notification for a new reservation
     */
    public function notifyNewReservation(User $provider, Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);

        $notification_text = $seeker->name . ' atsiuntė naują užklausą darbui ' . ' mieste ' . $reservation->city;

        return $this->createNotification(
            $provider->id,
            NotificationType::NEW_RESERVATION,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );

    }

    public function notifyNewReservationSeeker(User $seeker, Reservation $reservation): Notification
    {
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Išsiuntėte naują užklausą darbui mieste ' . $reservation->city . '. Laukite patvirtinimo iš ' . $provider->name . '.';

        return $this->createNotification(
            $seeker->id,
            NotificationType::RESERVATION_REQUESTED,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
    }

    public function notifyReservationCancelledSeeker(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacija Nr. ' . $reservation->id . ' buvo atšaukta.';

        return $this->createNotification(
            $seeker->id,
            NotificationType::RESERVATION_CANCELLED_BY_SYSTEM,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
    }

    public function notifyReservationCancelledProvider(Reservation $reservation): Notification
    {
        $provider = User::find($reservation->provider_id);
        $seeker = User::find($reservation->seeker_id);

        $notification_text = 'Rezervacija Nr. ' . $reservation->id . ' buvo atšaukta.';

        return $this->createNotification(
            $provider->id,
            NotificationType::RESERVATION_CANCELLED_BY_SYSTEM,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
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
