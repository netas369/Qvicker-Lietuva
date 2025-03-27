<div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="col-span-2">

        <!-- Success Message -->
        @if(session()->has('message'))
            <div class="mt-1 p-3 bg-green-100 text-green-700 rounded-lg mb-4">
                {{ session('message') }}
            </div>
        @endif

            @if($user->role == 'provider' && $reviewIsLeft)
            <h1 class="text-center text-primary text-xl font-semibold">Gavote Atsiliepimą</h1>
            @elseif(!$reviewIsLeft)
                <h1 class="text-center text-primary text-xl font-semibold">Palikite Atsiliepimą</h1>
            @else
                <h1 class="text-center text-primary text-xl font-semibold">Jūsų Atsiliepimas</h1>
            @endif

    </div>

    <div class="col-span-2">
        <!-- Star Rating -->
        <div class="flex justify-center mt-4">
            <div class="star-rating">
                <div class="flex items-center space-x-1">
                    @if(!$reviewIsLeft)
                        <!-- Editable stars -->
                        <button type="button" wire:click="setRating(1)" class="focus:outline-none">
                            <span class="text-3xl cursor-pointer {{ $rating >= 1 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        </button>

                        <button type="button" wire:click="setRating(2)" class="focus:outline-none">
                            <span class="text-3xl cursor-pointer {{ $rating >= 2 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        </button>

                        <button type="button" wire:click="setRating(3)" class="focus:outline-none">
                            <span class="text-3xl cursor-pointer {{ $rating >= 3 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        </button>

                        <button type="button" wire:click="setRating(4)" class="focus:outline-none">
                            <span class="text-3xl cursor-pointer {{ $rating >= 4 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        </button>

                        <button type="button" wire:click="setRating(5)" class="focus:outline-none">
                            <span class="text-3xl cursor-pointer {{ $rating >= 5 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        </button>
                    @else
                        <!-- Read-only stars -->
                        <span class="text-3xl {{ $rating >= 1 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        <span class="text-3xl {{ $rating >= 2 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        <span class="text-3xl {{ $rating >= 3 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        <span class="text-3xl {{ $rating >= 4 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        <span class="text-3xl {{ $rating >= 5 ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Feedback text area - conditionally shown -->
        @if($showFeedbackField)
            <div class="mt-6 w-full">
                @if(!$reviewIsLeft)
                    <!-- Editable feedback form -->
                    <form wire:submit.prevent="submitFeedback" class="flex flex-col items-center">
                    <textarea
                        wire:model.defer="feedbackText"
                        rows="4"
                        class="w-2/3 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="Parašykite savo atsiliepimą čia..."></textarea>

                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                                Pateikti
                            </button>
                        </div>
                    </form>
                @else
                    <!-- Read-only feedback display -->
                    @if($feedbackText)
                    <div class="flex justify-center">
                        <div class="w-2/3 p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-700">
                            {{ $feedbackText }}
                        </div>
                    </div>
                    @endif
                    <div class="mt-2 text-sm text-gray-500 italic text-right">
                        Atsiliepimas pateiktas {{ $feedbackCreatedAt }}
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>
