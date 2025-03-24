<div>
    <h2 class="text-lg font-semibold text-primary mb-4">Pokalbis su {{ ucfirst($this->name()) }}</h2>

    <!-- Messages container - h-60 for mobile, h-96 for desktop -->
    <div wire:poll.5s="loadMessages"
         class="border border-gray-200 rounded-lg p-4 bg-gray-50 mb-4 h-60 md:h-96 overflow-y-auto"
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
                        {{ $message->created_at->format('H:i') }}
                        @if($message->is_read && $message->sender_type == ($this->isProvider() ? 'provider' : 'seeker'))
                            <span class="ml-1">✓</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">Pokalbis tuščias. Pradėkite bendrauti!</p>
        @endif
    </div>

    <!-- Message input -->
    <div class="mt-4">
        <div class="flex">
            <textarea wire:model="messageText"
                      wire:keydown.enter.prevent="sendMessage"
                      class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-primary"
                      rows="3"
                      placeholder="Rašykite žinutę..."></textarea>
            <button wire:click="sendMessage"
                    class="ml-2 bg-primary hover:bg-primary-dark text-white py-2 px-4 rounded-lg flex-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Script for handling auto-scrolling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to scroll to bottom
            function scrollToBottom() {
                const container = document.getElementById('messages-container');
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            }

            // Initial scroll
            scrollToBottom();

            // Listen for Livewire events
            Livewire.on('chat-updated', scrollToBottom);

            // Also handle auto-scroll when DOM updates after polling
            const observer = new MutationObserver(function(mutations) {
                scrollToBottom();
            });

            const container = document.getElementById('messages-container');
            if (container) {
                observer.observe(container, {
                    childList: true,
                    subtree: true
                });
            }
        });
    </script>
</div>
