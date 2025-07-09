@extends('layouts.main')

@section('content')

    <!-- Hero Section -->
    <div class="relative py-16 md:py-20 overflow-hidden bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Background decorative blobs -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-20 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    Dažnai Užduodami Klausimai
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                    Turite klausimų? Čia rasite atsakymus į dažniausiai užduodamus klausimus apie mūsų platformą.
                </p>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="py-8 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text"
                           id="faq-search"
                           placeholder="Ieškoti klausimų..."
                           class="w-full px-6 py-4 pr-12 text-gray-900 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-light focus:border-transparent transition-all duration-200">
                    <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Categories -->
    <div class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <!-- Category Tabs -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="category-tab active px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 bg-primary-light text-white" data-category="all">
                    Visi klausimai
                </button>
                <button class="category-tab px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200" data-category="general">
                    Bendri klausimai
                </button>
                <button class="category-tab px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200" data-category="seeker">
                    Klientams
                </button>
                <button class="category-tab px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200" data-category="provider">
                    Paslaugų teikėjams
                </button>
                <button class="category-tab px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200" data-category="payment">
                    Mokėjimai
                </button>
                <button class="category-tab px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200" data-category="safety">
                    Sauga ir kokybė
                </button>
            </div>

            <!-- FAQ Items -->
            <div class="max-w-4xl mx-auto space-y-4" id="faq-container">

                <!-- Bendri klausimai -->
                <div class="faq-section" data-category="general">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-primary-light/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Bendri klausimai
                    </h2>

                    <div class="faq-item group" data-category="general">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-primary-light/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-primary-light transition-colors duration-300">Kas yra WorkLink?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-primary-light/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-primary-light transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">WorkLink yra inovatyvi platforma, jungianti paslaugų teikėjus su klientais visoje Lietuvoje. Mes padedame žmonėms greitai ir patogiai rasti patikimus specialistus įvairioms paslaugoms - nuo namų remonto iki grožio paslaugų.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="general">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-primary-light/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-primary-light transition-colors duration-300">Kaip veikia platforma?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-primary-light/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-primary-light transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed mb-3">Platformos veikimas labai paprastas:</p>
                                <ol class="list-decimal list-inside text-gray-600 space-y-2">
                                    <li>Klientai registruojasi ir ieško reikiamų paslaugų</li>
                                    <li>Paslaugų teikėjai registruojasi ir pristato savo paslaugas</li>
                                    <li>Klientai peržiūri specialistų profilius, įvertinimus ir kainas</li>
                                    <li>Tiesiogiai susisiekia su pasirinktais specialistais</li>
                                    <li>Po paslaugos atlikimo palieka atsiliepimus</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="general">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-primary-light/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-primary-light transition-colors duration-300">Ar registracija mokama?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-primary-light/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-primary-light transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Ne, registracija platformoje yra visiškai nemokama tiek klientams, tiek paslaugų teikėjams. Neskaičiuojame jokių registracijos ar mėnesinių mokesčių.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Klientams -->
                <div class="faq-section mt-12" data-category="seeker">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-emerald-500/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        Klientams
                    </h2>

                    <div class="faq-item group" data-category="seeker">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">Kaip rasti tinkamą specialistą?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-emerald-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-emerald-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed mb-3">Specialistą galite rasti keliais būdais:</p>
                                <ul class="list-disc list-inside text-gray-600 space-y-2">
                                    <li>Naudokitės paieškos laukeliu pagrindiniame puslapyje</li>
                                    <li>Naršykite per paslaugų kategorijas</li>
                                    <li>Filtruokite pagal vietovę, kainą ir įvertinimus</li>
                                    <li>Peržiūrėkite specialistų profilius ir darbo pavyzdžius</li>
                                    <li>Skaitykite kitų klientų atsiliepimus</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="seeker">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">Ar saugu naudotis platforma?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-emerald-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-emerald-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Taip, mes užtikriname saugumą keliais būdais:</p>
                                <ul class="list-disc list-inside text-gray-600 space-y-2 mt-3">
                                    <li>Visi paslaugų teikėjai yra patikrinti</li>
                                    <li>Galite matyti realius klientų atsiliepimus ir įvertinimus</li>
                                    <li>Galite susisiekti su mūsų komanda bet kuriuo metu</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="seeker">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">Kiek laiko užtrunka rasti specialistą?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-emerald-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-emerald-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Specialistą galite rasti labai greitai - dažniausiai per kelias minutes. Vidutinis atsako laikas iš paslaugų teikėjų yra apie 2 valandos.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paslaugų teikėjams -->
                <div class="faq-section mt-12" data-category="provider">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        Paslaugų teikėjams
                    </h2>

                    <div class="faq-item group" data-category="provider">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-blue-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Kaip tapti partneriu?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-blue-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-blue-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed mb-3">Tapti partneriu labai paprasta:</p>
                                <ol class="list-decimal list-inside text-gray-600 space-y-2">
                                    <li>Užsiregistruokite per "Tapti partneriu" mygtuką</li>
                                    <li>Užpildykite savo profilį ir aprašykite paslaugas</li>
                                    <li>Pridėkite darbo pavyzdžių nuotraukas</li>
                                    <li>Palaukite patvirtinimo iš mūsų komandos</li>
                                    <li>Pradėkite gauti užsakymus!</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="provider">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-blue-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Kokių paslaugų teikėjų ieškote?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-blue-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-blue-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed mb-3">Mes ieškome įvairių sričių profesionalų:</p>
                                <ul class="list-disc list-inside text-gray-600 space-y-2">
                                    <li>Namų remonto specialistai (santechnikai, elektrikai, dailidės)</li>
                                    <li>Valymo paslaugų teikėjai</li>
                                    <li>Sodininkai ir kraštovaizdžio dizaineriai</li>
                                    <li>Transporto paslaugų teikėjai</li>
                                    <li>Ir daug kitų! Neradote sau tinkamos kategorijos? Susisiekite su mumis!</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="provider">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-blue-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Ar galiu pats nustatyti savo kainas?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-blue-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-blue-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Taip, jūs visiškai kontroliuojate savo kainodarą. Mes tik randame jum klienta, kainą turite sutarti tiesiogiai su klientu naudojantis platforma. Privaloma, kad kaina būtų pažymėta chat funkcijoje.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mokėjimai -->
                <div class="faq-section mt-12" data-category="payment">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-green-500/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Mokėjimai
                    </h2>

                    <div class="faq-item group" data-category="payment">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-green-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-green-600 transition-colors duration-300">Kaip vyksta atsiskaitymai?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-green-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-green-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Šiuo metu WorkLink platforma neapdoroja mokėjimų. Atsiskaitymai vyksta tiesiogiai tarp kliento ir paslaugų teikėjo. Mokėjimo būdą (grynieji, pavedimu) susitarkite tarpusavyje prieš pradedant darbą.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="payment">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-green-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-green-600 transition-colors duration-300">Ar taikomi kokie nors mokesčiai?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-green-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-green-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Ne, šiuo metu WorkLink netaiko jokių mokesčių nei klientams, nei paslaugų teikėjams. Registracija ir naudojimasis platforma yra visiškai nemokama. Ateityje gali būti taikomi nedideli komisiniai mokesčiai paslaugų teikėjams.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="payment">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-green-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-green-600 transition-colors duration-300">Kas atsako už mokestinius įsipareigojimus?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-green-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-green-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Kiekvienas paslaugų teikėjas yra atsakingas už savo mokestinius įsipareigojimus. Rekomenduojame konsultuotis su buhalteriu ar mokesčių konsultantu dėl pajamų deklaravimo ir mokesčių mokėjimo.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sauga ir kokybė -->
                <div class="faq-section mt-12" data-category="safety">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-purple-500/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        Sauga ir kokybė
                    </h2>

                    <div class="faq-item group" data-category="safety">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-purple-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-purple-600 transition-colors duration-300">Kaip užtikrinate paslaugų kokybę?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-purple-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-purple-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed mb-3">Kokybę užtikriname keliais būdais:</p>
                                <ul class="list-disc list-inside text-gray-600 space-y-2">
                                    <li>Visi paslaugų teikėjai yra patikrinti prieš patvirtinant registraciją</li>
                                    <li>Klientai palieka realius atsiliepimus po kiekvienos paslaugos</li>
                                    <li>Stebime įvertinimus ir reaguojame į skundus</li>
                                    <li>Šaliname specialistus, kurie nesilaiko standartų</li>
                                    <li>Teikiame konfliktų sprendimo pagalbą</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="safety">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-purple-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-purple-600 transition-colors duration-300">Ką daryti, jei esu nepatenkintas paslauga?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-purple-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-purple-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed">Jei esate nepatenkintas paslauga:</p>
                                <ol class="list-decimal list-inside text-gray-600 space-y-2 mt-3">
                                    <li>Pirmiausia pabandykite išspręsti problemą tiesiogiai su paslaugų teikėju</li>
                                    <li>Palikite objektyvų atsiliepimą apie patirtį</li>
                                    <li>Susisiekite su mūsų komanda el. paštu support@worklink.lt</li>
                                    <li>Aprašykite situaciją ir pridėkite įrodymus (nuotraukas, susirašinėjimą)</li>
                                    <li>Mes padėsime rasti tinkamą sprendimą</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item group" data-category="safety">
                        <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-purple-500/30 hover:shadow-lg transition-all duration-300">
                            <button class="faq-question flex justify-between items-center w-full p-6 text-left">
                                <span class="text-lg font-semibold text-gray-800 group-hover:text-purple-600 transition-colors duration-300">Kaip apsaugoti savo asmens duomenis?</span>
                                <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-purple-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                    <svg class="faq-icon h-5 w-5 text-gray-500 group-hover:text-purple-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-6 pb-6">
                                <p class="text-gray-600 leading-relaxed mb-3">Jūsų privatumo apsauga yra mūsų prioritetas:</p>
                                <ul class="list-disc list-inside text-gray-600 space-y-2">
                                    <li>Nesidalinkite asmens kodu, paso numeriu ar banko duomenimis</li>
                                    <li>Susirašinėkite per platformos žinučių sistemą</li>
                                    <li>Neatskleiskite savo tikslaus adreso profilio aprašyme</li>
                                    <li>Laikykitės GDPR reikalavimų</li>
                                    <li>Pranešė apie įtartinus vartotojus</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                    Neradote atsakymo į savo klausimą?
                </h2>
                <p class="text-gray-600 text-lg mb-8">
                    Mūsų komanda pasirengusi padėti. Susisiekite su mumis bet kuriuo jums patogiu būdu.
                </p>

                <div class="grid md:grid-cols-2 gap-6 mb-10">
                    <!-- Email -->
                    <div class="group">
                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary-light/30">
                            <div class="w-14 h-14 bg-primary-light/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2">El. paštas</h3>
                            <a href="mailto:support@worklink.lt" class="text-primary-light hover:text-primary-dark transition-colors">support@worklink.lt</a>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="group">
                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary-light/30">
                            <div class="w-14 h-14 bg-primary-light/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2">Telefonas</h3>
                            <a href="tel:+37060000000" class="text-primary-light hover:text-primary-dark transition-colors">+370 600 00000</a>
                        </div>
                    </div>

{{--                    <!-- Live Chat -->--}}
{{--                    <div class="group">--}}
{{--                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary-light/30">--}}
{{--                            <div class="w-14 h-14 bg-primary-light/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">--}}
{{--                                <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                            <h3 class="font-semibold text-gray-800 mb-2">Tiesioginė pagalba</h3>--}}
{{--                            <button class="text-primary-light hover:text-primary-dark transition-colors">Pradėti pokalbį</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                <div class="inline-flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Darbo laikas: Pirmadieniais - Penktadieniais 9:00 - 18:00
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ Accordion functionality
            const faqQuestions = document.querySelectorAll('.faq-question');

            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('.faq-icon');
                    const isOpen = !answer.classList.contains('hidden');

                    // Close all other answers
                    document.querySelectorAll('.faq-answer').forEach(a => {
                        if (a !== answer) {
                            a.classList.add('hidden');
                            a.previousElementSibling.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                        }
                    });

                    // Toggle current answer
                    if (isOpen) {
                        answer.classList.add('hidden');
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        answer.classList.remove('hidden');
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });

            // Category filtering
            const categoryTabs = document.querySelectorAll('.category-tab');
            const faqSections = document.querySelectorAll('.faq-section');
            const faqItems = document.querySelectorAll('.faq-item');

            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const selectedCategory = this.getAttribute('data-category');

                    // Update active tab styling
                    categoryTabs.forEach(t => {
                        t.classList.remove('bg-primary-light', 'text-white');
                        t.classList.add('bg-gray-100', 'text-gray-700');
                    });
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-primary-light', 'text-white');

                    // Show/hide sections and items
                    if (selectedCategory === 'all') {
                        faqSections.forEach(section => section.style.display = 'block');
                        faqItems.forEach(item => item.style.display = 'block');
                    } else {
                        faqSections.forEach(section => {
                            if (section.getAttribute('data-category') === selectedCategory) {
                                section.style.display = 'block';
                            } else {
                                section.style.display = 'none';
                            }
                        });

                        faqItems.forEach(item => {
                            if (item.getAttribute('data-category') === selectedCategory) {
                                item.style.display = 'block';
                            } else if (item.parentElement.getAttribute('data-category') !== selectedCategory) {
                                item.style.display = 'none';
                            }
                        });
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('faq-search');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                    const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                        // Also show the parent section
                        const parentSection = item.closest('.faq-section');
                        if (parentSection) {
                            parentSection.style.display = 'block';
                        }
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Hide sections with no visible items
                faqSections.forEach(section => {
                    const visibleItems = section.querySelectorAll('.faq-item[style="display: block;"]');
                    if (visibleItems.length === 0 && searchTerm !== '') {
                        section.style.display = 'none';
                    }
                });
            });
        });
    </script>

@endsection
