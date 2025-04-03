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
                                @if($notification['type'] === 'new_message')
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $notification['data']['sender_name'] }} sent you a message
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $notification['data']['content_preview'] }}</p>


                                @elseif($notification['type'] === 'new_reservation')
                                    <a href="javascript:void(0)"
                                       class="block"
                                       wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] }}')">

                                        <p class="text-gray-800 text-sm"><span class="text-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            </span>
                                            {{ $notification['data']['seeker_name'] }} atsiuntė naują užklausą darbui
                                            mieste {{ $notification['data']['city'] }}
                                        </p>
                                    </a>

                                @elseif(str_contains($notification['type'], 'reservation_'))
                                    <p class="text-sm font-medium text-gray-900">
                                        Reservation {{ str_contains($notification['type'], 'accepted') ? 'accepted' : 'declined' }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $notification['data']['provider_name'] }}
                                        has {{ str_contains($notification['type'], 'accepted') ? 'accepted' : 'declined' }}
                                        your reservation</p>
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
