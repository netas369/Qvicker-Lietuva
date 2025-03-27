<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarNotifications extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    public $isOpen = false;

    protected $listeners = ['refreshNotifications' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $user = auth()->user();

        if ($user) {
            $this->notifications = $user->notifications()
                ->latest()
                ->take(5)
                ->get()
                ->toArray();

            $this->unreadCount = $user->notifications()
                ->whereNull('read_at')
                ->count();
        }
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->update(['read_at' => now()]);

        $this->loadNotifications();
        $this->emit('refreshNotifications');
    }

    public function markAllAsRead()
    {
        auth()->user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        $this->loadNotifications();
        $this->emit('refreshNotifications');
    }

    public function render()
    {
        return view('livewire.navbar-notifications');
    }
}
