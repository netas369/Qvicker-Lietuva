<div class="bg-white rounded-xl shadow-lg p-6 mx-auto md:min-w-[400px]">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
        <div class="flex items-center gap-3">
            <h3 class="text-xl font-semibold text-primary-light">Atsiliepimai</h3>
            @if(count($userReviews) > 0)
                <span class="inline-flex items-center justify-center px-2.5 py-1 text-xs font-bold text-white bg-blue-500 rounded-full">
                    {{ count($userReviews) }}
                </span>
            @endif
        </div>

        @if(count($userReviews) > 0)
            <div class="flex items-center gap-2">
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= round($user->average_rating) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-sm font-medium text-gray-600">{{ number_format($user->average_rating, 1) }}</span>
            </div>
        @endif
    </div>

    <!-- Reviews List -->
    <div class="space-y-4 max-h-96 overflow-y-auto">
        @forelse($userReviews as $userReview)
            <div class="group relative rounded-lg border-2 bg-white border-gray-100 hover:border-gray-200 hover:shadow-md transition-all duration-200">
                <div class="p-4">
                    <!-- Review Header -->
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <!-- Avatar -->
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr($userReview->seeker->name, 0, 1) . substr($userReview->seeker->lastname ?? '', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $userReview->seeker->name }} {{ $userReview->seeker->lastname }}</p>
                                <p class="text-xs text-gray-500">{{ $userReview->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- Star rating -->
                        <div class="flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $userReview->rating ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @endfor
                            <span class="ml-1 text-sm font-medium text-gray-600">{{ $userReview->rating }}</span>
                        </div>
                    </div>

                    <!-- Review Comment -->
                    <div class="text-gray-700 text-sm leading-relaxed">
                        {{ $userReview->comment }}
                    </div>

                    <!-- Reservation info -->
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-xs text-gray-500">Rezervacija: <span class="font-medium text-gray-600">#{{ $userReview->reservation_id }}</span></p>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <p class="text-sm text-gray-500">Atsiliepimų nėra</p>
            </div>
        @endforelse
    </div>
</div>
