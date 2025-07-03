{{-- resources/views/errors/403.blade.php --}}
@extends('layouts.main')

@section('title', 'Prieiga uždrausta - 403')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center px-4">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Animated 403 -->
            <div class="relative mb-8">
                <h1 class="text-9xl md:text-[12rem] font-bold text-red-600 opacity-20 select-none">403</h1>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-white rounded-full p-8 shadow-xl">
                        <svg class="w-24 h-24 text-red-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Prieiga uždrausta
                </h2>
                <p class="text-lg text-gray-600 mb-8">
                    Atsiprašome, bet neturite teisės prisijungti prie šio puslapio.
                    Jums gali reikėti prisijungti arba šis puslapis skirtas tik tam tikriems vartotojams.
                </p>

                <!-- Action Cards -->
                <div class="grid md:grid-cols-2 gap-4 mb-8">
                    <a href="{{ route('landingpage') }}"
                       class="group p-6 bg-primary text-white rounded-xl hover:bg-primary-dark transition-all duration-300 transform hover:scale-105">
                        <div class="flex items-center justify-center mb-3">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="font-semibold mb-2">Pagrindinis puslapis</h3>
                        <p class="text-sm opacity-90">Grįžti į pagrindinį puslapį</p>
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                           class="group p-6 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-center justify-center mb-3">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <h3 class="font-semibold mb-2">Prisijungti</h3>
                            <p class="text-sm opacity-90">Prisijunkite prie savo paskyros</p>
                        </a>
                    @else
                        <button onclick="history.back()"
                                class="group p-6 bg-gray-100 text-gray-800 rounded-xl hover:bg-gray-200 transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-center justify-center mb-3">
                                <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>
                            <h3 class="font-semibold mb-2">Grįžti atgal</h3>
                            <p class="text-sm">Grįžti į ankstesnį puslapį</p>
                        </button>
                    @endguest
                </div>

                <!-- Info Element -->
                <div class="text-center">
                    <p class="text-red-600 text-sm">
                        🔒 <strong>Informacija:</strong> Jei manote, kad tai klaida, susisiekite su administratoriais
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
@endsection
