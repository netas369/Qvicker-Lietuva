<div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-primary-light mb-4">Naujausios Žinutės</h3>

        @if(empty($messages) || $messages->isEmpty())
            <div class="text-sm text-gray-500 text-center py-4">
                Šiuo metu pranešimų neturite.
            </div>
        @else
            <div class="space-y-3">
                @foreach($messages as $message)
                    <a href="
                    @if($user->role == 'provider')
                    {{ route('reservation.modify', ['id' => $message->reservation_id]) }}
                    @else
                    {{ route('reservation.modifySeeker', ['id' => $message->reservation_id]) }}
                    @endif
                    "
                       class="block hover:bg-gray-50 rounded-md transition duration-150"
                       wire:navigate>
                        <div class="pb-3 border-b border-gray-100" wire:key="{{ $message->id }}">
                            <div class="flex items-start gap-3 p-2">
                                <div class="text-green-500 flex-shrink-0 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-gray-900">{{ $message->sender_name ?? 'Unknown User' }}</span>
                                        <span class="mx-1 text-gray-500">·</span>
                                        <span class="text-sm text-gray-500">ID: {{ $message->reservation_id }}</span>
                                    </div>
                                    <p class="text-gray-800 break-words line-clamp-2">{{$message->message}}</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                @if(!$message->is_read)
                                    <div class="ml-2 flex-shrink-0">
                                        <span class="text-sm text-blue-600 font-medium">Nauja</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        @endif
    </div>
</div>
