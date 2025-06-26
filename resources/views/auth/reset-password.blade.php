{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.main')

@section('title', 'Atkurti Slaptažodį')

@section('content')
    <div class="font-[sans-serif] max-sm:px-4">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div class="bg-white grid md:grid-cols-12 items-center gap-4 max-md:gap-8 max-w-5xl w-full p-4 m-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md">
                <div class="md:max-w-md w-full px-4 py-4 col-span-6">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-12">
                            <p class="text-primary text-3xl font-extrabold">Atkurti Slaptažodį</p>
                            <p class="text-sm mt-4 text-primary-dark">
                                Įveskite naują slaptažodį savo paskyriai.
                            </p>
                        </div>

                        <!-- Error Messages -->
                        <x-input-error :messages="$errors->get('email')" class="mb-3"/>
                        <x-input-error :messages="$errors->get('password')" class="mb-3"/>

                        <div>
                            <label class="text-primary-light text-md block font-medium">Email</label>
                            <div class="relative flex items-center">
                                <input name="email"
                                       type="email"
                                       required
                                       class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-300 placeholder-gray-500 text-md focus:outline-none focus:border-primary-light focus:bg-white mt-5"
                                       placeholder="Įveskite Email"
                                       value="{{ old('email', $request->email) }}"
                                       autofocus
                                       autocomplete="email" />
                            </div>
                        </div>

                        <div class="mt-8">
                            <label class="text-primary-light text-md block font-medium">Naujas Slaptažodis</label>
                            <div class="relative flex items-center">
                                <input name="password"
                                       type="password"
                                       required
                                       id="password"
                                       class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-md focus:outline-none focus:border-primary-light focus:bg-white mt-5"
                                       placeholder="Įveskite Naują Slaptažodį"
                                       autocomplete="new-password" />
                            </div>

                            <!-- Password Requirements -->
                            <div class="mt-3 p-3 bg-gray-50 rounded-lg border">
                                <p class="text-sm font-medium text-gray-700 mb-2">Slaptažodžio reikalavimai:</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li id="length-req" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">❌</span> Bent 8 simboliai
                                    </li>
                                    <li id="letter-req" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">❌</span> Bent viena raidė
                                    </li>
                                    <li id="case-req" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">❌</span> Didžiosios ir mažosios raidės
                                    </li>
                                    <li id="number-req" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">❌</span> Bent vienas skaičius
                                    </li>
                                    <li id="symbol-req" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">❌</span> Bent vienas specialus simbolis (!@#$%^&*)
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-8">
                            <label class="text-primary-light text-md block font-medium">Patvirtinti Slaptažodį</label>
                            <div class="relative flex items-center">
                                <input name="password_confirmation"
                                       type="password"
                                       required
                                       id="password_confirmation"
                                       class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-md focus:outline-none focus:border-primary-light focus:bg-white mt-5"
                                       placeholder="Pakartokite Naują Slaptažodį"
                                       autocomplete="new-password" />
                            </div>
                            <div id="password-match" class="mt-2 text-sm hidden">
                                <span id="match-icon" class="mr-1"></span>
                                <span id="match-text"></span>
                            </div>
                        </div>

                        <div class="mt-12">
                            <button type="submit"
                                    id="submit-btn"
                                    disabled
                                    class="mt-5 tracking-wide font-semibold bg-gray-400 text-gray-100 w-full py-3 rounded-lg transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none cursor-not-allowed">
                                Atkurti Slaptažodį
                            </button>
                        </div>
                    </form>
                </div>
                <div class="hidden md:flex w-full h-full items-center rounded-xl p-8 col-span-6">
                    <img src="{{ asset('images/login_drawing_no_bg.png') }}"
                         class="w-full aspect-[12/12] object-contain select-none pointer-events-none"
                         alt="reset-password-image"
                         draggable="false"/>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submit-btn');
            const passwordMatch = document.getElementById('password-match');
            const matchIcon = document.getElementById('match-icon');
            const matchText = document.getElementById('match-text');

            function checkPasswordRequirements(password) {
                const requirements = {
                    length: password.length >= 8,
                    letter: /[a-zA-Z]/.test(password),
                    case: /[a-z]/.test(password) && /[A-Z]/.test(password),
                    number: /\d/.test(password),
                    symbol: /[!@#$%^&*(),.?":{}|<>]/.test(password)
                };

                // Update UI for each requirement
                document.getElementById('length-req').innerHTML = `<span class="w-4 h-4 mr-2">${requirements.length ? '✅' : '❌'}</span> Bent 8 simboliai`;
                document.getElementById('letter-req').innerHTML = `<span class="w-4 h-4 mr-2">${requirements.letter ? '✅' : '❌'}</span> Bent viena raidė`;
                document.getElementById('case-req').innerHTML = `<span class="w-4 h-4 mr-2">${requirements.case ? '✅' : '❌'}</span> Didžiosios ir mažosios raidės`;
                document.getElementById('number-req').innerHTML = `<span class="w-4 h-4 mr-2">${requirements.number ? '✅' : '❌'}</span> Bent vienas skaičius`;
                document.getElementById('symbol-req').innerHTML = `<span class="w-4 h-4 mr-2">${requirements.symbol ? '✅' : '❌'}</span> Bent vienas specialus simbolis`;

                return Object.values(requirements).every(req => req);
            }

            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = passwordConfirmInput.value;

                if (confirmPassword.length > 0) {
                    passwordMatch.classList.remove('hidden');
                    if (password === confirmPassword) {
                        matchIcon.textContent = '✅';
                        matchText.textContent = 'Slaptažodžiai sutampa';
                        matchText.className = 'text-green-600';
                        return true;
                    } else {
                        matchIcon.textContent = '❌';
                        matchText.textContent = 'Slaptažodžiai nesutampa';
                        matchText.className = 'text-red-600';
                        return false;
                    }
                } else {
                    passwordMatch.classList.add('hidden');
                    return false;
                }
            }

            function updateSubmitButton() {
                const passwordValid = checkPasswordRequirements(passwordInput.value);
                const passwordsMatch = checkPasswordMatch();

                if (passwordValid && passwordsMatch) {
                    submitBtn.disabled = false;
                    submitBtn.className = 'mt-5 tracking-wide font-semibold bg-primary-light text-gray-100 w-full py-3 rounded-lg hover:bg-primary transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none cursor-pointer';
                } else {
                    submitBtn.disabled = true;
                    submitBtn.className = 'mt-5 tracking-wide font-semibold bg-gray-400 text-gray-100 w-full py-3 rounded-lg transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none cursor-not-allowed';
                }
            }

            passwordInput.addEventListener('input', updateSubmitButton);
            passwordConfirmInput.addEventListener('input', updateSubmitButton);
        });
    </script>
@endsection
