{{-- resources/views/legal/privacy.blade.php --}}
@extends('layouts.main')

@section('title', 'Privatumo politika')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Privatumo politika</h1>

            <div class="prose prose-lg max-w-none">
                <p class="text-gray-600 mb-6">
                    <strong>Paskutinis atnaujinimas:</strong> {{ date('Y-m-d') }}
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">1. Bendrosios nuostatos</h2>
                <p class="text-gray-700 mb-4">
                    Ši privatumo politika aprašo, kaip Qvicker („mes", „mūsų", „platforma") renka, naudoja, saugo ir dalijasi jūsų asmens duomenimis, kai naudojatės mūsų internetine platforma.
                </p>
                <p class="text-gray-700 mb-6">
                    Mes įsipareigojame apsaugoti jūsų privatumą ir laikytis Europos Sąjungos Bendro duomenų apsaugos reglamento (BDAR) reikalavimų.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">2. Duomenų valdytojas</h2>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700 mb-2">
                        <strong>Duomenų valdytojas:</strong> Qvicker Lietuva
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>El. paštas:</strong> <a href="mailto:privacy@qvicker.lt" class="text-primary hover:text-primary-dark">privacy@qvicker.lt</a>
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>Telefonas:</strong> +370 600 00000
                    </p>
                    <p class="text-gray-700">
                        <strong>Adresas:</strong> [Jūsų įmonės adresas], Lietuva
                    </p>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">3. Kokius duomenis renkame</h2>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">3.1. Registracijos duomenys</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Vardas ir pavardė</li>
                    <li>El. pašto adresas</li>
                    <li>Telefono numeris</li>
                    <li>Slaptažodis (šifruotas)</li>
                    <li>Vartotojo tipas (paslaugų teikėjas / ieškotojas)</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">3.2. Profilio duomenys</h3>
                <p class="text-gray-700 mb-2"><strong>Paslaugų teikėjams:</strong></p>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Profesijos / paslaugų kategorija</li>
                    <li>Paslaugų aprašymas</li>
                    <li>Darbo patirtis</li>
                    <li>Veiklos geografija</li>
                    <li>Profilio nuotrauka (nebūtina)</li>
                    <li>Dokumentai ar sertifikatai (jei pateikiami)</li>
                </ul>

                <p class="text-gray-700 mb-2"><strong>Paslaugų ieškotojams:</strong></p>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Adresas ar bendra vietovė</li>
                    <li>Pageidaujamos paslaugų kategorijos</li>
                    <li>Profilio nuotrauka (nebūtina)</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">3.3. Veiklos duomenys</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Užsakymų istorija</li>
                    <li>Įvertinimai ir atsiliepimai</li>
                    <li>Žinučių turinys (tarp vartotojų)</li>
                    <li>Platformos naudojimo statistika</li>
                    <li>IP adresas ir naršyklės informacija</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">3.4. Techniniai duomenys</h3>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-1">
                    <li>IP adresas</li>
                    <li>Naršyklės tipas ir versija</li>
                    <li>Operacinė sistema</li>
                    <li>Puslapių peržiūros ir paspaudimai</li>
                    <li>Sesijos trukmė</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">4. Duomenų rinkimo pagrindai</h2>
                <p class="text-gray-700 mb-4">Duomenis renkame remiantis šiais teisiniais pagrindais:</p>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 font-semibold text-gray-900">Duomenų tipas</th>
                            <th class="text-left py-2 font-semibold text-gray-900">Teisinis pagrindas</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-700">Registracijos duomenys</td>
                            <td class="py-2 text-gray-700">Sutartis (platformos naudojimas)</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-700">Profilio duomenys</td>
                            <td class="py-2 text-gray-700">Sutartis + jūsų sutikimas</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-700">Veiklos duomenys</td>
                            <td class="py-2 text-gray-700">Teisėti interesai (paslaugų gerinimas)</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-700">Techniniai duomenys</td>
                            <td class="py-2 text-gray-700">Teisėti interesai (saugumas, analitika)</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-gray-700">Rinkodaros duomenys</td>
                            <td class="py-2 text-gray-700">Jūsų sutikimas</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">5. Kaip naudojame duomenis</h2>
                <p class="text-gray-700 mb-4">Jūsų duomenis naudojame šiais tikslais:</p>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">5.1. Platformos veikimas</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Paskyros sukūrimas ir valdymas</li>
                    <li>Paslaugų teikėjų ir ieškotojų sujungimas</li>
                    <li>Užsakymų apdorojimas ir sekimas</li>
                    <li>Komunikacijos palengvinimas</li>
                    <li>Įvertinimų ir atsiliepimų valdymas</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">5.2. Saugumas ir patikimumas</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Sukčiavimo prevencija</li>
                    <li>Platformos saugumo užtikrinimas</li>
                    <li>Netinkamo turinio aptikimas</li>
                    <li>Ginčų sprendimo palengvinimas</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">5.3. Paslaugų gerinimas</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Platformos funkcionalumo analizė</li>
                    <li>Vartotojų patirties gerinimas</li>
                    <li>Naujų funkcijų kūrimas</li>
                    <li>Techninių problemų sprendimas</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">5.4. Komunikacija</h3>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-1">
                    <li>Svarbių pranešimų siuntimas</li>
                    <li>Techninio palaikymo teikimas</li>
                    <li>Naujienlaiškai (su jūsų sutikimu)</li>
                    <li>Platformos atnaujinimų informacija</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">6. Duomenų dalijimasis</h2>
                <p class="text-gray-700 mb-4">Jūsų duomenis galime dalinti su:</p>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">6.1. Kitais platformos vartotojais</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Profilio informacija (pagal jūsų nustatymus)</li>
                    <li>Įvertinimai ir atsiliepimai</li>
                    <li>Kontaktinė informacija (po užsakymo sudarymo)</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">6.2. Paslaugų teikėjais</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Hosting paslaugų teikėjai</li>
                    <li>El. pašto siuntimo paslaugos</li>
                    <li>Analitikos paslaugų teikėjai</li>
                    <li>Techninio palaikymo paslaugos</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">6.3. Teisiniais pagrindais</h3>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-1">
                    <li>Teisėsaugos reikalavimas</li>
                    <li>Teismo sprendimas</li>
                    <li>Įstatymų laikymosi užtikrinimas</li>
                </ul>

                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <strong>Svarbu:</strong> Mes niekada neparduodame jūsų duomenų trečioms šalims rinkodaros tikslais.
                            </p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">7. Duomenų saugojimas</h2>
                <p class="text-gray-700 mb-4">Duomenis saugome tol, kol:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Turite aktyvią paskyrą platformoje</li>
                    <li>To reikalauja įstatymai (pvz., apskaitos duomenys)</li>
                    <li>Reikalinga ginčų sprendimui</li>
                    <li>Neprašote duomenų ištrynimo</li>
                </ul>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 font-semibold text-gray-900">Duomenų tipas</th>
                            <th class="text-left py-2 font-semibold text-gray-900">Saugojimo trukmė</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-700">Registracijos duomenys</td>
                            <td class="py-2 text-gray-700">Kol egzistuoja paskyra</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-700">Užsakymų istorija</td>
                            <td class="py-2 text-gray-700">5 metai po paskutinio užsakymo</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-700">Įvertinimai</td>
                            <td class="py-2 text-gray-700">Kol egzistuoja susijusios paskyros</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-gray-700">Techniniai logai</td>
                            <td class="py-2 text-gray-700">12 mėnesių</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">8. Duomenų sauga</h2>
                <p class="text-gray-700 mb-4">Jūsų duomenų apsaugai taikome:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>SSL šifravimą duomenų perdavimui</li>
                    <li>Slaptažodžių maišymo (hash) technologijas</li>
                    <li>Reguliarius saugumo atnaujinimus</li>
                    <li>Prieigos kontrolės priemones</li>
                    <li>Regulų duomenų atsargines kopijas</li>
                    <li>Darbuotojų mokymus dėl duomenų apsaugos</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">9. Jūsų teisės</h2>
                <p class="text-gray-700 mb-4">Pagal BDAR turite šias teises:</p>

                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-900 mb-2">Prieiga prie duomenų</h4>
                        <p class="text-sm text-blue-800">Teisė gauti kopiją visų apie jus turimų duomenų</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <h4 class="font-semibold text-green-900 mb-2">Duomenų taisymas</h4>
                        <p class="text-sm text-green-800">Teisė pataisyti neteisingus arba netikslius duomenis</p>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4">
                        <h4 class="font-semibold text-red-900 mb-2">Duomenų ištrynimas</h4>
                        <p class="text-sm text-red-800">Teisė reikalauti ištrinti duomenis („teisė būti pamirštam")</p>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <h4 class="font-semibold text-yellow-900 mb-2">Tvarkymo apribojimas</h4>
                        <p class="text-sm text-yellow-800">Teisė apriboti duomenų tvarkymą tam tikromis aplinkybėmis</p>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4">
                        <h4 class="font-semibold text-purple-900 mb-2">Duomenų perkeliamumas</h4>
                        <p class="text-sm text-purple-800">Teisė gauti duomenis struktūrizuotu formatu</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Prieštaravimas</h4>
                        <p class="text-sm text-gray-800">Teisė prieštarauti duomenų tvarkymui tam tikrais atvejais</p>
                    </div>
                </div>

                <p class="text-gray-700 mb-6">
                    Norėdami pasinaudoti savo teisėmis, kreipkitės el. paštu
                    <a href="mailto:privacy@qvicker.lt" class="text-primary hover:text-primary-dark">privacy@qvicker.lt</a>
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">10. Slapukai</h2>
                <p class="text-gray-700 mb-6">
                    Informacijos apie slapukų naudojimą rasite mūsų
                    <a href="{{ route('cookies.policy') }}" class="text-primary hover:text-primary-dark underline">slapukų politikoje</a>.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">11. Nepilnamečių duomenys</h2>
                <p class="text-gray-700 mb-6">
                    Mūsų platforma neskirta asmenims iki 16 metų. Jei sužinome, kad surinkome nepilnamečio duomenis be tėvų sutikimo, nedelsdami juos ištriname.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">12. Tarptautinis duomenų perdavimas</h2>
                <p class="text-gray-700 mb-6">
                    Jūsų duomenys saugomi ES serveriuose. Jei duomenys perduodami už ES ribų, užtikriname atitinkamą apsaugos lygį pagal BDAR reikalavimus.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">13. Politikos keitimai</h2>
                <p class="text-gray-700 mb-6">
                    Apie svarbius privatumo politikos pakeitimus informuosime el. paštu arba platformoje ne vėliau kaip 30 dienų iki pakeitimų įsigaliojimo.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">14. Skundai duomenų apsaugos institucijai</h2>
                <p class="text-gray-700 mb-4">
                    Jei manote, kad pažeidėme jūsų duomenų apsaugos teises, galite pateikti skundą:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700 mb-2">
                        <strong>Valstybinė duomenų apsaugos inspekcija</strong>
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>El. paštas:</strong> ada@ada.lt
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>Telefonas:</strong> +370 5 279 14 45
                    </p>
                    <p class="text-gray-700">
                        <strong>Svetainė:</strong> <a href="https://vdai.lrv.lt" class="text-primary hover:text-primary-dark" target="_blank">vdai.lrv.lt</a>
                    </p>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">15. Kontaktai</h2>
                <p class="text-gray-700 mb-4">
                    Duomenų apsaugos klausimais kreipkitės:
                </p>

                <div class="bg-primary/10 rounded-lg p-4 border border-primary/20">
                    <p class="text-gray-700 mb-2">
                        <strong>El. paštas:</strong> <a href="mailto:privacy@qvicker.lt" class="text-primary hover:text-primary-dark">privacy@qvicker.lt</a>
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>Bendras el. paštas:</strong> <a href="mailto:info@qvicker.lt" class="text-primary hover:text-primary-dark">info@qvicker.lt</a>
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>Telefonas:</strong> <a href="tel:+37060000000" class="text-primary hover:text-primary-dark">+370 600 00000</a>
                    </p>
                </div>

                <div class="mt-8 p-4 bg-gray-100 rounded-lg">
                    <p class="text-sm text-gray-600 text-center">
                        Ši privatumo politika paskutinį kartą atnaujinta {{ date('Y-m-d') }} ir įsigalioja nuo šios datos.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
