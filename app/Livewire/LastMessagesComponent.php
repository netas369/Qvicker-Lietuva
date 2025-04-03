<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class LastMessagesComponent extends Component
{
    public $messages;

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $user = auth()->user();

        if($user)
        {
            // Join with users table to get sender names in a single query
            $this->messages = Message::select('messages.*', 'users.name as sender_name')
                ->leftJoin('users', 'users.id', '=', 'messages.sender_id')
                ->where('messages.receiver_id', $user->id)
                ->orderBy('messages.created_at', 'desc')
                ->take(5)
                ->get();
        }
    }

    public function refresh()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.last-messages-component');
    }
}
