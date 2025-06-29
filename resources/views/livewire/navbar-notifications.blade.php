<div class="relative">
    <button
        wire:click="$set('isOpen', {{ !$isOpen }})"
        class="relative p-1 text-gray-700 hover:text-gray-900 focus:outline-none"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($unreadCount > 0)
            <span
                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    @if($isOpen)
        <div
            class="absolute right-0 mt-2 bg-white shadow-xl border border-gray-200 overflow-hidden z-20 w-80 rounded-3xl"
            wire:click.outside="$set('isOpen', false)"
        >
            <div class="py-2">
                <div class="px-4 py-2 font-medium border-gray-300 border-b text-primary flex justify-between items-center">
                    <span>Pranešimai</span>
                    @if($unreadCount > 0)
                        <button
                            wire:click="markAllAsRead"
                            class="text-sm text-primary-light hover:text-blue-800"
                        >
                            Viskas Perskaityta
                        </button>
                    @endif
                </div>

                <div class="max-h-64 overflow-y-auto">
                    @forelse($notifications as $notification)
                        <div
                            class="flex px-4 py-3 hover:bg-gray-100 border-b {{ is_null($notification['read_at']) ? 'bg-blue-50' : '' }}">
                            <div class="w-full">
                                @if($notification['type'] === 'reservation_requested')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">

                                        <p class="text-gray-800 text-sm flex items-center">
                                            <span class="text-green-500 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            </span>
                                            <span>
                                                Išsiuntėte naują užklausą darbui mieste {{ $notification['data']['city'] }}. Laukite patvirtinimo iš {{ $notification['data']['provider_name'] }}.
                                            </span>
                                        </p>
                                    </a>

                                @elseif($notification['type'] === 'App\\Notifications\\NewBookingNotification')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">

                                        <p class="text-gray-800 text-sm flex items-center"><span class="text-green-500 inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            </span>
                                            <span>
                                                {{ $notification['data']['notification_text'] }}
                                            </span>

                                        </p>
                                    </a>
                                @elseif($notification['type'] === 'reservation_cancelled_by_system')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">

                                        <p class="text-gray-800 text-sm flex items-center"><span class="text-green-500 inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            </span>
                                            <span>Rezervacija Nr. {{ $notification['data']['reservation_id'] }} mieste  {{$notification['data']['city']}}
                                            buvo atšaukta sistemos, kadangi paslaugų teikėjas nepriimė paslaugos per 36h.
                                            </span>

                                        </p>
                                    </a>
                                @elseif($notification['type'] === 'reservation_cancelled_by_seeker' || $notification['type'] === 'reservation_cancelled_by_provider')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                        <p class="text-gray-800 text-sm flex items-center">
                                            <span class="text-red-800 inline-flex mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </span>
                                            <span>{{ $notification['data']['notification_text'] }}</span>
                                        </p>
                                    </a>
                                @elseif($notification['type'] === 'reservation_accepted' || $notification['type'] === 'reservation_automatically_completed' || $notification['type'] === 'reservation_completed')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                        <p class="text-gray-800 text-sm flex items-center">
                                            <span class="text-green-500 inline-flex mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </span>
                                            <span>{{ $notification['data']['notification_text'] }}</span>
                                        </p>
                                    </a>
                                @elseif($notification['type'] === 'reservation_day_changed')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                        <p class="text-gray-800 text-sm flex items-center">
                                            <span class="text-yellow-500 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </span>
                                            <span>{{ $notification['data']['notification_text'] }}</span>
                                        </p>
                                    </a>
                                @elseif($notification['type'] === 'reservation_day_changed')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                        <p class="text-gray-800 text-sm flex items-center">
                                            <span class="text-yellow-500 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </span>
                                            <span>{{ $notification['data']['notification_text'] }}</span>
                                        </p>
                                    </a>
                                @elseif($notification['type'] === 'review_received')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                        <p class="text-gray-800 text-sm flex items-center">
                                            <span class="text-yellow-500 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            </span>
                                            <span>{{ $notification['data']['notification_text'] }}</span>
                                        </p>
                                    </a>
                                @elseif($notification['type'] === 'App\Notifications\MessageReceivedSeeker' || $notification['type'] === 'App\Notifications\MessageReceivedProvider')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">
                                        <p class="text-gray-800 text-sm flex items-center">
                                            <span class="text-blue-500 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                </svg>
                                            </span>
                                            <span>{{ $notification['data']['notification_text'] }}</span>
                                        </p>
                                    </a>
                                @endif
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ \Carbon\Carbon::parse($notification['created_at'])->locale('lt')->diffForHumans() }}                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-3 text-sm text-gray-500 text-center">
                            Pranešimų Nėra
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    @endif
</div>
