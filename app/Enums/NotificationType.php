<?php

namespace App\Enums;

class NotificationType
{
    public const NEW_MESSAGE_FOR_SEEKER = 'new_message_for_seeker';
    public const NEW_MESSAGE_FOR_PROVIDER = 'new_message_for_provider';
    public const NEW_RESERVATION = 'new_reservation';
    public const RESERVATION_ACCEPTED = 'reservation_accepted';
    public const RESERVATION_COMPLETED = 'reservation_completed';
    public const REVIEW_RECEIVED = 'review_received';
    public const RESERVATION_REQUESTED = 'reservation_requested';
    public const RESERVATION_CANCELLED_BY_SYSTEM = 'reservation_cancelled_by_system';
    public const RESERVATION_CANCELLED_BY_SEEKER = 'reservation_cancelled_by_seeker';
    public const RESERVATION_CANCELLED_BY_PROVIDER = 'reservation_cancelled_by_provider';
    public const RESERVATION_DAY_CHANGED = 'reservation_day_changed';
    public const RESERVATION_AUTOMATICALLY_COMPLETED = 'reservation_automatically_completed';

}
