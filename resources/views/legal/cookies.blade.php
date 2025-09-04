{{-- resources/views/legal/cookies.blade.php --}}
@extends('layouts.main')

@section('title', 'Slapukų politika')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Slapukų politika</h1>

            <div class="prose prose-lg max-w-none">
                <p class="text-gray-600 mb-6">
                    <strong>Paskutinis atnaujinimas:</strong> {{ date('Y-m-d') }}
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Kas yra slapukai?</h2>
                <p class="text-gray-700 mb-6">
                    Slapukai (angl. cookies) yra maži tekstiniai failai, kuriuos svetainė išsaugo jūsų kompiuteryje ar mobiliajame įrenginyje, kai lankotės svetainėje. Jie padeda svetainei prisiminti informaciją apie jūsų apsilankymą.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Kokius slapukus naudojame?</h2>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">1. Būtini slapukai</h3>
                <p class="text-gray-700 mb-4">
                    Šie slapukai yra būtini svetainės veikimui ir negali būti išjungti mūsų sistemoje.
                </p>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 font-semibold text-gray-900">Slapuko pavadinimas</th>
                            <th class="text-left py-2 font-semibold text-gray-900">Paskirtis</th>
                            <th class="text-left py-2 font-semibold text-gray-900">Trukmė</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-mono text-primary">{{ config('session.cookie', 'laravel_session') }}</td>
                            <td class="py-2 text-gray-700">Saugo sesijos informaciją (prisijungimas, forma duomenys)</td>
                            <td class="py-2 text-gray-700">{{ round(config('session.lifetime') / (60 * 24)) }} dienų</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-mono text-primary">XSRF-TOKEN</td>
                            <td class="py-2 text-gray-700">Apsaugo nuo CSRF atakų (saugumo tikslais)</td>
                            <td class="py-2 text-gray-700">{{ round(config('session.lifetime') / (60 * 24)) }} dienų</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">2. Funkcionalūs slapukai</h3>
                <p class="text-gray-700 mb-4">
                    Šie slapukai pagerina svetainės funkcionalumą ir patogumą.
                </p>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 font-semibold text-gray-900">Slapuko pavadinimas</th>
                            <th class="text-left py-2 font-semibold text-gray-900">Paskirtis</th>
                            <th class="text-left py-2 font-semibold text-gray-900">Trukmė</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-mono text-primary">remember_web_*</td>
                            <td class="py-2 text-gray-700">„Prisiminti mane" funkcija prisijungimo metu</td>
                            <td class="py-2 text-gray-700">{{ round(config('auth.guards.web.remember', 2628000) / (60*60*24)) }} dienų</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Uncomment when you add analytics --}}
                {{--
                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">3. Analitikos slapukai</h3>
                <p class="text-gray-700 mb-4">
                    Šie slapukai padeda mums suprasti, kaip lankytojai naudojasi svetaine.
                </p>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-2 font-semibold text-gray-900">Slapuko pavadinimas</th>
                                <th class="text-left py-2 font-semibold text-gray-900">Paskirtis</th>
                                <th class="text-left py-2 font-semibold text-gray-900">Trukmė</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-2 font-mono text-primary">_ga</td>
                                <td class="py-2 text-gray-700">Google Analytics - atskiria unikalius vartotojus</td>
                                <td class="py-2 text-gray-700">2 metai</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-2 font-mono text-primary">_ga_*</td>
                                <td class="py-2 text-gray-700">Google Analytics - saugo sesijos būseną</td>
                                <td class="py-2 text-gray-700">2 metai</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                --}}

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Kaip valdyti slapukus?</h2>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Naršyklės nustatymai</h3>
                <p class="text-gray-700 mb-4">
                    Galite kontroliuoti ir/arba ištrinti slapukus savo naršyklės nustatymuose:
                </p>

                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>Chrome:</strong> Nustatymai → Privatumas ir saugumas → Slapukai ir kiti svetainės duomenys</li>
                    <li><strong>Firefox:</strong> Nustatymai → Privatumas ir saugumas → Slapukai ir svetainės duomenys</li>
                    <li><strong>Safari:</strong> Nustatymai → Privatumas → Valdyti svetainės duomenis</li>
                    <li><strong>Edge:</strong> Nustatymai → Slapukai ir svetainės leidimai</li>
                </ul>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Dėmesio:</strong> Išjungus būtinus slapukus, svetainė gali veikti netinkamai. Kai kurios funkcijos gali būti neprieinamos.
                            </p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Slapukų politikos keitimai</h2>
                <p class="text-gray-700 mb-6">
                    Pasiliekame teisę bet kada keisti šią slapukų politiką. Apie svarbius pakeitimus informuosime svetainėje arba elektroniniu paštu.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Kontaktai</h2>
                <p class="text-gray-700 mb-4">
                    Jei turite klausimų apie mūsų slapukų politiką, susisiekite su mumis:
                </p>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 mb-2">
                        <strong>El. paštas:</strong> <a href="mailto:info@qvicker.lt" class="text-primary hover:text-primary-dark">info@qvicker.lt</a>
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>Telefonas:</strong> <a href="tel:+37061065015" class="text-primary hover:text-primary-dark">+37061065015</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
