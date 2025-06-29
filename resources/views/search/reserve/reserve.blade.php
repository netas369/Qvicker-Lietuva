@extends('layouts.main')

@section('content')
    <div class="w-full max-w-4xl mx-auto p-2 md:p-4">
        <div class="mb-4 md:mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-primary mb-2">Rezervuoti Paslaugų Teikėją</h1>

            <!-- Search parameters summary -->
            <div class="mb-3">
                <div class="flex flex-wrap gap-1 md:gap-2 text-xs md:text-sm text-gray-600">
                    @if($subcategory)
                        <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">{{ $subcategory }}</span>
                    @endif
                    <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">{{ $city }}</span>
                    <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">
                    @if($taskSize == 'small')
                            Maža (1-2 val.)
                        @elseif($taskSize == 'medium')
                            Vidutinė (2-4 val.)
                        @else
                            Didelė (4-8 val.)
                        @endif
                </span>
                    <span class="bg-gray-100 px-2 py-0.5 md:px-3 md:py-1 rounded-full">
                    Data: {{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}
                </span>
                </div>
            </div>
        </div>

        <!-- Provider details card -->
        <div class="border rounded-lg shadow-sm overflow-hidden bg-white mb-4 md:mb-6">
            <div class="p-2 md:p-4 flex flex-row gap-2 md:gap-4">
                <!-- Provider Image -->
                <div class="w-20 h-20 md:w-36 md:h-36 flex-shrink-0">
                    @if($provider->image)
                        <img src="{{ asset('storage/' . $provider->image) }}"
                             alt="{{ $provider->name }}"
                             class="w-full h-full object-cover rounded-lg">
                    @else
                        <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-16 md:w-16 text-gray-400"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Provider Information -->
                <div class="flex-grow">
                    <!-- Name with Rating -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-1">
                        <h2 class="text-base md:text-xl font-semibold text-primary-dark">
                            {{ ucfirst($provider->name) }} {{ ucfirst($provider->lastname) }}
                        </h2>

                        <!-- Rating and Reservations - Responsive layout -->
                        <div class="flex items-center mt-1 md:mt-0 space-x-3">
                            <!-- Rating with star -->
                            <div class="flex items-center">
                                <span
                                    class="text-sm md:text-base font-medium text-gray-700">{{ number_format($provider->average_rating, 1) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4 md:h-5 md:w-5 text-yellow-400 ml-1" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>

                            <!-- Divider -->
                            <div class="h-3.5 md:h-5 w-px bg-gray-300"></div>

                            <!-- Reservation count -->
                            <div class="text-xs md:text-sm text-gray-600">
                                <span
                                    class="font-medium">{{ $provider->getTotalReservationsDone() ?? $provider->providerReservations->count() }}</span>
                                užsakymai
                            </div>
                        </div>
                    </div>

                    <!-- Age -->
                    <p class="text-xs md:text-base text-gray-600">
                        {{ \Carbon\Carbon::parse($provider->birthday)->age }} m.
                    </p>

                    <!-- About text -->
                    @if($provider->aboutme)
                        <div class="mt-1 md:mt-4">
                            <p class="text-xs md:text-base text-gray-600">
                                {{ $provider->aboutme }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Portfolio Photos Grid -->
            <div class="p-4 border-t">
                <h1 class="text-primary text-xl font-semibold mb-4">Bendras Portfolio</h1>
                @if(is_array($portfolioPhotos) && count($portfolioPhotos) > 0)
                    <div class="grid grid-cols-3 md:grid-cols-5 gap-1 md:gap-2">
                        @foreach($portfolioPhotos as $photo)
                            <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200 group">
                                <img
                                    src="{{ asset($photo['url']) }}"
                                    class="w-full h-full object-cover"
                                    alt="Portfolio"
                                    loading="lazy"
                                    onclick="openPhotoViewer('{{ asset($photo['url']) }}')"
                                >
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Reviews Section -->
            <div class="p-4 border-t">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-primary text-xl font-semibold">Atsiliepimai</h2>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <span class="font-medium">{{ $provider->reviewsReceived->where('is_approved', true)->count() }}</span>
                        <span>{{ $provider->reviewsReceived->where('is_approved', true)->count() == 1 ? 'atsiliepimas' : 'atsiliepimai' }}</span>
                    </div>
                </div>

                @if($provider->reviewsReceived->where('is_approved', true)->count() > 0)
                    <!-- Overall Rating Summary -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="text-3xl font-bold text-primary">
                                    {{ number_format($provider->average_rating, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="h-5 w-5 {{ $i <= round($provider->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        Bendras įvertinimas
                                    </div>
                                </div>
                            </div>

                            <!-- Rating Distribution (Optional - shows breakdown) -->
                            <div class="hidden md:block text-right">
                                <div class="text-sm text-gray-600">
                                    @php
                                        $approvedReviews = $provider->reviewsReceived->where('is_approved', true);
                                        $totalReviews = $approvedReviews->count();
                                    @endphp
                                    @for($rating = 5; $rating >= 1; $rating--)
                                        <div class="flex items-center space-x-2 mb-1">
                                            <span class="w-8">{{ $rating }}★</span>
                                            <div class="w-20 bg-gray-200 rounded-full h-2">
                                                @php
                                                    $ratingCount = $approvedReviews->where('rating', $rating)->count();
                                                    $percentage = $totalReviews > 0 ? ($ratingCount / $totalReviews) * 100 : 0;
                                                @endphp
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="w-6 text-xs">{{ $ratingCount }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Individual Reviews -->
                    <div class="space-y-4 max-h-96 overflow-y-auto" id="reviewsContainer">
                        @foreach($provider->reviewsReceived->where('is_approved', true)->sortByDesc('created_at')->take(10) as $review)
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center space-x-3">
                                        <!-- Reviewer Avatar -->
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-sm font-medium text-gray-600">
                                            {{ substr($review->seeker->name, 0, 1) }}{{ substr($review->seeker->lastname ?? '', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                {{ $review->seeker->name }} {{ substr($review->seeker->lastname ?? '', 0, 1) }}.
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <!-- Star Rating -->
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-sm text-gray-500">
                                                    {{ $review->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Review Comment -->
                                @if($review->comment)
                                    <div class="mt-3">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            {{ $review->comment }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Show More Reviews Button (if there are more than 10) -->
                    @if($provider->reviewsReceived->where('is_approved', true)->count() > 10)
                        <div class="mt-4 text-center" id="showMoreButton">
                            <button onclick="showAllReviews()" class="text-primary hover:text-primary-dark text-sm font-medium">
                                Rodyti visus atsiliepimus ({{ $provider->reviewsReceived->where('is_approved', true)->count() }})
                            </button>
                        </div>
                    @endif

                @else
                    <!-- No Reviews State -->
                    <div class="text-center py-8">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m10 0H7m0 0v10a2 2 0 002 2h10a2 2 0 002-2V8"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Atsiliepimų dar nėra</h3>
                        <p class="text-gray-600 text-sm">
                            Būkite pirmas, kuris palieka atsiliepimą apie šį paslaugų teikėją!
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Reservation form -->
        <div class="border rounded-lg shadow-sm overflow-hidden bg-white">
            <div class="p-3 md:p-5">
                <h3 class="text-lg md:text-xl font-semibold text-primary-dark mb-3">Užpildykite užklausos formą</h3>
                <form action="{{ route('reservation.request') }}" method="POST">
                    @csrf
                    <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="task_size" value="{{ $taskSize }}">
                    <input type="hidden" name="subcategory" value="{{ $subcategory }}">
                    <input type="hidden" name="city" value="{{ $city }}">

                    <div class="space-y-3 md:space-y-4">
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm md:text-base font-medium text-gray-700 mb-1">Aprašykite
                                užduotį:</label>
                            <textarea id="description" name="description" rows="4"
                                      class="w-full rounded-md border @error('description') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                      placeholder="Detaliai aprašykite, kokią užduotį reikia atlikti...">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm md:text-base font-medium text-gray-700 mb-1">Adresas:</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                   class="w-full rounded-md border @error('address') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                   placeholder="Įveskite tikslų adresą...">
                            @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm md:text-base font-medium text-gray-700 mb-1">Telefono
                                numeris:</label>
                            <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                             +370
                             </span>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                       class="w-full rounded-none rounded-r-md border @error('phone') border-red-500 @else border-gray-300 @enderror shadow-sm p-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                       placeholder="6XXXXXXX"
                                       pattern="[6]{1}[0-9]{7}"
                                       title="Įveskite 8 skaitmenis, prasidedančius 6">
                            </div>
                            <small class="text-gray-500 mt-1 block">Formatas: 6XXXXXXX (be +370)</small>
                            @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <small class="text-red-500">Jūsų asmeninė informacija nebus matoma ligi kol užsakymas nebus
                            patvirtintas.</small>

                        <!-- Submit button -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                    class="inline-block rounded-md bg-gradient-to-tr from-primary to-primary-light py-2 px-4 md:py-3 md:px-6 border border-transparent
                            text-center text-sm md:text-base text-white font-sans hover:from-primary-dark hover:to-primary-light transition">
                                Siųsti užklausą
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 md:mt-6">
            <a href="{{ url()->previous() }}" class="text-primary hover:text-primary-dark text-sm md:text-base">
                &larr; Grįžti į paiešką
            </a>
        </div>
    </div>
@endsection

@once
    @push('scripts')
        <script>
            function openPhotoViewer(photoUrl) {
                // Create modal overlay
                const overlay = document.createElement('div');
                overlay.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50';

                // Create image container
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative max-w-3xl mx-auto p-4';

                // Create image
                const img = document.createElement('img');
                img.src = photoUrl;
                img.className = 'max-h-[80vh] max-w-full object-contain';

                // Create close button
                const closeBtn = document.createElement('button');
                closeBtn.className = 'absolute top-2 right-2 bg-white rounded-full p-1 shadow-md';
                closeBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;

                // Close when clicking close button or overlay
                closeBtn.addEventListener('click', () => document.body.removeChild(overlay));
                overlay.addEventListener('click', (e) => {
                    if (e.target === overlay) document.body.removeChild(overlay);
                });

                // Assemble and append to body
                imgContainer.appendChild(img);
                imgContainer.appendChild(closeBtn);
                overlay.appendChild(imgContainer);
                document.body.appendChild(overlay);
            }

            function showAllReviews() {
                // Remove the max-height and show all reviews
                const reviewsContainer = document.getElementById('reviewsContainer');
                if (reviewsContainer) {
                    reviewsContainer.classList.remove('max-h-96', 'overflow-y-auto');

                    // Hide the "show more" button
                    const showMoreButton = document.getElementById('showMoreButton');
                    if (showMoreButton) {
                        showMoreButton.style.display = 'none';
                    }
                }
            }
        </script>
    @endpush
@endonce
