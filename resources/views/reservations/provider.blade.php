@extends('layouts.main')

@section('content')
    <x-profile-nav-tabs />


    <div class="w-full max-w-3xl mx-auto p-4 md:p-6">
        <!-- Navigation tabs -->
        <div class="mb-8 border-b border-gray-200 flex overflow-x-auto">
            <div class="flex space-x-8">
                <a href="{{ route('reservations.provider', ['status' => 'all']) }}"
                   class="py-4 px-1 {{ request('status', 'all') == 'all' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Visos
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'pending']) }}"
                   class="py-4 px-1 {{ request('status') == 'pending' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Laukiančios
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'accepted']) }}"
                   class="py-4 px-1 {{ request('status') == 'accepted' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Patvirtintos
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'completed']) }}"
                   class="py-4 px-1 {{ request('status') == 'completed' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Užbaigtos
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'declined']) }}"
                   class="py-4 px-1 {{ request('status') == 'declined' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                    Atmestos
                </a>
            </div>
        </div>

        <div class="my-4 ">
            {{ $reservations->links() }}
        </div>

        @if($reservations->isEmpty())
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                <p class="text-gray-600">Jūs dar neturite gautų užklausų su šiuo statusu.</p>
            </div>
        @else
            <!-- Reservation cards -->
            <div class="space-y-6">
                @foreach($reservations as $reservation)
                    <a href="{{ route('reservation.modify', $reservation->id) }}" class="block">
                        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <!-- Left side: Client info -->
                                <div class="w-full md:w-1/3 flex items-center mb-4 md:mb-0">
                                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-xl font-bold text-white overflow-hidden">
                                        @if($reservation->seeker->image)
                                            <img src="{{ asset('storage/' . $reservation->seeker->image) }}" alt="{{ ucfirst($reservation->seeker->name) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($reservation->seeker->name, 0, 1) }}{{ substr($reservation->seeker->lastname, 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-primary">{{ ucfirst($reservation->seeker->name) }}</h3>
                                        <div class="text-primary text-sm">
                                            {{ $reservation->id }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Middle: Reservation details -->
                                <div class="w-full md:w-1/3 mb-4 md:mb-0 px-4">
                                    <div class="text-gray-800">
                                        {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }}
                                        @if(isset($reservation->time))
                                            ({{ $reservation->time }})
                                        @endif
                                    </div>
                                    <div class="text-gray-600">
                                        {{ $reservation->subcategory ?? 'Bendra paslauga' }}
                                    </div>
                                    <div class="text-gray-600">
                                        {{ $reservation->city }}
                                    </div>
                                </div>

                                <!-- Right: Price and status -->
                                <div class="w-full md:w-1/3 flex md:justify-end">
                                    <div>
                                        @if($reservation->status == 'pending')
                                            <span class="text-amber-500 font-medium">Laukiama</span>
                                        @elseif($reservation->status == 'accepted')
                                            <span class="text-green-600 font-medium">Patvirtinta</span>
                                        @elseif($reservation->status == 'completed')
                                            <span class="text-blue-600 font-medium">Užbaigta</span>
                                        @elseif($reservation->status == 'declined')
                                            <span class="text-red-600 font-medium">Atmesta</span>
                                        @else
                                            <span class="text-primary">Diskusija</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        <div class="mt-4">
            {{ $reservations->links() }}
        </div>
    </div>
@endsection
