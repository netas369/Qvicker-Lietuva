@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h1 class="text-lg font-semibold text-gray-900">All Notifications</h1>

                    @if($notifications->count() > 0 && $notifications->where('read_at', null)->count() > 0)
                        @livewire('mark-all-notifications-read')
                    @endif
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse($notifications as $notification)
                        <div class="px-6 py-4 flex items-start {{ is_null($notification->read_at) ? 'bg-blue-50' : '' }}">
                            <div class="flex-1">
                                @if($notification->type === 'new_message')
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-gray-900">{{ $notification->data['sender_name'] }}</span>
                                        <span class="ml-2 text-sm text-gray-500">sent you a message</span>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $notification->data['content_preview'] }}</p>
                                @elseif($notification->type === 'new_reservation')
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-gray-900">{{ $notification->data['seeker_name'] }}</span>
                                        <span class="ml-2 text-sm text-gray-500">made a reservation</span>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        Service: {{ $notification->data['service_name'] }}<br>
                                        Date: {{ $notification->data['date'] }}
                                    </p>
                                @elseif($notification->type === 'reservation_accepted')
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-gray-900">{{ $notification->data['provider_name'] }}</span>
                                        <span class="ml-2 text-sm text-gray-500">accepted your reservation</span>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        Service: {{ $notification->data['service_name'] }}<br>
                                        Date: {{ $notification->data['date'] }}
                                    </p>
                                @elseif($notification->type === 'reservation_declined')
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-gray-900">{{ $notification->data['provider_name'] }}</span>
                                        <span class="ml-2 text-sm text-gray-500">declined your reservation</span>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        Service: {{ $notification->data['service_name'] }}<br>
                                        Date: {{ $notification->data['date'] }}
                                    </p>
                                @endif

                                <p class="text-xs text-gray-400 mt-2">
                                    {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                </p>
                            </div>

                            @if(is_null($notification->read_at))
                                @livewire('mark-notification-read', ['notificationId' => $notification->id], key($notification->id))
                            @endif
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-gray-500">
                            <p>You have no notifications.</p>
                        </div>
                    @endforelse
                </div>

                <div class="px-6 py-4 bg-gray-50">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
