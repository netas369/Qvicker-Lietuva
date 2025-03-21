<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider_id',
        'reservation_date',
        'description',
        'address',
        'phone',
        'task_size',
        'subcategory',
        'city',
        'status',
    ];

    /**
     * Get the seeker who made the reservation.
     */
    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    /**
     * Get the provider for this reservation.
     */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Check if this reservation can be reviewed
    public function canBeReviewed()
    {
        return $this->status === 'completed' && !$this->review()->exists();
    }
}
