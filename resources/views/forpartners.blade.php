@extends('layouts.main')

@section('title', 'Tapk Qvicker Partneriu | Papildomos Pajamos Freelanceriu')

@section('description', 'Tapk Qvicker partneriu ir uždirbk papildomai iš savo įgūdžių. Lankstus grafikas, 500+ partnerių, nauji klientai. Nemokama registracija specialistams.')

@section('keywords', 'papildomos pajamos lietuvoje, freelancer darbas, paslaugų teikėjas, darbo iš namų, lankstus grafikas, monetizuoti įgūdžius, qvicker partnerystė, specialistas lietuvoje, nepriklausomas darbuotojas, freelance lietuva')

@section('content')

    <!-- Hero Section -->
    <div class="relative md:py-16 overflow-hidden bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <!-- Background decorative blobs - consistent animation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-20 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center space-y-8">
                <!-- Badge with glass effect - fixed -->
                <div class="inline-block">
                    <div class="flex items-center space-x-3 bg-white/80 backdrop-blur-sm px-5 py-2.5 rounded-full shadow-md border border-gray-100 hover:shadow-lg hover:scale-105 transform transition-all duration-300">
                        <span class="text-sm font-semibold text-gray-700">100+ partnerių</span>
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                        </span>
                    </div>
                </div>

                <!-- Heading with gradient text -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="block bg-gradient-to-r from-blue-600 via-primary-light to-blue-600 bg-clip-text text-transparent pb-2">
                        Išnaudok savo sugebėjimus
                    </span>
                    <span class="block text-gray-900 mt-2">ir uždirbk daugiau</span>
                </h1>

                <!-- Subheading -->
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    Tapk Qvicker partneriu ir pradėk gauti užsakymus jau šiandien. Dirbk savo tempu, valdyk savo laiką ir užsidirbk daugiau darydamas tai, ką mėgsti.
                </p>

                <!-- CTA Section -->
                <div class="pt-4 space-y-6">
                    <!-- Main CTA button -->
                    <div class="relative inline-block group">
                        <!-- Glow effect -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary-light to-primary-verylight rounded-xl blur-md opacity-30 group-hover:opacity-50 transition duration-300"></div>

                        <a href="{{route('register.provider')}}" class="relative block">
                            <button class="relative bg-gradient-to-r from-primary-light to-primary-verylight hover:from-primary-verylight hover:to-primary-light text-white font-semibold py-4 px-8 sm:py-5 sm:px-10 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-3 text-lg">
                                <span>Tapti Partneriu</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </a>
                    </div>

                    <!-- Trust badges -->
                    <div class="flex flex-wrap justify-center gap-6 text-sm">
                        <div class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-green-100">
                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Nemokama registracija</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-green-100">
                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Be įsipareigojimų</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 opacity-50 hover:opacity-100 transition-opacity">
            <div class="animate-bounce">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="py-20 relative overflow-hidden">
        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-light via-blue-600 to-primary-verylight opacity-95"></div>

        <!-- Decorative elements - consistent blend mode -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-3xl md:text-5xl font-bold text-center text-white mb-4">Kodėl verta prisijungti?</h2>
            <p class="text-center text-white/80 max-w-2xl mx-auto mb-16 text-lg">Prisijunk prie bendruomenės, kuri vertina tavo įgūdžius</p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="group relative">
                    <!-- Card glow effect -->
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-white to-blue-100 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-blue-100 rounded-full blur-2xl opacity-50 scale-75"></div>
                            <img src="/images/pt_icon1.png" alt="Lankstus Grafikas" class="h-32 w-auto relative z-10 transform group-hover:scale-110 transition-transform duration-300" draggable="false">
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">Lankstus Grafikas</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Dirbk kada nori ir kiek nori. Tu visiškai kontroliuoji savo darbo laiką.</p>

                        <!-- Decorative element -->
                        <div class="absolute top-4 right-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full opacity-50"></div>
                        </div>
                    </div>
                </div>

                <!-- Benefit 2 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-white to-green-100 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-green-100 rounded-full blur-2xl opacity-50 scale-75"></div>
                            <img src="/images/pt_icon2.png" alt="Papildomos Pajamos" class="h-32 w-auto relative z-10 transform group-hover:scale-110 transition-transform duration-300" draggable="false">
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">Papildomos Pajamos</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Užsidirbk papildomai darant tai, ką moki geriausiai. Nustatyk savo kainas.</p>

                        <div class="absolute top-4 right-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full opacity-50"></div>
                        </div>
                    </div>
                </div>

                <!-- Benefit 3 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-white to-purple-100 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-purple-100 rounded-full blur-2xl opacity-50 scale-75"></div>
                            <img src="/images/pt_icon3.png" alt="Nauji Klientai" class="h-32 w-auto relative z-10 transform group-hover:scale-110 transition-transform duration-300" draggable="false">
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">Nauji Klientai</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Prieik prie plataus klientų tinklo be jokių rinkodaros išlaidų.</p>

                        <div class="absolute top-4 right-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full opacity-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute h-64 w-64 bg-primary-light rounded-full -top-32 -left-32"></div>
            <div class="absolute h-64 w-64 bg-primary-light rounded-full -bottom-32 -right-32"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-primary-light mb-4">Kaip tai veikia?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Paprastas procesas, kuris padės tau pradėti uždirbti</p>
            </div>

            <div class="relative">
                <!-- Connection line for desktop -->
                <div class="hidden md:block absolute top-10 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-primary-light to-transparent opacity-20"></div>

                <div class="grid md:grid-cols-4 gap-8 relative">
                    <!-- Step 1 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <!-- Animated ring -->
                            <div class="absolute inset-0 bg-primary-light rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>

                            <div class="relative w-20 h-20 bg-gradient-to-br from-primary-light to-primary-verylight rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>

                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Užsiregistruok</h3>
                        <p class="text-gray-600 leading-relaxed">Sukurk savo profilį vos per kelias minutes.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-primary-light rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>

                            <div class="relative w-20 h-20 bg-gradient-to-br from-primary-light to-primary-verylight rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Gauk Patvirtinimą</h3>
                        <p class="text-gray-600 leading-relaxed">Mūsų komanda peržiūrės tavo paraišką ir susisieks su tavim.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-primary-light rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>

                            <div class="relative w-20 h-20 bg-gradient-to-br from-primary-light to-primary-verylight rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>

                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Gauk Užsakymus</h3>
                        <p class="text-gray-600 leading-relaxed">Klientai galės matyti tavo paslaugas ir siųsti užklausas.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-green-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>

                            <div class="relative w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Uždirbk</h3>
                        <p class="text-gray-600 leading-relaxed">Atlik darbą ir užsidirbk pinigų.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-primary-light mb-4">Ką sako mūsų partneriai</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Realios istorijos iš mūsų bendruomenės</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <!-- Quote icon -->
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-primary-light to-primary-verylight rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="flex items-center mb-6 mt-4">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    TK
                                </div>
                                <!-- Status indicator -->
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Tomas K.</h4>
                                <p class="text-sm text-gray-500 font-medium">Namų remonto meistras</p>
                                <div class="flex mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed italic">"Prisijungęs prie Qvicker galiu pasirinkti užsakymus, kurie man patinka. Per mėnesį uždirbu papildomai 400€, o tai man labai padeda."</p>

                        <!-- Badge -->
                        <div class="mt-6 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Patvirtintas partneris
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-100 to-emerald-100 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-primary-light to-primary-verylight rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="flex items-center mb-6 mt-4">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    LP
                                </div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Laura P.</h4>
                                <p class="text-sm text-gray-500 font-medium">Valytoja</p>
                                <div class="flex mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed italic">"Platformos dėka galiu dirbti tik tada, kai turiu laisvo laiko. Puikiai susiderinu su studijomis ir gaunu papildomų pajamų."</p>

                        <div class="mt-6 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Patvirtintas partneris
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="group relative lg:col-span-1 md:col-span-2">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-100 to-pink-100 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-primary-light to-primary-verylight rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="flex items-center mb-6 mt-4">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    MS
                                </div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Marius S.</h4>
                                <p class="text-sm text-gray-500 font-medium">Elektrikai</p>
                                <div class="flex mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed italic">"Klientų niekada netrūksta! Qvicker platforma suteikia man galimybę nuolat turėti darbo ir plėsti savo klientų ratą."</p>

                        <div class="mt-6 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Patvirtintas partneris
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 relative overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-light via-blue-600 to-primary-verylight"></div>

        <!-- Decorative shapes - consistent blend mode -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white rounded-full mix-blend-overlay opacity-10 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay opacity-10 translate-x-1/2 translate-y-1/2"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Pradėk uždirbti jau šiandien</h2>
                <p class="text-white/90 text-lg md:text-xl mb-10 leading-relaxed">Užsiregistruok vos per kelias minutes ir gauk pirmąjį užsakymą jau netrukus. Tapk nepriklausomu paslaugų teikėju ir valdyk savo karjerą.</p>

                <div class="inline-block relative group">
                    <!-- Button glow -->
                    <div class="absolute -inset-1 bg-white rounded-xl blur-md opacity-25 group-hover:opacity-50 transition duration-300"></div>

                    <a href="{{route('register.provider')}}" class="relative block">
                        <button class="relative bg-white text-primary-light p-20 font-bold py-5 px-10 rounded-xl hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 text-lg shadow-2xl">
                            Tapti Partneriu Dabar
                        </button>
                    </a>
                </div>

                <!-- Trust indicators -->
                <div class="mt-10 flex justify-center items-center space-x-8 text-white/80">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Nemokama registracija</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>100+ aktyvių partnerių</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-primary-light mb-4">Dažniausiai užduodami klausimai</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Turite klausimų? Čia rasite atsakymus</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <!-- FAQ Item 1 -->
                <div class="group">
                    <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-primary-light/30 hover:shadow-lg transition-all duration-300">
                        <button class="flex justify-between items-center w-full p-6 text-left">
                            <span class="text-lg font-semibold text-gray-800 group-hover:text-primary-light transition-colors duration-300">Kiek kainuoja registracija?</span>
                            <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-primary-light/10 rounded-full flex items-center justify-center transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-primary-light transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div class="px-6 pb-6">
                            <p class="text-gray-600 leading-relaxed">Registracija platformoje yra visiškai nemokama. Netrukus po registracijos, susisieksime su jumis trumpam pokalbiui - susipažinti.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="group">
                    <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-primary-light/30 hover:shadow-lg transition-all duration-300">
                        <button class="flex justify-between items-center w-full p-6 text-left">
                            <span class="text-lg font-semibold text-gray-800 group-hover:text-primary-light transition-colors duration-300">Kaip gausiu apmokėjimą?</span>
                            <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-primary-light/10 rounded-full flex items-center justify-center transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-primary-light transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div class="px-6 pb-6">
                            <p class="text-gray-600 leading-relaxed">Qvicker už mokėjimus kol kas neatsako, turite sutarti kainą su klientu ir gauti atsiskaitymą tiesiogiai po atliktų darbų.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="group">
                    <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-primary-light/30 hover:shadow-lg transition-all duration-300">
                        <button class="flex justify-between items-center w-full p-6 text-left">
                            <span class="text-lg font-semibold text-gray-800 group-hover:text-primary-light transition-colors duration-300">Kokių paslaugų teikėjų ieškote?</span>
                            <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-primary-light/10 rounded-full flex items-center justify-center transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-primary-light transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div class="px-6 pb-6">
                            <p class="text-gray-600 leading-relaxed">Mes ieškome įvairių sričių profesionalų: santechnikų, elektrikai, dailidžių, valytojų, sodinininkų, dizainerių ir kitų paslaugų teikėjų.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional help -->
            <div class="text-center mt-12">
                <p class="text-gray-600 mb-4">Neradote atsakymo į savo klausimą?</p>
                <a href="#" class="inline-flex items-center text-primary-light hover:text-primary-verylight font-semibold transition-colors duration-300">
                    <span>Susisiekite su mumis</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Final CTA -->
    <div class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-primary-light rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-800 mb-6">
                    Pradėk savo kelionę kaip
                    <span class="bg-gradient-to-r from-primary-light to-primary-verylight bg-clip-text text-transparent">Qvicker partneris</span>
                </h2>

                <p class="text-gray-600 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed">
                    Prisijunk prie augančios profesionalų bendruomenės ir pradėk uždirbti iš savo įgūdžių
                </p>

                <a href="{{route('register.provider')}}" class="group inline-block relative">
                    <!-- Button shadow/glow -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary-light to-primary-verylight rounded-xl blur-md opacity-30 group-hover:opacity-50 transition duration-300"></div>

                    <button class="relative bg-gradient-to-r from-primary-light to-primary-verylight text-white font-bold py-5 px-10 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center text-lg">
                        <span>Registruotis Dabar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </a>

                <!-- Success metrics -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-primary-light mb-2">100+</div>
                        <div class="text-gray-600">Aktyvių partnerių</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-primary-light mb-2">1k+</div>
                        <div class="text-gray-600">Atliktų užsakymų</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-primary-light mb-2">4.8★</div>
                        <div class="text-gray-600">Įvertinimas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-primary-light mb-2">24h</div>
                        <div class="text-gray-600">Iki pirmo užsakymo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
