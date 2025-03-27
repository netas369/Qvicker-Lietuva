<?php

namespace App\Livewire;

use App\Models\Reservation;
use App\Models\Review;
use Livewire\Component;

class ReservationFeedback extends Component
{
    public $reservation;
    public $rating = 0;
    public $feedbackText ='';
    public $showFeedbackField = false;
    public $reviewIsLeft = false;
    public $feedbackCreatedAt;
    public $user;

    public function mount(Reservation $reservation)
    {
        $this->reservation = $reservation;

        $this->user =  auth()->user();

        $existingFeedback = Review::where('reservation_id', $this->reservation->id)->first();

        if ($existingFeedback) {
            // Set component properties based on existing feedback
            $this->rating = $existingFeedback->rating;
            $this->feedbackText = $existingFeedback->comment;
            $this->feedbackCreatedAt = $existingFeedback->created_at;
            $this->showFeedbackField = true;
            $this->reviewIsLeft = true;
        }

    }

    public function render()
    {
        return view('livewire.reservation-feedback');
    }

    public function setRating($stars)
    {
        $this->rating = $stars;
        $this->showFeedbackField = true;
    }

    public function submitFeedback()
    {
        $this->validate([
           'rating' => 'required|integer|min:1|max:5',
           'feedbackText' => 'max:255'
        ]);

        Review::create([
            'reservation_id' => $this->reservation->id,
            'provider_id' => $this->reservation->provider_id,
            'seeker_id' => $this->reservation->seeker_id,
            'rating' => $this->rating,
            'comment' => $this->feedbackText,
            'is_approved' => true
        ]);

        $this->reset(['rating', 'feedbackText', 'showFeedbackField']);
        $this->reviewIsLeft = true;
        session()->flash('message', 'Ačiū už jūsų atsiliepimą!');
        $this->redirect(request()->header('Referer'));

    }
}
