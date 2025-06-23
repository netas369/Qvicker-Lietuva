@extends('layouts.main')

@section('title', 'El. paštas patvirtintas!')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">

            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                <svg class="h-8 w-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Success Message -->
            <h1 class="text-3xl font-bold text-primary mb-4">
                Sveikiname, {{ ucfirst($user->name) }}!
            </h1>

            <h2 class="text-xl font-semibold text-primary-light mb-6">
                Jūsų el. paštas sėkmingai patvirtintas
            </h2>

            <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                Ačiū, kad patvirtinote savo el. pašto adresą! Dabar galite naudotis visomis
                <strong class="text-primary">Qvicker</strong> platformos funkcijomis ir pradėti:
            </p>

            <!-- Features List -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                @if($user->role === 'seeker')
                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <h3 class="font-semibold text-primary">Ieškoti paslaugų</h3>
                        </div>
                        <p class="text-sm text-gray-600">Raskite reikiamas paslaugas savo mieste</p>
                    </div>

                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <h3 class="font-semibold text-primary">Rezervuoti paslaugas</h3>
                        </div>
                        <p class="text-sm text-gray-600">Lengvai užsisakyti norimas paslaugas</p>
                    </div>

                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z" />
                            </svg>
                            <h3 class="font-semibold text-primary">Susisiekti su meistrai</h3>
                        </div>
                        <p class="text-sm text-gray-600">Tiesiogiai bendrauti su paslaugų teikėjais</p>
                    </div>

                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <h3 class="font-semibold text-primary">Vertinti paslaugas</h3>
                        </div>
                        <p class="text-sm text-gray-600">Palikti atsiliepimus ir vertinimus</p>
                    </div>
                @else
                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 002 2h2a2 2 0 002-2V4a2 2 0 00-2-2h-2z" />
                            </svg>
                            <h3 class="font-semibold text-primary">Tvarkyti paslaugas</h3>
                        </div>
                        <p class="text-sm text-gray-600">Valdyti savo teikiamas paslaugas</p>
                    </div>

                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <h3 class="font-semibold text-primary">Kalendorius</h3>
                        </div>
                        <p class="text-sm text-gray-600">Planuoti savo darbo grafiką</p>
                    </div>

                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 00-2 2h-2a2 2 0 00-2-2z" />
                            </svg>
                            <h3 class="font-semibold text-primary">Statistikos</h3>
                        </div>
                        <p class="text-sm text-gray-600">Stebėti savo veiklos rezultatus</p>
                    </div>

                    <div class="bg-primary-backgroundlight bg-opacity-20 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-primary-light mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                            </svg>
                            <h3 class="font-semibold text-primary">Uždirbti</h3>
                        </div>
                        <p class="text-sm text-gray-600">Pradėti gauti užsakymus ir uždirbti</p>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <a href="{{ route('myprofile') }}"
                   class="w-full inline-block bg-primary-light text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary transition-colors duration-200">
                    Eiti į profilį
                </a>

                @if($user->role === 'seeker')
                    <a href="{{ route('landingpage') }}"
                       class="w-full inline-block bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-dark transition-colors duration-200">
                        Pradėti ieškoti paslaugų
                    </a>
                @else
                    <a href="{{ route('provider.dashboard') }}"
                       class="w-full inline-block bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-dark transition-colors duration-200">
                        Eiti į valdymo skydą
                    </a>
                @endif
            </div>

            <!-- Additional Info -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    Turite klausimų? Susisiekite su mumis:
                    <a href="mailto:info@qvicker.lt" class="text-primary-light hover:text-primary underline">info@qvicker.lt</a>
                </p>
            </div>
        </div>
    </div>
@endsection
