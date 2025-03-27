<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationsComponent extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    public $page = 1;
    public $hasMoreNotifications = true;
    public $initialLoad = 5;
    public $perPage = 10;

    protected $listeners = ['refreshNotifications' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications(true);
    }

    public function loadNotifications($initial = false)
    {
        $user = auth()->user();

        if ($user) {
            // Create a base query for notifications
            $query = $user->notifications()->latest();

            // Determine how many notifications to load
            $loadCount = $initial ? $this->initialLoad : $this->perPage;
            $skipCount = $initial ? 0 : ($this->page - 1) * $this->perPage + $this->initialLoad;

            // Load notifications
            $notifications = $query
                ->skip($skipCount)
                ->take($loadCount)
                ->get()
                ->toArray();

            // Merge new notifications with existing ones if it's not the first load
            if (!$initial) {
                $this->notifications = array_merge($this->notifications, $notifications);
            } else {
                $this->notifications = $notifications;
            }

            // Check if there are more notifications to load
            $totalNotifications = $query->count();
            $this->hasMoreNotifications = $totalNotifications > count($this->notifications);

            // Update unread notifications count
            $this->unreadCount = $user->notifications()
                ->whereNull('read_at')
                ->count();

            // Reset page if initial load
            if ($initial) {
                $this->page = 1;
            }
        }
    }

    // Method to load more notifications
    public function loadMore()
    {
        $this->page++;
        $this->loadNotifications();
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->update(['read_at' => now()]);

        $this->loadNotifications();
    }

    public function markAllAsRead()
    {
        auth()->user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notifications-component');
    }
}
