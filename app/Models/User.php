<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailNotification; // Add this
use App\Notifications\ResetPasswordNotification;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'lastname', 'birthday', 'email', 'city', 'address', 'password', 'subcategories', 'role', 'aboutme', 'image', 'phone', 'postal_code',
        'gender', 'languages', 'cities', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['profile_photo_url'];

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'cities' => 'array',
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'user_subcategory', 'user_id', 'subcategory_id');
    }

    public function unavailabilities()
    {
        return $this->hasMany(Unavailability::class, 'provider_id');
    }

    public function recurringUnavailabilities()
    {
        return $this->hasMany(RecurringUnavailability::class, 'provider_id');
    }

    public function availabilityExceptions()
    {
        return $this->hasMany(AvailabilityException::class, 'provider_id');
    }

    public function subcategories()
    {
        return $this->belongsToMany(Category::class, 'user_subcategory', 'user_id', 'subcategory_id');
    }

    /**
     * Get the reservations made by this seeker.
     */
    public function seekerReservations()
    {
        return $this->hasMany(Reservation::class, 'seeker_id');
    }

    /**
     * Get the reservations assigned to this provider.
     */
    public function providerReservations()
    {
        return $this->hasMany(Reservation::class, 'provider_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'provider_id');
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'seeker_id');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviewsReceived()->avg('rating') ?: 0;
    }

    public function getTotalReservationsDone()
    {
        return $this->providerReservations()->where('status', 'completed')->count() ?: 0;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
