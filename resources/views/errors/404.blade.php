{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.main')

@section('title', 'Puslapis nerastas - 404')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-backgroundlight to-primary-backgrounddark flex items-center justify-center px-4">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Animated 404 -->
            <div class="relative mb-8">
                <h1 class="text-9xl md:text-[12rem] font-bold text-primary opacity-20 select-none">404</h1>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-white rounded-full p-8 shadow-xl">
                        <svg class="w-24 h-24 text-primary animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Ups! Pamestas puslapis
                </h2>
                <p class="text-lg text-gray-600 mb-8">
                    Atrodo, kad puslapis, kurio ieškote, iškeliavo į nežinomybę.
                    Bet nesijaudinkite - mes padėsime jums rasti kelią namo!
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
                </div>

                <!-- Fun Element -->
                <div class="text-center">
                    <p class="text-primary-dark text-sm">
                        💡 <strong>Patarimas:</strong> Patikrinkite URL adresą arba naudokite navigacijos meniu
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
@endsection
