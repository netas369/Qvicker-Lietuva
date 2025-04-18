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

    public function notifyMessageReceivedSeeker(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        // Check if there's an unread notification for this conversation
        $existingNotification = Notification::where('user_id', $seeker->id)
            ->where('type', NotificationType::NEW_MESSAGE_FOR_SEEKER)
            ->whereNull('read_at')
            ->whereJsonContains('data->reservation_id', $reservation->id)
            ->first();

        if ($existingNotification) {
            // Get the current data - check if it's already an array
            $data = is_string($existingNotification->data)
                ? json_decode($existingNotification->data, true)
                : $existingNotification->data;

            // Update the message count
            $messageCount = isset($data['message_count']) ? $data['message_count'] + 1 : 2;

            // Update notification text to show message count
            $notification_text = 'Gavote ' . $messageCount . ' žinutes nuo ' . $provider->name . '! Rezervacijos Nr. ' . $reservation->id . '. Paspauskite, kad peržiūrėti.';

            // Update the notification
            $data['notification_text'] = $notification_text;
            $data['message_count'] = $messageCount;
            $existingNotification->data = $data; // Laravel will handle the JSON encoding

            // Update timestamp
            $existingNotification->updated_at = now();
            $existingNotification->save();

            return $existingNotification;
        } else {
            // Create new notification
            $notification_text = 'Gavote žinutę nuo ' . $provider->name . '! Rezervacijos Nr. ' . $reservation->id . '. Paspauskite, kad peržiūrėti.';

            return $this->createNotification(
                $seeker->id,
                NotificationType::NEW_MESSAGE_FOR_SEEKER,
                $reservation,
                $provider,
                $seeker,
                $notification_text,
                ['message_count' => 1]
            );
        }
    }

    public function notifyMessageReceivedProvider(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        // Check if there's an unread notification for this conversation
        $existingNotification = Notification::where('user_id', $provider->id)
            ->where('type', NotificationType::NEW_MESSAGE_FOR_PROVIDER)
            ->whereNull('read_at')
            ->whereJsonContains('data->reservation_id', $reservation->id)
            ->first();

        if ($existingNotification) {
            // Get the current data - check if it's already an array
            $data = is_string($existingNotification->data)
                ? json_decode($existingNotification->data, true)
                : $existingNotification->data;

            // Update the message count
            $messageCount = isset($data['message_count']) ? $data['message_count'] + 1 : 2;

            // Update notification text to show message count
            $notification_text = 'Gavote ' . $messageCount . ' žinutes nuo ' . $seeker->name . '! Rezervacijos Nr. ' . $reservation->id . '. Paspauskite, kad peržiūrėti.';

            // Update the notification
            $data['notification_text'] = $notification_text;
            $data['message_count'] = $messageCount;
            $existingNotification->data = $data; // Laravel will handle the JSON encoding

            // Update timestamp
            $existingNotification->updated_at = now();
            $existingNotification->save();

            return $existingNotification;
        } else {
            // Create new notification
            $notification_text = 'Gavote žinutę nuo ' . $seeker->name . '! Rezervacijos Nr. ' . $reservation->id . '. Paspauskite, kad peržiūrėti.';

            return $this->createNotification(
                $provider->id,
                NotificationType::NEW_MESSAGE_FOR_PROVIDER,
                $reservation,
                $provider,
                $seeker,
                $notification_text,
                ['message_count' => 1]
            );
        }
    }

    public function notifyReviewIsReceived(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Gavote Atsiliepimą nuo ' . $seeker->name . '! Rezervacijos Nr. ' . $reservation->id . '. Paspauskite, kad peržiūrėti.';

        return $this->createNotification(
            $provider->id,
            NotificationType::REVIEW_RECEIVED,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
    }

    public function notifyReservationAutoCompleted(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacijos Nr. ' . $reservation->id . ' statusas buvo automatiškai pakeistas į UŽBAIGTA. Kadangi
        nebuvo pažymėta kaip užbaigta per 72 val.';

        return $this->createNotification(
            $provider->id,
            NotificationType::RESERVATION_AUTOMATICALLY_COMPLETED,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
    }

    public function notifyReservationCompleted(Reservation $reservation): Notification
    {
        $seeker = User::find($reservation->seeker_id);
        $provider = User::find($reservation->provider_id);

        $notification_text = 'Rezervacijos Nr. ' . $reservation->id . ' statusas buvo pakeistas į UŽBAIGTA. Nepamirškite palikti atsiliepimą apie ' .
        $provider->name . '.';

        return $this->createNotification(
            $seeker->id,
            NotificationType::RESERVATION_COMPLETED,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
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
