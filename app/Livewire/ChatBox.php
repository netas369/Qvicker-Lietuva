<?php

namespace App\Livewire;

use App\Models\Message;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class ChatBox extends Component
{
    public $reservation;
    public $messageText = '';
    public $messages = [];
    public $lastMessageId = 0;
    public $sending = false; // Add loading state

    public function mount($reservation)
    {
        $this->reservation = $reservation;
        $this->loadMessages();
    }

    private function isProvider()
    {
        return Auth::id() === $this->reservation->provider_id;
    }

    public function name()
    {
        if(Auth::id() === $this->reservation->provider_id) {
            return $this->reservation->seeker->name;
        } else {
            return $this->reservation->provider->name;
        }
    }

    #[On('message-received')]
    public function refreshMessages()
    {
        $this->loadNewMessages();
    }

    // Optimized: Only load new messages instead of all messages
    public function loadNewMessages()
    {
        if ($this->lastMessageId === 0) {
            $this->loadMessages();
            return;
        }

        // Only get messages newer than the last one we have
        $newMessages = $this->reservation->messages()
            ->where('id', '>', $this->lastMessageId)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($newMessages->count() > 0) {
            // Add new messages to existing array
            $this->messages = $this->messages->merge($newMessages);
            $this->lastMessageId = $newMessages->last()->id;

            // Mark new messages as read (only if not sent by current user)
            $this->markNewMessagesAsRead($newMessages);

            $this->dispatch('chat-updated');
        }
    }

    // Optimized: Load messages with single query and better caching
    public function loadMessages()
    {
        // Single optimized query with minimal data
        $this->messages = $this->reservation->messages()
            ->select('id', 'sender_id', 'sender_type', 'message', 'created_at', 'is_read')
            ->orderBy('created_at', 'asc')
            ->get();

        if ($this->messages->count() > 0) {
            $this->lastMessageId = $this->messages->last()->id;

            // Batch mark as read
            $this->markMessagesAsRead();
        }
    }

    // Optimized: Batch update for read status
    private function markMessagesAsRead()
    {
        $userType = $this->isProvider() ? 'provider' : 'seeker';

        DB::table('messages')
            ->where('reservation_id', $this->reservation->id)
            ->where('sender_type', '!=', $userType)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    // Mark only new messages as read
    private function markNewMessagesAsRead($newMessages)
    {
        $userType = $this->isProvider() ? 'provider' : 'seeker';
        $unreadIds = $newMessages->where('sender_type', '!=', $userType)
            ->where('is_read', false)
            ->pluck('id');

        if ($unreadIds->count() > 0) {
            DB::table('messages')
                ->whereIn('id', $unreadIds)
                ->update(['is_read' => true]);
        }
    }

    // Optimized: Faster message sending while keeping NotificationService
    public function sendMessage()
    {
        if (empty(trim($this->messageText)) || $this->sending) {
            return;
        }

        $this->sending = true; // Prevent double-sends

        try {
            $receiverId = $this->isProvider() ? $this->reservation->seeker_id : $this->reservation->provider_id;
            $senderType = $this->isProvider() ? 'provider' : 'seeker';

            // Create proper Message model instance instead of plain object
            $message = new Message([
                'reservation_id' => $this->reservation->id,
                'sender_id' => Auth::id(),
                'receiver_id' => $receiverId,
                'sender_type' => $senderType,
                'message' => trim($this->messageText),
            ]);

            $message->save();

            // Add the saved model to collection (consistent type)
            $this->messages->push($message);
            $this->lastMessageId = $message->id;

            // Clear input immediately
            $this->messageText = '';

            // Dispatch events for UI updates
            $this->dispatch('message-received');
            $this->dispatch('chat-updated');

            // Keep NotificationService but optimize it
            $this->sendNotification($senderType);

        } catch (\Exception $e) {
            \Log::error('Chat message send failed: ' . $e->getMessage());
            session()->flash('chat_error', 'Nepavyko išsiųsti žinutės. Bandykite dar kartą.');
        } finally {
            $this->sending = false;
        }
    }

    // Optimized notification sending - keep the service but make it faster
    private function sendNotification($senderType)
    {
        try {
            $notification_service = new NotificationService();

            if($senderType === 'provider') {
                $notification_service->notifyMessageReceivedSeeker($this->reservation);
            } else {
                $notification_service->notifyMessageReceivedProvider($this->reservation);
            }
        } catch (\Exception $e) {
            \Log::error('Notification sending failed: ' . $e->getMessage());
            // Don't fail the whole message sending if notification fails
        }
    }

    public function render()
    {
        return view('livewire.chat-box');
    }
}
