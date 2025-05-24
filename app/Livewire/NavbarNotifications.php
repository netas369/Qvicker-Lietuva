<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Notifications\DatabaseNotification;

class NavbarNotifications extends Component
{
    public array $notifications = [];
    public int $unreadCount = 0;
    public bool $isOpen = false;

    private const CACHE_TTL = 60; // seconds
    private const NOTIFICATIONS_LIMIT = 5;

    protected $listeners = [
        'refreshNotifications' => 'loadNotifications',
        'closeDropdown' => 'closeDropdown'
    ];

    public function mount(): void
    {
        $this->loadNotifications();
    }

    public function closeDropdown(): void
    {
        $this->isOpen = false;
    }

    private function getCacheKey(string $type): string
    {
        return "user_" . auth()->id() . "_{$type}";
    }

    public function loadNotifications(): void
    {
        $startTime = microtime(true);
        
        $user = auth()->user();

        if ($user) {
            $this->notifications = cache()->remember(
                $this->getCacheKey('notifications'),
                self::CACHE_TTL,
                fn() => $user->notifications()
                    ->latest()
                    ->take(self::NOTIFICATIONS_LIMIT)
                    ->get()
                    ->toArray()
            );

            $this->unreadCount = cache()->remember(
                $this->getCacheKey('unread_count'),
                self::CACHE_TTL,
                fn() => $user->notifications()
                    ->whereNull('read_at')
                    ->count()
            );
        }

        $executionTime = (microtime(true) - $startTime) * 1000;
        \Log::info("Notification load time: {$executionTime}ms");
    }

    public function toggleDropdown(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    public function markAsRead(string $notificationId): void
    {
        $user = auth()->user();
        $notification = $user->notifications()->findOrFail($notificationId);
        $notification->update(['read_at' => now()]);

        $this->clearCache();
        $this->updateLocalNotification($notificationId);
        $this->unreadCount = max(0, $this->unreadCount - 1);
    }

    public function markAllAsRead(): void
    {
        $user = auth()->user();
        $user->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        $this->clearCache();
        $this->updateAllLocalNotifications();
        $this->unreadCount = 0;
    }

    public function markAsReadAndNavigate(string $notificationId, string $reservationId): mixed
    {
        $user = auth()->user();

        try {
            $notification = $user->notifications()->findOrFail($notificationId);
            $notification->update(['read_at' => now()]);

            $this->clearCache();
            $this->updateLocalNotification($notificationId);
            $this->unreadCount = max(0, $this->unreadCount - 1);

            return $this->redirect(
                $user->role === 'provider'
                    ? route('reservation.modify', ['id' => $reservationId])
                    : route('reservation.modifySeeker', ['id' => $reservationId])
            );
        } catch (\Exception $e) {
            \Log::error("Error marking notification as read: " . $e->getMessage());
            return $this->redirect(route('dashboard'));
        }
    }

    private function clearCache(): void
    {
        $user = auth()->user();
        cache()->forget($this->getCacheKey('notifications'));
        cache()->forget($this->getCacheKey('unread_count'));
    }

    private function updateLocalNotification(string $notificationId): void
    {
        foreach ($this->notifications as $key => $notification) {
            if ($notification['id'] === $notificationId) {
                $this->notifications[$key]['read_at'] = now()->toDateTimeString();
                break;
            }
        }
    }

    private function updateAllLocalNotifications(): void
    {
        foreach ($this->notifications as $key => $notification) {
            if ($notification['read_at'] === null) {
                $this->notifications[$key]['read_at'] = now()->toDateTimeString();
            }
        }
    }

    public function render()
    {
        return view('livewire.navbar-notifications');
    }
}
