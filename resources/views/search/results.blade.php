@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-primary mb-2">Rasti meistrai</h1>
            <div class="flex flex-wrap gap-2 text-sm text-gray-600">
                @if($subcategory)
                    <span class="bg-gray-100 px-3 py-1 rounded-full">{{ $subcategory }}</span>
                @endif
                <span class="bg-gray-100 px-3 py-1 rounded-full">{{ $city }}</span>
                <span class="bg-gray-100 px-3 py-1 rounded-full">
                @if($taskSize == 'small')
                        Maža (1-2 val.)
                    @elseif($taskSize == 'medium')
                        Vidutinė (2-4 val.)
                    @else
                        Didelė (4-8 val.)
                    @endif
            </span>
                <span class="bg-gray-100 px-3 py-1 rounded-full">{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</span>
            </div>
        </div>

        @if($availableProviders->isEmpty())
            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 text-yellow-700">
                <p>Deja, šiuo metu nėra pasiekiamų meistrų pagal jūsų paieškos kriterijus.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($availableProviders as $provider)
                    <div class="border rounded-lg shadow-sm overflow-hidden">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-primary-dark">{{ $provider->name }}</h2>
                            <p class="text-gray-600">{{ $provider->email }}</p>

                            @if($provider->phone)
                                <p class="text-gray-600">{{ $provider->phone }}</p>
                            @endif

                            <div class="mt-4">
                                <a href=""
                                   class="inline-block rounded-md bg-gradient-to-tr from-primary to-primary-light py-2 px-4 border border-transparent
                               text-center text-sm text-white font-sans hover:from-primary-dark hover:to-primary-light">
                                    Peržiūrėti profilį
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('search') }}" class="text-primary hover:text-primary-dark">
                &larr; Grįžti į paiešką
            </a>
        </div>
    </div>
@endsection
