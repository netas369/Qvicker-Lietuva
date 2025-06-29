<?php

namespace App\Livewire;

use App\Models\Reservation;
use App\Models\Review;
use App\Services\NotificationService;
use Livewire\Component;

class ReservationFeedback extends Component
{
    public $reservation;
    public $rating = 0;
    public $feedbackText = '';
    public $showFeedbackField = false;
    public $reviewIsLeft = false;
    public $feedbackCreatedAt;
    public $user;

    // Add validation rules as properties for real-time validation
    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'feedbackText' => 'max:500' // Increased from 255 to 500
    ];

    protected $messages = [
        'rating.required' => 'Prašome pasirinkti vertinimą.',
        'rating.min' => 'Vertinimas turi būti bent 1 žvaigždutė.',
        'rating.max' => 'Maksimalus vertinimas 5 žvaigždutės.',
        'feedbackText.max' => 'Atsiliepimas negali būti ilgesnis nei 500 simbolių.'
    ];

    public function mount(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->user = auth()->user();

        $existingFeedback = Review::where('reservation_id', $this->reservation->id)->first();

        if ($existingFeedback) {
            // Set component properties based on existing feedback
            $this->rating = $existingFeedback->rating;
            $this->feedbackText = $existingFeedback->comment;
            $this->feedbackCreatedAt = $existingFeedback->created_at->format('Y-m-d H:i');
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

        // Clear rating validation errors when user selects a rating
        $this->resetErrorBag('rating');
    }

    // Real-time validation as user types
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitFeedback()
    {
        // Validate all fields
        $this->validate();

        // Double-check character limit on server side
        if (strlen($this->feedbackText) > 500) {
            $this->addError('feedbackText', 'Atsiliepimas per ilgas. Maksimalus ilgis: 500 simbolių.');
            return;
        }

        try {
            Review::create([
                'reservation_id' => $this->reservation->id,
                'provider_id' => $this->reservation->provider_id,
                'seeker_id' => $this->reservation->seeker_id,
                'rating' => $this->rating,
                'comment' => $this->feedbackText,
                'is_approved' => true
            ]);

            $notificationService = new NotificationService();
            $notificationService->notifyReviewIsReceived($this->reservation);

            // Mark as completed
            $this->reviewIsLeft = true;

            session()->flash('message', 'Ačiū už jūsų atsiliepimą!');

            // Refresh the page to show the completed state
            return redirect(request()->header('Referer'));

        } catch (\Exception $e) {
            session()->flash('error', 'Klaida pateikiant atsiliepimą. Bandykite vėliau.');
        }
    }
}
