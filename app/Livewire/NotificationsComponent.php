<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NotificationsComponent extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    public $page = 1;
    public $hasMoreNotifications = true;
    public $initialLoad = 5;
    public $perPage = 10;
    public $totalNotifications = 0;

    protected $listeners = ['refreshNotifications' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications(true);
    }

    public function loadNotifications($initial = false)
    {
        $user = auth()->user();

        if ($user) {
            // Reset to first page if initial load
            if ($initial) {
                $this->page = 1;
                $this->notifications = [];
            }

            // Get total count once (can be expensive for large datasets)
            if ($this->totalNotifications === 0 || $initial) {
                $this->totalNotifications = $user->notifications()->count();
            }

            // Create a base query for notifications
            $query = $user->notifications()->latest();

            // Determine how many notifications to load and how many to skip
            $loadCount = $initial ? $this->initialLoad : $this->perPage;
            $skipCount = $initial ? 0 : $this->initialLoad + ($this->page - 2) * $this->perPage;

            // Load notifications
            $newNotifications = $query
                ->skip($skipCount)
                ->take($loadCount)
                ->get()
                ->toArray();

            // Merge or set notifications
            if ($initial) {
                $this->notifications = $newNotifications;
            } else {
                $this->notifications = array_merge($this->notifications, $newNotifications);
            }

            // Check if there are more notifications to load
            $this->hasMoreNotifications = $this->totalNotifications > count($this->notifications);

            // Update unread notifications count
            $this->unreadCount = $user->notifications()
                ->whereNull('read_at')
                ->count();
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

    public function render()
    {
        return view('livewire.notifications-component');
    }
}
