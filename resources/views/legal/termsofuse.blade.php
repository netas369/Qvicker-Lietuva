{{-- resources/views/legal/terms.blade.php --}}
@extends('layouts.main')

@section('title', 'Naudojimosi sąlygos')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Naudojimosi sąlygos</h1>

            <div class="prose prose-lg max-w-none">
                <p class="text-gray-600 mb-6">
                    <strong>Paskutinis atnaujinimas:</strong> {{ date('Y-m-d') }}
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">1. Bendrosios nuostatos</h2>
                <p class="text-gray-700 mb-4">
                    Šios naudojimosi sąlygos (toliau – „Sąlygos") reglamentuoja Qvicker platformos naudojimą. Qvicker yra internetinė platforma, skirta sujungti paslaugų teikėjus su paslaugų ieškotojais.
                </p>
                <p class="text-gray-700 mb-6">
                    Naudodamiesi mūsų platforma, sutinkate su šiomis sąlygomis. Jei nesutinkate su bet kuria šių sąlygų dalimi, prašome nenaudoti mūsų platformos.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">2. Platformos pobūdis</h2>
                <p class="text-gray-700 mb-4">
                    Qvicker yra tarpininkavimo platforma, kuri:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Suteikia galimybę paslaugų teikėjams skelbti savo paslaugas</li>
                    <li>Leidžia paslaugų ieškotojams rasti ir susisiekti su paslaugų teikėjais</li>
                    <li>Palengvina komunikaciją tarp šalių</li>
                    <li><strong>Nedalyvauja mokėjimų procese</strong> – visi atsiskaitymai vyksta tiesiogiai tarp paslaugų teikėjo ir ieškotojo</li>
                    <li><strong>Nėra paslaugų teikėjas</strong> – mes tik sudarome sąlygas susitikti</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">3. Vartotojų tipai ir teisės</h2>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">3.1. Paslaugų teikėjai</h3>
                <p class="text-gray-700 mb-4">Paslaugų teikėjai gali:</p>
                <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                    <li>Registruotis platformoje ir kurti profilį</li>
                    <li>Skelbti savo teikiamas paslaugas</li>
                    <li>Nustatyti kainas ir paslaugų aprašymus</li>
                    <li>Bendrauti su potencialiais klientais</li>
                    <li>Valdyti savo užsakymus ir tvarkaraštį</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">3.2. Paslaugų ieškotojai</h3>
                <p class="text-gray-700 mb-4">Paslaugų ieškotojai gali:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-1">
                    <li>Ieškoti paslaugų teikėjų pagal kategoriją, vietą</li>
                    <li>Peržiūrėti paslaugų teikėjų profilius ir įvertinimus</li>
                    <li>Tiesiogiai susisiekti su paslaugų teikėjais</li>
                    <li>Užsakyti paslaugas per platformą</li>
                    <li>Vertinti ir komentuoti gautą paslaugą</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">4. Registracija ir paskyros valdymas</h2>
                <p class="text-gray-700 mb-4">
                    Registruodamiesi platformoje, privalote:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Pateikti tikrą ir tikslų informaciją</li>
                    <li>Palaikyti savo paskyros duomenis aktualius</li>
                    <li>Apsaugoti savo prisijungimo duomenis</li>
                    <li>Nedelsiant pranešti apie bet kokį neteisėtą paskyros naudojimą</li>
                    <li>Būti ne jaunesni nei 18 metų arba turėti tėvų/globėjų sutikimą</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">5. Mokėjimai ir atsiskaitymai</h2>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>Svarbu:</strong> Qvicker nedalyvauja mokėjimų procese. Visi atsiskaitymai vyksta tiesiogiai tarp paslaugų teikėjo ir ieškotojo.
                            </p>
                        </div>
                    </div>
                </div>

                <p class="text-gray-700 mb-4">
                    Mokėjimo sąlygos, metodai ir terminai aptariami ir suderinami tiesiogiai tarp paslaugų teikėjo ir ieškotojo. Qvicker neatsako už:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Mokėjimų vėlavimą ar nemokėjimą</li>
                    <li>Mokėjimų ginčus tarp šalių</li>
                    <li>Netinkamus mokėjimo metodus</li>
                    <li>PVM ar kitų mokesčių apskaičiavimą</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">6. Paslaugų kokybė ir atsakomybė</h2>
                <p class="text-gray-700 mb-4">
                    Qvicker yra tik tarpininkavimo platforma ir neatsako už:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Paslaugų kokybę ar atitikimą aprašymams</li>
                    <li>Paslaugų teikėjų kvalifikaciją ar patikimumą</li>
                    <li>Žalą, kylančią dėl netinkamai suteiktų paslaugų</li>
                    <li>Ginčus tarp paslaugų teikėjų ir ieškotojų</li>
                    <li>Sutarčių nevykdymą ar pažeidimus</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">7. Draudžiama veikla</h2>
                <p class="text-gray-700 mb-4">Platformoje draudžiama:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Skelbti neteisingą ar klaidinančią informaciją</li>
                    <li>Teikti neteisėtas paslaugas</li>
                    <li>Naudoti platformą nesąžiningam konkuravimui</li>
                    <li>Kenkti kitiems vartotojams ar jų reputacijai</li>
                    <li>Apeiti platformos sistemas ar saugumo priemones</li>
                    <li>Siųsti šlamštą ar nesankcionuotą reklamą</li>
                    <li>Pažeisti autorių teises ar kitas intelektualinės nuosavybės teises</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">8. Įvertinimai ir atsiliepimai</h2>
                <p class="text-gray-700 mb-4">
                    Vartotojai gali vertinti ir komentuoti paslaugas. Įvertinimai ir atsiliepimai turi būti:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Sąžiningi ir pagrįsti faktais</li>
                    <li>Susiję su faktiškai gauta paslauga</li>
                    <li>Nepažeidžiantys kitų asmenų teisių</li>
                    <li>Nepolitinio ar diskriminacinio pobūdžio</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">9. Duomenų apsauga</h2>
                <p class="text-gray-700 mb-6">
                    Mes rūpinamės jūsų duomenų apsauga. Detalią informaciją apie duomenų tvarkymą rasite mūsų
                    <a href="{{ route('legal.privacy') }}" class="text-primary hover:text-primary-dark underline">privatumo politikoje</a>.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">10. Atsakomybės apribojimas</h2>
                <p class="text-gray-700 mb-4">
                    Qvicker atsakomybė apribota maksimaliai, kiek leidžia galiojantys įstatymai:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Mes neteikiame jokių garantijų dėl platformos veikimo</li>
                    <li>Neatsako už tiesiogines ar netiesiogines žalas</li>
                    <li>Negarantuojame nuolatinio platformos prieinamumo</li>
                    <li>Paslaugos teikiamos „kaip yra" principu</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">11. Ginčų sprendimas</h2>
                <p class="text-gray-700 mb-4">
                    Ginčai tarp paslaugų teikėjų ir ieškotojų sprendžiami tiesiogiai tarp šalių. Qvicker gali:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Pateikti kontaktų informaciją ginčo sprendimui</li>
                    <li>Užblokuoti probleminius vartotojus</li>
                    <li>Pašalinti netinkamą turinį</li>
                    <li>Tačiau nebus tarpininkas ginčų sprendime</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">12. Sąlygų keitimas</h2>
                <p class="text-gray-700 mb-6">
                    Pasiliekame teisę bet kada keisti šias sąlygas. Apie svarbius pakeitimus informuosime ne vėliau kaip 30 dienų iki jų įsigaliojimo. Toliau naudodamiesi platforma po pakeitimų įsigaliojimo, sutinkate su naujomis sąlygomis.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">13. Paskyros nutraukimas</h2>
                <p class="text-gray-700 mb-4">
                    Galime nutraukti ar sustabdyti jūsų paskyrą, jei:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Pažeidžiate šias naudojimosi sąlygas</li>
                    <li>Naudojate platformą neteisėtais tikslais</li>
                    <li>Gaunate daug neigiamų atsiliepimų</li>
                    <li>Neaktyviai naudojate paskyrą ilgą laiką</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">14. Taikytini įstatymai</h2>
                <p class="text-gray-700 mb-6">
                    Šios sąlygos reglamentuojamos Lietuvos Respublikos įstatymais. Ginčai sprendžiami Lietuvos Respublikos teismuose.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">15. Kontaktų informacija</h2>
                <p class="text-gray-700 mb-4">
                    Klausimais dėl šių naudojimosi sąlygų kreipkitės:
                </p>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 mb-2">
                        <strong>El. paštas:</strong> <a href="mailto:info@qvicker.lt" class="text-primary hover:text-primary-dark">info@qvicker.lt</a>
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>Telefonas:</strong> <a href="tel:+37061065015" class="text-primary hover:text-primary-dark">+37061065015</a>
                    </p>
                </div>

                <div class="mt-8 p-4 bg-primary/10 rounded-lg border border-primary/20">
                    <p class="text-sm text-gray-700">
                        <strong>Paskutinė redakcija:</strong> {{ date('Y-m-d') }} <br>
                        Šios sąlygos įsigalioja nuo {{ date('Y-m-d') }} ir galioja iki atšaukimo ar pakeitimo.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
