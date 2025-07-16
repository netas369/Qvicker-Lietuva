@extends('layouts.main')

@section('content')

    <!-- Hero Section -->
    <div class="relative py-20 md:py-24 overflow-hidden bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-20 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-20 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center max-w-4xl mx-auto">
                <span class="inline-block px-4 py-2 bg-primary-light/10 text-primary-light rounded-full text-sm font-semibold mb-6">
                    Apie mus
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Kuriame <span class="bg-gradient-to-r from-primary-light to-blue-600 bg-clip-text text-transparent">Bendruomenę</span> Kuri Dirba Kartu
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 leading-relaxed">
                    Qvicker - tai daugiau nei tik paslaugų platforma. Mes sujungiame talentingus specialistus su žmonėmis, kuriems reikia jų pagalbos, kurdami pasitikėjimu grįstą ekosistemą.
                </p>
            </div>
        </div>
    </div>

    <!-- Mission & Vision Section -->
    <div class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Mission -->
                <div class="group">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-primary-light to-blue-600 rounded-2xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-300"></div>
                        <div class="relative bg-white rounded-2xl p-8 md:p-10 shadow-xl border border-gray-100">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-light to-primary-verylight rounded-xl flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Mūsų Misija</h2>
                            <p class="text-gray-600 leading-relaxed">
                                Padaryti profesionalias paslaugas prieinamas kiekvienam, suteikiant galimybę žmonėms lengvai rasti patikimus specialistus, o paslaugų teikėjams - plėsti savo verslą ir pasiekti daugiau klientų.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Vision -->
                <div class="group">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-2xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-300"></div>
                        <div class="relative bg-white rounded-2xl p-8 md:p-10 shadow-xl border border-gray-100">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Mūsų Vizija</h2>
                            <p class="text-gray-600 leading-relaxed">
                                Tapti pirmaujančia paslaugų platforma Baltijos šalyse, kur kiekvienas gali greitai rasti kokybiškas paslaugas, o specialistai - kurti sėkmingą karjerą be ribų.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Story Section -->
    <div class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute h-64 w-64 bg-primary-light rounded-full -top-32 -left-32"></div>
            <div class="absolute h-64 w-64 bg-primary-light rounded-full -bottom-32 -right-32"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mūsų Istorija</h2>
                    <p class="text-gray-600 text-lg">Kaip gimė Qvicker idėja</p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
                    <p class="text-gray-700 leading-relaxed text-lg mb-6">
                        Qvicker gimė iš paprastos, bet galingos idėjos - <span class="font-semibold text-primary-light">sujungti žmones, kuriems reikia pagalbos, su tais, kurie gali ją suteikti</span>.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-6">
                        2022 metais, pastebėję, kaip sunku rasti patikimus specialistus kasdienėms paslaugoms, nusprendėme sukurti platformą, kuri išspręstų šią problemą. Pradėjome nuo mažo - kelių kategorijų ir keliolikos paslaugų teikėjų.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-6">
                        Šiandien Qvicker jungia <span class="font-semibold text-primary-light">kartu specialistus</span> ir <span class="font-semibold text-primary-light">aptarnauja šimtus klientų</span> visoje Lietuvoje. Mūsų platforma tapo tiltu tarp talento ir poreikio, padedančiu žmonėms užsidirbti iš savo įgūdžių ir kitiems - gauti kokybiškas paslaugas.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Bet tai tik pradžia. Mes nuolat tobulėjame, plečiamės ir kuriame naujas galimybes mūsų bendruomenei augti ir klestėti kartu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mūsų Vertybės</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Principais, kuriais vadovaujamės kiekvieną dieną</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Pasitikėjimas -->
                <div class="group">
                    <div class="text-center">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-blue-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <!-- Shield Check Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l7 4v5c0 5-3 9-7 10-4-1-7-5-7-10V7l7-4zM9 12l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Pasitikėjimas</h3>
                        <p class="text-gray-600 leading-relaxed">Kuriame saugią aplinką, kur kiekvienas jaučiasi patikimai</p>
                    </div>
                </div>

                <!-- Paprastumas -->
                <div class="group">
                    <div class="text-center">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-emerald-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <!-- Arrow Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Paprastumas</h3>
                        <p class="text-gray-600 leading-relaxed">Darome procesus paprastus ir suprantamus visiems</p>
                    </div>
                </div>

                <!-- Bendruomenė -->
                <div class="group">
                    <div class="text-center">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-purple-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <!-- Users Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2a5 5 0 00-9.288 0M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Bendruomenė</h3>
                        <p class="text-gray-600 leading-relaxed">Kartu kuriame stiprią ir palaikančią bendruomenę</p>
                    </div>
                </div>

                <!-- Kokybė -->
                <div class="group">
                    <div class="text-center">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-orange-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <!-- Star Badge Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6l2.09 4.26L18 11l-3 2.9.71 4.1L12 16l-3.71 1.95.71-4.1-3-2.9 3.91-.74L12 6z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Kokybė</h3>
                        <p class="text-gray-600 leading-relaxed">Užtikriname aukščiausią paslaugų kokybės standartą</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Statistics Section -->
    <div class="py-20 relative overflow-hidden">
        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-light via-blue-600 to-primary-verylight opacity-95"></div>

        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Mūsų Pasiekimai</h2>
                <p class="text-white/80 text-lg">Skaičiai, kuriais didžiuojamės</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300">500+</div>
                    <div class="text-white/80">Paslaugų teikėjų</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300">10k+</div>
                    <div class="text-white/80">Atliktų užsakymų</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300">4.9</div>
                    <div class="text-white/80">Vidutinis įvertinimas</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300">50+</div>
                    <div class="text-white/80">Paslaugų kategorijų</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mūsų Komanda</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Susipažinkite su žmonėmis, kurie kiekvieną dieną dirba, kad jūsų patirtis būtų geriausia</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <!-- Team Member 1 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent z-10"></div>
                        <img src="https://i.ibb.co/vCkGt51t/Chat-GPT-Image-Jul-9-2025-02-56-52-PM.png" alt="CEO" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6 z-20">
                            <h3 class="text-xl font-bold text-white mb-1">Netas Neverauskas</h3>
                            <p class="text-white/80">Įkūrėjas</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent z-10"></div>
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop" alt="CTO" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6 z-20">
                            <h3 class="text-xl font-bold text-white mb-1">Anastasija Miltaitė</h3>
                            <p class="text-white/80">Sekretorė</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent z-10"></div>
                        <img src="https://i.ibb.co/bjRk1qJp/Chat-GPT-Image-Jul-10-2025-11-16-27-AM.png" alt="COO" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6 z-20">
                            <h3 class="text-xl font-bold text-white mb-1">Domantas Vitkus</h3>
                            <p class="text-white/80">Įkūrėjas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-primary-light rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Prisijunkite prie
                    <span class="bg-gradient-to-r from-primary-light to-primary-verylight bg-clip-text text-transparent">Qvicker bendruomenės</span>
                </h2>
                <p class="text-gray-600 text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                    Nesvarbu, ar ieškote paslaugų, ar norite jas teikti - mes čia, kad padėtume jums sėkmingai dirbti kartu
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <!-- Client CTA -->
                    <a href="/register/seeker" class="group relative inline-block">
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl blur-md opacity-30 group-hover:opacity-50 transition duration-300"></div>
                        <button class="relative bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-bold py-4 px-8 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center">
                            <span>Ieškau paslaugų</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>

                    <!-- Provider CTA -->
                    <a href="/register/provider" class="group relative inline-block">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary-light to-primary-verylight rounded-xl blur-md opacity-30 group-hover:opacity-50 transition duration-300"></div>
                        <button class="relative bg-gradient-to-r from-primary-light to-primary-verylight text-white font-bold py-4 px-8 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center">
                            <span>Tapti partneriu</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
