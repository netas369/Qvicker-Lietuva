<div>
    <h2 class="text-lg font-semibold text-primary mb-4">Pokalbis su {{ ucfirst($this->name()) }}</h2>

    <!-- Messages container - Reduced polling frequency and optimized -->
    <div wire:poll.15s="loadNewMessages"
         class="border border-gray-200 rounded-lg p-4 bg-gray-50 mb-4 h-60 md:h-96 overflow-y-auto scroll-smooth"
         id="messages-container">

        @if(count($messages) > 0)
            @foreach($messages as $message)
                <div class="mb-3 {{ $message->sender_type == ($this->isProvider() ? 'provider' : 'seeker') ? 'text-right' : 'text-left' }}">
                    <span class="inline-block rounded-lg px-3 py-2
                        {{ $message->sender_type == ($this->isProvider() ? 'provider' : 'seeker')
                            ? 'bg-primary text-white'
                            : 'bg-gray-200 text-gray-800' }}">
                        {{ $message->message }}
                    </span>
                    <div class="text-xs text-gray-500 mt-1">
                        {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}
                        @if($message->is_read && $message->sender_type == ($this->isProvider() ? 'provider' : 'seeker'))
                            <span class="ml-1">✓</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            @if($reservation->status == 'completed')
                <p class="text-center text-gray-500">Pokalbis uždarytas. Paslauga atlikta!</p>
            @elseif($reservation->status == 'declined')
                <p class="text-center text-gray-500">Rezervacija atšaukta. Pokalbis uždarytas!</p>
            @else
                <p class="text-center text-gray-500">Pokalbis tuščias. Pradėkite bendrauti!</p>
            @endif
        @endif
    </div>

    @if($reservation->status !== 'completed' && $reservation->status !== 'declined')
        <!-- Message input with loading state -->
        <div class="mt-4">
            @if(session('chat_error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-2 text-sm">
                    {{ session('chat_error') }}
                </div>
            @endif

            <div class="flex">
                <textarea wire:model="messageText"
                          wire:keydown.enter.prevent="sendMessage"
                          class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-primary disabled:opacity-50"
                          rows="3"
                          placeholder="Rašykite žinutę..."
                          {{ $sending ? 'disabled' : '' }}></textarea>
                <button wire:click="sendMessage"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        wire:target="sendMessage"
                        class="ml-2 bg-primary hover:bg-primary-dark text-white py-2 px-4 rounded-lg flex-none disabled:opacity-50 disabled:cursor-not-allowed transition-opacity">

                    <!-- Loading spinner -->
                    <span wire:loading.remove wire:target="sendMessage">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </span>

                    <!-- Show spinner when loading -->
                    <span wire:loading wire:target="sendMessage">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    @endif

    <!-- Optimized auto-scroll script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('messages-container');
            if (!container) return;

            let isUserScrolling = false;
            let scrollTimeout;

            // Optimized scroll to bottom function
            function scrollToBottom() {
                if (!isUserScrolling) {
                    container.scrollTo({
                        top: container.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            }

            // Detect user manual scrolling
            container.addEventListener('scroll', function() {
                isUserScrolling = true;
                clearTimeout(scrollTimeout);

                // Reset flag after user stops scrolling
                scrollTimeout = setTimeout(function() {
                    isUserScrolling = false;
                }, 1000);
            });

            // Initial scroll
            setTimeout(scrollToBottom, 100);

            // Listen for Livewire chat updates
            document.addEventListener('livewire:init', function() {
                Livewire.on('chat-updated', function() {
                    setTimeout(scrollToBottom, 100);
                });
            });
        });
    </script>
</div>
