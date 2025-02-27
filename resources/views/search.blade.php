@extends('layouts.main')

@section('content')
    <form class="max-w-sm mx-auto" method="POST" action="{{ route('search.results') }}">
        @csrf

        @if(isset($subcategory))
            <input type="hidden" name="subcategory" value="{{ $subcategory }}">
        @endif

        @if(isset($subcategoryId))
            <input type="hidden" name="subcategory_id" value="{{ $subcategoryId }}">
        @endif

        <div class="mb-5 mt-24">
            <label for="address" class="block mb-2 text-lg font-medium text-primary-light font-sans">Kategorija</label>
            <input
                type="text"
                id="address"
                class="bg-gray-200 border border-primary text-gray-600 font-medium placeholder-primary-light text-sm rounded-lg block w-full p-2.5"
                disabled
                value="{{ $subcategory ?? '' }}">
        </div>

        <div class="mb-5 mt-10">
            <label for="date" class="block mb-2 text-lg font-medium text-primary-light font-sans">Kada reikia paslaugos?</label>
            <input
                type="date"
                id="date"
                name="date"
                class="bg-white border border-primary text-gray-600 font-medium text-sm rounded-lg block w-full p-2.5"
                value="{{ date('Y-m-d') }}"
                min="{{ date('Y-m-d') }}">
            @error('date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5 mt-10">
            <label class="block mb-2 text-lg font-medium text-primary-light font-sans">Kokiame mieste reikia paslaugos?</label>
            <div class="flex flex-col space-y-2">
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="city"
                        value="Vilnius"
                        class="w-5 h-5 text-primary-light focus:ring-green-100 border-primary-light">
                    <span class="ml-2 text-primary">Vilnius</span>
                </label>
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="city"
                        value="Kaunas"
                        class="w-5 h-5 text-primary-light focus:ring-green-100 border-primary-light">
                    <span class="ml-2 text-primary">Kaunas</span>
                </label>
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="city"
                        value="Klaipėda"
                        class="w-5 h-5 text-primary-light focus:ring-green-100 border-primary-light">
                    <span class="ml-2 text-primary">Klaipėda</span>
                </label>
            </div>
            @error('city')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5 mt-10">
            <label class="block mb-2 text-lg font-medium text-primary-light font-sans">Kokio dydžio yra užduotis?</label>
            <div class="flex flex-col space-y-2">
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="task_size"
                        value="small"
                        class="w-5 h-5 text-primary-light focus:ring-green-100 border-primary-light">
                    <span class="ml-2 text-primary">Maža (1-2 val.)</span>
                </label>
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="task_size"
                        value="medium"
                        class="w-5 h-5 text-primary-light focus:ring-green-100 border-primary-light">
                    <span class="ml-2 text-primary">Vidutinė (2-4 val.)</span>
                </label>
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="task_size"
                        value="big"
                        class="w-5 h-5 text-primary-light focus:ring-green-100 border-primary-light">
                    <span class="ml-2 text-primary">Didelė (4-8 val.)</span>
                </label>
            </div>
            @error('task_size')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Search Button -->
        <div class="mt-10">
            <button class="rounded-md bg-gradient-to-tr from-primary to-primary-light py-2 px-14 border border-transparent text-center
            text-md text-white font-sans hover:from-primary-dark hover:to-primary-light" type="submit" aria-label="Search">
                Ieškoti
            </button>
        </div>
    </form>
@endsection
