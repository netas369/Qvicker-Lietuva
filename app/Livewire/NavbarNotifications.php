<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarNotifications extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    public $isOpen = false;

    protected $listeners = ['refreshNotifications' => 'loadNotifications',
                            'closeDropdown' => 'closeDropdown'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
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

        // Only update in the local array without full reload
        foreach ($this->notifications as $key => $notification) {
            if ($notification['id'] === $notificationId) {
                $this->notifications[$key]['read_at'] = now()->toDateTimeString();
                break;
            }
        }

        // Update count without full reload
        $this->unreadCount = max(0, $this->unreadCount - 1);
    }

    public function markAllAsRead()
    {
        auth()->user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        // Update local data without full reload
        foreach ($this->notifications as $key => $notification) {
            if ($notification['read_at'] === null) {
                $this->notifications[$key]['read_at'] = now()->toDateTimeString();
            }
        }

        // Reset unread count
        $this->unreadCount = 0;
    }

    public function markAsReadAndNavigate($notificationId, $reservationId)
    {
        $user = auth()->user();

        // Mark notification as read
        $notification = $user->notifications()->findOrFail($notificationId);
        $notification->update(['read_at' => now()]);

        // Update local state
        foreach ($this->notifications as $key => $notification) {
            if ($notification['id'] === $notificationId) {
                $this->notifications[$key]['read_at'] = now()->toDateTimeString();
                break;
            }
        }

        // Update count without full reload
        $this->unreadCount = max(0, $this->unreadCount - 1);

        if($user->role == 'provider')
        {
            return $this->redirect(route('reservation.modify', ['id' => $reservationId]));
        } else {
            return $this->redirect(route('reservation.modifySeeker', ['id' => $reservationId]));
        }
    }

    public function render()
    {
        return view('livewire.navbar-notifications');
    }
}
