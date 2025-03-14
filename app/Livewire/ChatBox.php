<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class ChatBox extends Component
{
    public $reservation;
    public $messageText = '';
    public $messages = [];
    private $lastMessageCount = 0;

    public function mount($reservation)
    {
        $this->reservation = $reservation;
        $this->loadMessages();
        $this->lastMessageCount = count($this->messages);
    }

    private function isProvider()
    {
        return Auth::id() === $this->reservation->provider_id;
    }

    #[On('message-received')]
    public function refreshMessages()
    {
        $this->loadMessages();
        $this->dispatch('chat-updated');
    }

    public function loadMessages()
    {
        // Store the current count before loading
        $previousCount = count($this->messages);

        // Load messages
        $this->messages = $this->reservation->messages()->orderBy('created_at', 'asc')->get();

        // Check if we have new messages
        $currentCount = count($this->messages);

        // If we have new messages from polling, dispatch scroll event
        if ($currentCount > $previousCount) {
            $this->dispatch('chat-updated');
        }

        // Mark messages as read
        $this->reservation->messages()
            ->where('sender_type', '!=', $this->isProvider() ? 'provider' : 'seeker')
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public function sendMessage()
    {
        if (empty($this->messageText)) {
            return;
        }

        $message = new Message([
            'reservation_id' => $this->reservation->id,
            'sender_id' => Auth::id(),
            'sender_type' => $this->isProvider() ? 'provider' : 'seeker',
            'message' => $this->messageText,
        ]);

        $message->save();

        // Clear message input
        $this->messageText = '';

        // Refresh messages immediately
        $this->loadMessages();

        // Dispatch event for other instances
        $this->dispatch('message-received');

        // Dispatch an event for scrolling to bottom
        $this->dispatch('chat-updated');
    }

    public function render()
    {
        return view('livewire.chat-box');
    }
}
