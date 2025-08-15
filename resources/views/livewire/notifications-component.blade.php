<div class="bg-white rounded-xl shadow-lg p-6 mx-auto md:min-w-[400px]">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
        <div class="flex items-center gap-3">
            <h3 class="text-xl font-semibold text-primary-light">Pranešimai</h3>
            @if($unreadCount > 0)
                <span class="inline-flex items-center justify-center px-2.5 py-1 text-xs font-bold text-white bg-red-500 rounded-full animate-pulse">
                    {{ $unreadCount }}
                </span>
            @endif
        </div>

        @if($unreadCount > 0)
            <button
                wire:click="markAllAsRead"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50"
                class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200 disabled:cursor-not-allowed"
            >
                <span wire:loading wire:target="markAllAsRead" class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Kraunasi...
                </span>
                <span wire:loading.remove wire:target="markAllAsRead">
                    Pažymėti visus kaip perskaitytus
                </span>
            </button>
        @endif
    </div>

    <!-- Notifications List with Infinite Scroll (Max 100 items) -->
    <div class="space-y-3 max-h-96 overflow-y-auto" id="notifications-container"
         wire:scroll="loadMore"
         x-data="{
             scrollHandler() {
                 const el = $el;
                 // Only load more if we haven't reached the limit
                 if (el.scrollTop + el.clientHeight >= el.scrollHeight - 50) {
                     @this.loadMore();
                 }
             }
         }"
         @scroll="scrollHandler">

        @if(count($notifications) >= 100)
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 mb-3 text-center">
                <p class="text-sm text-amber-700">
                    Rodomi paskutiniai 100 pranešimų. Senesnių pranešimų istorija pasiekiama archyve.
                </p>
            </div>
        @endif

        @forelse($notifications as $notification)
            @php
                $isUnread = $notification['read_at'] === null;
                $type = str_replace('App\\Notifications\\', '', $notification['type']);
            @endphp

            <div wire:key="{{ $notification['id'] }}"
                 class="group relative rounded-lg border-2 transition-all duration-200 hover:shadow-md
                        {{ $isUnread ? 'bg-blue-50 border-blue-200 hover:border-blue-300' : 'bg-white border-gray-100 hover:border-gray-200' }}">

                <!-- Unread indicator bar -->
                @if($isUnread)
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-blue-500 rounded-r"></div>
                @endif

                <button
                    wire:click="markAsReadAndNavigate('{{ $notification['id'] }}', '{{ $notification['data']['reservation_id'] ?? '' }}')"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50"
                    class="w-full p-4 flex items-start gap-3 text-left disabled:cursor-wait"
                >
                    <!-- Icon Container -->
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-transform duration-200 group-hover:scale-110
                            @if(in_array($type, ['new_message', 'MessageReceivedSeeker', 'MessageReceivedProvider']))
                                bg-blue-100
                            @elseif(in_array($type, ['NewBookingNotification', 'reservation_requested']))
                                bg-green-100
                            @elseif(in_array($type, ['reservation_accepted', 'reservation_completed', 'reservation_automatically_completed']))
                                bg-emerald-100
                            @elseif($type === 'reservation_declined')
                                bg-red-100
                            @elseif(in_array($type, ['reservation_cancelled', 'reservation_cancelled_by_seeker', 'reservation_cancelled_by_provider', 'reservation_cancelled_by_system']))
                                bg-orange-100
                            @elseif($type === 'reservation_day_changed')
                                bg-yellow-100
                            @elseif($type === 'review_received')
                                bg-purple-100
                            @else
                                bg-gray-100
                            @endif">

                            <!-- Icons based on type -->
                            @if(in_array($type, ['new_message', 'MessageReceivedSeeker', 'MessageReceivedProvider']))
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            @elseif(in_array($type, ['NewBookingNotification', 'reservation_requested']))
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            @elseif(in_array($type, ['reservation_accepted', 'reservation_completed', 'reservation_automatically_completed']))
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @elseif($type === 'reservation_declined')
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            @elseif(in_array($type, ['reservation_cancelled', 'reservation_cancelled_by_seeker', 'reservation_cancelled_by_provider', 'reservation_cancelled_by_system']))
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @elseif($type === 'reservation_day_changed')
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            @elseif($type === 'review_received')
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <p class="text-gray-800 {{ $isUnread ? 'font-semibold' : 'font-normal' }}">
                            @if($type === 'reservation_cancelled_by_system')
                                @if($user->role == 'seeker')
                                    Rezervacija Nr. {{ $notification['data']['reservation_id'] }} mieste {{ $notification['data']['city'] }}
                                    buvo atšaukta sistemos, kadangi paslaugų teikėjas nepriėmė paslaugos per 36 val.
                                @elseif($user->role == 'provider')
                                    Rezervacija Nr. {{ $notification['data']['reservation_id'] }} mieste {{ $notification['data']['city'] }}
                                    buvo atšaukta sistemos, kadangi jūs nepriėmėte paslaugos per 36 val.
                                @endif
                            @else
                                {{ $notification['data']['notification_text'] ?? 'Naujas pranešimas' }}
                            @endif
                        </p>

                        <div class="flex items-center gap-2 mt-2 text-xs">
                            <span class="text-gray-500">
                                {{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}
                            </span>
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-400">
                                {{ \Carbon\Carbon::parse($notification['created_at'])->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>

                    <!-- Arrow indicator on hover -->
                    <div class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-5 h-5 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </button>
            </div>
        @empty
            <div class="py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-sm text-gray-500">Pranešimų nėra</p>
            </div>
        @endforelse
    </div>

    @if($hasMoreNotifications && count($notifications) < 100)
        <div class="py-3 text-center">
            <svg wire:loading wire:target="loadMore" class="inline animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    @elseif(count($notifications) >= 100)
        <div class="mt-4 pt-4 border-t border-gray-200 text-center">
            <a href="{{ route('notifications.archive') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Peržiūrėti pranešimų archyvą
            </a>
        </div>
    @endif
</div>
