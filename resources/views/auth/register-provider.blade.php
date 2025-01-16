@extends('layouts.main')

@section('content')

    <div class="flex items-center justify-center">
        <div class="w-full max-w-6xl px-4">
            <div class="flex items-center justify-center mt-10 mb-10">
                <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 sm:text-base">
                    <li class="flex md:w-full items-center text-primary-light sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200">
                            <span class="flex items-center justify-center w-3.5 h-3.5 sm:w-4 sm:h-4 text-white bg-primary-light rounded-full text-xs mr-2">1</span>

                        Asmeninė <span class="hidden sm:inline-flex sm:ms-2">Info</span>
                        </span>
                    </li>
                    <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200">
                        <span class="me-2">2</span>
                        Jūsų <span class="hidden sm:inline-flex sm:ms-2">Įgūdžiai</span>
                        </span>
                    </li>
                    <li class="flex items-center">
                        <span class="me-2">3</span>
                        Patvirtinimas
                    </li>
                </ol>
            </div>
        </div>
    </div>


    <div class="font-[sans-serif] max-sm:px-4">
        <div class="mt-5 flex items-center justify-center">
                <div class="md:max-w-3xl w-full px-4 py-4 bg-white rounded-xl shadow-2xl">

                    <form method="POST" action="{{ route('register.provider.processStep1') }}">
                        @csrf
                        <h3 class="mb-8 text-2xl leading-none font-bold text-primary">Asmeninės Detalės</h3>
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Vardas</label>
                                <input type="text" name="name" id="name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="Vardas"
                                       value="{{ old('name') }}">
                                @error('name')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">Pavardė</label>
                                <input type="text" name="lastname" id="lastname"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="Pavardė"
                                       value="{{ old('lastname') }}">
                                @error('lastname')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900">Gimimo Data</label>
                                <input type="date" name="birthday" id="birthday"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="Birthday"
                                       value="{{ old('birthday') }}">
                                @error('birthday')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="text" name="email" id="email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="Email"
                                       value="{{ old('email') }}">
                                @error('email')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="miestas" class="block mb-2 text-sm font-medium text-gray-900">Miestas</label>
                                <input type="text" name="miestas" id="miestas"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="Miestas"
                                       value="{{ old('miestas') }}">
                                @error('miestas')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="adresas" class="block mb-2 text-sm font-medium text-gray-900">Adresas</label>
                                <input type="text" name="adresas" id="adresas"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="Adresas"
                                       value="{{ old('adresas') }}">
                                @error('adresas')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Slaptažodis</label>
                                <input type="password" name="password" id="password"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="•••••••••">
                                @error('password')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Patvirtinti Slaptažodį</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                       placeholder="•••••••••">
                                @error('password_confirmation')
                                <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="text-white bg-primary-light hover:bg-primary transition focus:ring-4 focus:outline-none focus:ring-primary-dark font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Kitas: Jūsų Įgudžiai
                        </button>
                    </form>
                </div>
        </div>
    </div>
@endsection
