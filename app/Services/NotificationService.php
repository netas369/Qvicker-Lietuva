<?php

namespace App\Services;

use App\Enums\NotificationType;
use App\Models\Notification;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Message;
use App\Models\Review;
use App\Notifications\MessageReceivedProvider;
use App\Notifications\MessageReceivedSeeker;
use App\Notifications\NewBookingNotification;
use App\Notifications\ReservationAcceptedNotification;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send notification helper - handles both email and database
     */
    private function sendNotification($user, $notification)
    {
        try {
            Log::info('Sending notification to user: ' . $user->id);
            Log::info('Notification type: ' . get_class($notification));

            $user->notify($notification);

            // Clear the user's notification cache so they see it immediately
            cache()->forget("user_{$user->id}_notifications");
            cache()->forget("user_{$user->id}_unread_count");

            Log::info('Notification sent successfully');
            $this->emitLivewireEvent();


        } catch (\Exception $e) {
            Log::error('Failed to send notification: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        }
    }

    /**
     * Create a notification for a new reservation
     */
    public function notifyNewReservation(User $provider,User $seeker, Reservation $reservation): void
    {
        // Send to provider (new booking alert)
        $this->sendNotification($provider, new NewBookingNotification($reservation));

        // Send to seeker (booking confirmation)
        $this->sendNotification($seeker, new NewBookingNotification($reservation));
    }

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

    public function notifyMessageReceivedSeeker(Reservation $reservation): void
    {
        // Use the static method from the notification class
        MessageReceivedSeeker::notifyWithMessageCount($reservation);

        // Clear cache
        $seeker = $reservation->seeker;
        cache()->forget("user_{$seeker->id}_notifications");
        cache()->forget("user_{$seeker->id}_unread_count");

        $this->emitLivewireEvent();
    }

    public function notifyMessageReceivedProvider(Reservation $reservation): void
    {
        // Use the static method from the notification class
        MessageReceivedProvider::notifyWithMessageCount($reservation);

        // Clear cache
        $provider = $reservation->provider;
        cache()->forget("user_{$provider->id}_notifications");
        cache()->forget("user_{$provider->id}_unread_count");

        $this->emitLivewireEvent();
    }

    public function notifyReviewIsReceived(Reservation $reservation): Notification
    {
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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


    public function notifySeekerReservationAccepted(Reservation $reservation): void
    {
        $seeker = $reservation->seeker;

        // Sends BOTH email AND database notification
        $this->sendNotification($seeker, new ReservationAcceptedNotification($reservation));
    }

    public function notifyProviderCanceledReservation(Reservation $reservation): Notification
    {
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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


    public function notifyNewReservationSeeker(User $seeker, Reservation $reservation): Notification
    {
        $provider = $reservation->provider;

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
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

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




    //REFACTORING

    // Add these methods to your NotificationService class:

    public function notifyReservationPriceChanged(Reservation $reservation): Notification
    {
        $seeker = $reservation->seeker;
        $provider = $reservation->provider;

        $typeLabel = $this->getPriceTypeLabel($reservation->type);

        $notification_text = 'Rezervacijos Nr. ' . $reservation->id . ' kaina buvo pakeista į ' .
            number_format($reservation->price, 2) . '€' . $typeLabel . '.';

        return $this->createNotification(
            $seeker->id,
            NotificationType::RESERVATION_PRICE_CHANGED,
            $reservation,
            $provider,
            $seeker,
            $notification_text
        );
    }

// Add this helper method to your NotificationService class
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
