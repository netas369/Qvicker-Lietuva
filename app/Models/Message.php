<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'sender_id',
        'sender_type',
        'message',
        'is_read'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function sender()
    {
        if ($this->sender_type === 'provider') {
            return $this->belongsTo(User::class, 'sender_id');
        } else {
            return $this->belongsTo(User::class, 'sender_id');
        }
    }
}
