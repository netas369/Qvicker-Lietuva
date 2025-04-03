<div class="bg-white rounded-lg shadow p-6 mx-auto md:min-w-[400px]">
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <h3 class="text-lg font-medium text-primary-light">Pranešimai</h3>
            @if($unreadCount > 0)
                <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">
                    {{ $unreadCount }}
                </span>
            @endif
        </div>

        @if($unreadCount > 0)
            <button
                wire:click="markAllAsRead"
                class="text-xs md:text-sm text-blue-600 hover:text-blue-800"
            >
                Pažymėti visus kaip perskaitytus
            </button>
        @endif
    </div>

    <div class="space-y-4" id="notifications-container">
        @forelse($notifications as $notification)
            <div class="border-b border-gray-100 pb-4
                {{ $notification['read_at'] === null ? 'bg-blue-50 p-2 rounded-xl' : '' }}"
                 wire:key="{{ $notification['id'] }}">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        @if($notification['type'] === 'new_message')
                            <span class="text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </span>
                        @elseif($notification['type'] === 'new_reservation')
                            <span class="text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </span>
                        @elseif($notification['type'] === 'reservation_accepted' || $notification['type'] === 'reservation_declined')
                            <span class="text-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                        @endif
                    </div>
                    <div class="flex-1">
                        @if($notification['type'] === 'new_message')
                            <p class="text-gray-800">
                                You have received a new message from {{ $notification['data']['sender_name'] }}
                            </p>
                        @elseif($notification['type'] === 'new_reservation')
                            <a href="javascript:void(0)"
                               class="block hover:bg-gray-50"
                               wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                <p class="text-gray-800">
                                    {{ $notification['data']['seeker_name'] }} atsiuntė naują užklausą darbui
                                    mieste {{ $notification['data']['city'] }}
                                </p>
                            </a>
                        @elseif($notification['type'] === 'reservation_accepted')
                            <p class="text-gray-800">
                                {{ $notification['data']['provider_name'] }} accepted your reservation
                            </p>
                        @elseif($notification['type'] === 'reservation_declined')
                            <p class="text-gray-800">
                                {{ $notification['data']['provider_name'] }} declined your reservation
                            </p>
                        @endif
                        <p class="text-sm text-gray-500 mt-1">
                            {{ \Carbon\Carbon::parse($notification['created_at'])->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-sm text-gray-500 text-center py-4">
                Pranešimų nėra
            </div>
        @endforelse
    </div>

    @if($hasMoreNotifications)
        <div class="mt-4 text-center">
            <button
                wire:click="loadMore"
                class="text-sm text-blue-600 hover:text-blue-800"
            >
                Peržiūrėti daugiau pranešimų
            </button>
        </div>
    @endif
</div>
