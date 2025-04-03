<?php

namespace App\Enums;

class NotificationType
{
    public const NEW_MESSAGE = 'new_message';
    public const NEW_RESERVATION = 'new_reservation';
    public const RESERVATION_ACCEPTED = 'reservation_accepted';
    public const RESERVATION_DECLINED = 'reservation_declined';
    public const REVIEW_RECEIVED = 'review_received';
    public const RESERVATION_REQUESTED = 'reservation_requested';

}
