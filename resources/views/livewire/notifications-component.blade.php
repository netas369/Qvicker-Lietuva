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
                        @elseif($notification['type'] === 'new_reservation' || $notification['type'] === 'reservation_requested')
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
                        @elseif($notification['type'] === 'reservation_cancelled' || $notification['type'] === 'reservation_cancelled_by_seeker' || $notification['type'] === 'reservation_cancelled_by_provider')
                            <span class="text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                        @elseif($notification['type'] === 'reservation_accepted')
                            <span class="text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                        @elseif($notification['type'] === 'reservation_day_changed')
                            <span class="text-yellow-500 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </span>
                        @endif
                    </div>
                    <div class="flex-1">
                        @if($notification['type'] === 'reservation_requested')
                            <a href="javascript:void(0)"
                               class="block hover:bg-gray-50"
                               wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                <p class="text-gray-800 ">
                                    {{ $notification['data']['notification_text'] }}
                                </p>
                            </a>
                        @elseif($notification['type'] === 'new_reservation')
                            <a href="javascript:void(0)"
                               class="block hover:bg-gray-50"
                               wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                <p class="text-gray-800">
                                    {{ $notification['data']['notification_text'] }}
                                </p>
                            </a>
                        @elseif($notification['type'] === 'reservation_cancelled_by_system')
                            <a href="javascript:void(0)"
                               class="block hover:bg-gray-50"
                               wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                @if($user->role == 'seeker')
                                <p class="text-gray-800 text-md">
                                    Rezervacija Nr. {{ $notification['data']['reservation_id'] }} mieste  {{$notification['data']['city']}}
                                    buvo atšaukta sistemos, kadangi paslaugų teikėjas nepriėmė paslaugos per 36 val.
                                </p>
                                @elseif($user->role == 'provider')
                                    <p class="text-gray-800 text-md">
                                        Rezervacija Nr. {{ $notification['data']['reservation_id'] }} mieste  {{$notification['data']['city']}}
                                        buvo atšaukta sistemos, kadangi jūs nepriėmėtė paslaugos per 36val.
                                    </p>
                                @endif
                            </a>
                        @elseif($notification['type'] === 'reservation_cancelled_by_seeker' || $notification['type'] === 'reservation_cancelled_by_provider')
                            <a href="javascript:void(0)"
                               class="block hover:bg-gray-50"
                               wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                    <p class="text-gray-800 text-md">
                                        {{ $notification['data']['notification_text'] }}
                                    </p>
                            </a>
                        @elseif($notification['type'] === 'reservation_accepted')
                            <a href="javascript:void(0)"
                               class="block hover:bg-gray-50"
                               wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                <p class="text-gray-800 text-md">
                                    {{ $notification['data']['notification_text'] }}
                                </p>
                            </a>
                        @elseif($notification['type'] === 'reservation_day_changed')
                            <a href="javascript:void(0)"
                               class="block hover:bg-gray-50"
                               wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                <p class="text-gray-800 text-md">
                                    {{ $notification['data']['notification_text'] }}
                                </p>
                            </a>
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
