@extends('layouts.main')

@section('title', 'Prisijungimas')

@section('content')

    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-white to-primary-light/5 flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-4xl font-bold text-primary">
                    Sveiki sugrįžę
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Dar neturite paskyros?
                    <a href="/registruotis/" class="font-medium text-primary-light hover:text-primary transition-colors">
                        Registruokitės čia
                    </a>
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
                <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                    @csrf

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        @if ($errors->has('email'))
                                            {{ $errors->first('email') === 'These credentials do not match our records.' ? 'Neteisingas el. paštas arba slaptažodis' : $errors->first('email') }}
                                        @elseif ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                        @else
                                            Klaida prisijungiant
                                        @endif
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            El. pašto adresas
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                required
                                autofocus
                                autocomplete="email"
                                value="{{ old('email') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-light focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                                placeholder="vardas@pavyzdys.lt"
                            />
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Slaptažodis
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-light focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                                placeholder="••••••••"
                            />
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember_me"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 text-primary-light focus:ring-primary-light border-gray-300 rounded cursor-pointer"
                            />
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                                Prisiminti mane
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-primary-light hover:text-primary transition-colors">
                                Pamiršote slaptažodį?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-primary-light hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light transition-all duration-200 transform hover:scale-[1.02]"
                        >
                            <span>Prisijungti</span>
                            <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Text -->
            <p class="text-center text-xs text-gray-500">
                Prisijungdami sutinkate su mūsų
                <a href="{{route('legal.terms')}}" class="text-primary-light hover:text-primary">Naudojimo sąlygomis</a>
                ir
                <a href="{{route('legal.privacy')}}" class="text-primary-light hover:text-primary">Privatumo politika</a>
            </p>
        </div>
    </div>

@endsection
