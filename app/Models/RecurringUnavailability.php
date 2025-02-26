<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringUnavailability extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
        'day_of_week',
    ];

    /**
     * Get the provider that owns the recurring unavailability.
     */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}
