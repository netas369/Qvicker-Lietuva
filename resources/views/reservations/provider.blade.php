@extends('layouts.main')

@section('content')
    <x-profile-nav-tabs />


    <div class="w-full max-w-4xl mx-auto p-2 md:p-4">
        <div class="mb-4 md:mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-primary mb-2">Gautos užklausos</h1>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabs for reservation status filtering -->
            <div class="mb-4 flex overflow-x-auto">
                <a href="{{ route('reservations.provider', ['status' => 'all']) }}" class="px-4 py-2 rounded-t-lg text-sm font-medium {{ request('status', 'pending') == 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                    Visos
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'pending']) }}" class="px-4 py-2 rounded-t-lg text-sm font-medium {{ request('status', 'pending') == 'pending' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} ml-1">
                    Laukiančios
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'accepted']) }}" class="px-4 py-2 rounded-t-lg text-sm font-medium {{ request('status') == 'accepted' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} ml-1">
                    Patvirtintos
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'completed']) }}" class="px-4 py-2 rounded-t-lg text-sm font-medium {{ request('status') == 'completed' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} ml-1">
                    Užbaigtos
                </a>
                <a href="{{ route('reservations.provider', ['status' => 'declined']) }}" class="px-4 py-2 rounded-t-lg text-sm font-medium {{ request('status') == 'declined' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} ml-1">
                    Atmestos
                </a>
            </div>

            @if($reservations->isEmpty())
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <p class="text-gray-600">Jūs dar neturite gautų užklausų su šiuo statusu.</p>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="py-2 px-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                <th class="py-2 px-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Klientas</th>
                                <th class="py-2 px-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Paslauga</th>
                                <th class="py-2 px-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Statusas</th>
                                <th class="py-2 px-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach($reservations as $reservation)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-3 text-xs md:text-sm">
                                        {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}
                                    </td>
                                    <td class="py-3 px-3 text-xs md:text-sm">
                                        {{ $reservation->seeker->name }} {{ $reservation->seeker->lastname }}
                                    </td>
                                    <td class="py-3 px-3 text-xs md:text-sm">
                                        {{ $reservation->subcategory ?? 'Bendra paslauga' }}
                                        <div class="text-xs text-gray-500">
                                            @if($reservation->task_size == 'small')
                                                Maža (1-2 val.)
                                            @elseif($reservation->task_size == 'medium')
                                                Vidutinė (2-4 val.)
                                            @else
                                                Didelė (4-8 val.)
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3 px-3">
                                        @if($reservation->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Laukiama
                                            </span>
                                        @elseif($reservation->status == 'accepted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Patvirtinta
                                            </span>
                                        @elseif($reservation->status == 'declined')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Atmesta
                                            </span>
                                        @elseif($reservation->status == 'completed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Užbaigta
                                            </span>
                                        @elseif($reservation->status == 'canceled')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Atšaukta
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3 text-xs md:text-sm">
                                        <button type="button" class="text-blue-600 hover:text-blue-800" onclick="showDetails({{ $reservation->id }})">
                                            Detalės
                                        </button>

                                        @if($reservation->status == 'pending')
                                            <div class="flex mt-1 space-x-2">
                                                <form method="POST" action="{{ route('reservation.accept', $reservation->id) }}" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-800">
                                                        Patvirtinti
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('reservation.decline', $reservation->id) }}" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Ar tikrai norite atmesti šią užklausą?')">
                                                        Atmesti
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($reservation->status == 'accepted')
                                            <form method="POST" action="{{ route('reservation.complete', $reservation->id) }}" class="inline-block mt-1">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-800">
                                                    Pažymėti kaip užbaigtą
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Details section (hidden by default) -->
                                <tr id="details-{{ $reservation->id }}" class="hidden bg-gray-50">
                                    <td colspan="5" class="p-3">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            <div>
                                                <h4 class="font-medium text-sm">Užduoties aprašymas:</h4>
                                                <p class="text-sm">{{ $reservation->description }}</p>
                                            </div>

                                            @if(in_array($reservation->status, ['accepted', 'completed']))
                                                <div>
                                                    <h4 class="font-medium text-sm">Kliento kontaktinė informacija:</h4>
                                                    <p class="text-sm">Adresas: {{ $reservation->address }}</p>
                                                    <p class="text-sm">Tel. numeris: {{ $reservation->phone }}</p>
                                                    <p class="text-sm">El. paštas: {{ $reservation->seeker->email }}</p>
                                                </div>
                                            @else
                                                <div>
                                                    <h4 class="font-medium text-sm">Užsakymo informacija:</h4>
                                                    <p class="text-sm">Miestas: {{ $reservation->city }}</p>
                                                    <p class="text-sm">Rezervacijos data: {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</p>
                                                    <p class="text-sm"><em>Kliento kontaktai bus matomi po patvirtinimo</em></p>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function showDetails(id) {
            const detailsRow = document.getElementById(`details-${id}`);
            if (detailsRow.classList.contains('hidden')) {
                detailsRow.classList.remove('hidden');
            } else {
                detailsRow.classList.add('hidden');
            }
        }
    </script>
@endsection
