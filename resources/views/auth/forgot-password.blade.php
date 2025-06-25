{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.main')

@section('title', 'Pamiršau Slaptažodį')

@section('content')
    <div class="font-[sans-serif] max-sm:px-4">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div class="bg-white grid md:grid-cols-12 items-center gap-4 max-md:gap-8 max-w-5xl w-full p-4 m-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md">
                <div class="md:max-w-md w-full px-4 py-4 col-span-6">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-12">
                            <p class="text-primary text-3xl font-extrabold">Pamiršau Slaptažodį</p>
                            <p class="text-sm mt-4 text-primary-dark">
                                Įveskite savo el. pašto adresą ir mes atsiųsime jums slaptažodžio atkūrimo nuorodą.
                            </p>
                            <p class="text-sm mt-2 text-primary-dark">
                                Prisimenu slaptažodį?
                                <a href="{{ route('login') }}" class="text-primary-light font-semibold hover:underline ml-1">
                                    Grįžti į prisijungimą
                                </a>
                            </p>
                        </div>

                        <!-- Success Message -->
                        @if (session('status'))
                            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Error Messages -->
                        <x-input-error :messages="$errors->get('email')" class="mb-3"/>

                        <div>
                            <label class="text-primary-light text-md block font-medium">Email</label>
                            <div class="relative flex items-center">
                                <input name="email"
                                       type="email"
                                       required
                                       class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-md focus:outline-none focus:border-primary-light focus:bg-white mt-5"
                                       placeholder="Įveskite Email"
                                       value="{{ old('email') }}"
                                       autofocus
                                       autocomplete="email" />
                            </div>
                        </div>

                        <div class="mt-12">
                            <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-primary-light text-gray-100 w-full py-3 rounded-lg hover:bg-primary transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                Siųsti Atkūrimo Nuorodą
                            </button>
                        </div>
                    </form>
                </div>
                <div class="hidden md:flex w-full h-full items-center rounded-xl p-8 col-span-6">
                    <img src="{{ asset('images/login_drawing_no_bg.png') }}"
                         class="w-full aspect-[12/12] object-contain select-none pointer-events-none"
                         alt="forgot-password-image"
                         draggable="false"/>
                </div>
            </div>
        </div>
    </div>
@endsection
