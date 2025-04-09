@extends('layouts.main')

@section('content')

    <!-- Hero Section -->
    <div class="py-16 md:py-24">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary-light font-sans leading-tight mb-6">
                    Išnaudok savo sugebėjimus ir uždirbk daugiau
                </h1>
                <p class="mt-6 text-lg text-gray-700 font-sans max-w-3xl mx-auto">
                    Tapk WorkLink partneriu ir pradėk gauti užsakymus jau šiandien. Dirbk savo tempu, valdyk savo laiką ir užsidirbk daugiau darydamas tai, ką mėgsti.
                </p>
                <div class="mt-10">
                    <a href="/register/provider" class="inline-block">
                        <button class="tracking-wide font-semibold bg-primary-light text-white py-4 px-8 rounded-lg hover:bg-primary-verylight transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none text-lg">
                            <span>Tapti Partneriu</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->

    <div class="py-16 bg-primary-light bg-opacity-95 rounded-xl">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-2xl md:text-4xl font-bold text-center text-white mb-12">Kodėl verta prisijungti?</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex justify-center mb-4">
                        <img src="/images/pt_icon1.png" alt="Lankstus Grafikas" class="h-32 w-auto" draggable="false">
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 text-center">Lankstus Grafikas</h3>
                    <p class="text-gray-600">Dirbk kada nori ir kiek nori. Tu visiškai kontroliuoji savo darbo laiką.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex justify-center mb-4">
                        <img src="/images/pt_icon2.png" alt="Papildomos Pajamos" class="h-32 w-auto" draggable="false">
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 text-center">Papildomos Pajamos</h3>
                    <p class="text-gray-600">Užsidirbk papildomai darant tai, ką moki geriausiai. Nustatyk savo kainas.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex justify-center mb-4">
                        <img src="/images/pt_icon3.png" alt="Nauji Klientai" class="h-32 w-auto" draggable="false">
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 text-center">Nauji Klientai</h3>
                    <p class="text-gray-600">Prieik prie plataus klientų tinklo be jokių rinkodaros išlaidų.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-primary-light mb-12">Kaip tai veikia?</h2>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Užsiregistruok</h3>
                    <p class="text-gray-600">Sukurk savo profilį vos per kelias minutes.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Gauk Patvirtinimą</h3>
                    <p class="text-gray-600">Mūsų komanda peržiūrės tavo paraišką ir susisieks su tavim.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Gauk Užsakymus</h3>
                    <p class="text-gray-600">Klientai galės matyti tavo paslaugas ir siųsti užklausas.</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Uždirbk</h3>
                    <p class="text-gray-600">Atlik darbą ir užsidirbk pinigų.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="py-16 rounded-t-xl">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-primary-light mb-12">Ką sako mūsų partneriai</h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold">Tomas K.</h4>
                            <p class="text-sm text-gray-500">Namų remonto meistras</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Prisijungęs prie WorkLink galiu pasirinkti užsakymus, kurie man patinka. Per mėnesį uždirbu papildomai 400€, o tai man labai padeda."</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold">Laura P.</h4>
                            <p class="text-sm text-gray-500">Valytoja</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Platformos dėka galiu dirbti tik tada, kai turiu laisvo laiko. Puikiai susiderinu su studijomis ir gaunu papildomų pajamų."</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm lg:col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold">Marius S.</h4>
                            <p class="text-sm text-gray-500">Elektrikai</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Klientų niekada netrūksta! WorkLink platforma suteikia man galimybę nuolat turėti darbo ir plėsti savo klientų ratą."</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-12 bg-primary-light">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">Pradėk uždirbti jau šiandien</h2>
            <p class="text-white/80 max-w-2xl mx-auto mb-8">Užsiregistruok vos per kelias minutes ir gauk pirmąjį užsakymą jau netrukus. Tapk nepriklausomu paslaugų teikėju ir valdyk savo karjerą.</p>
            <a href="/register/provider">
                <button class="tracking-wide font-semibold bg-white text-primary-light py-4 px-8 rounded-lg hover:bg-gray-100 transition-all duration-300 ease-in-out focus:shadow-outline focus:outline-none text-lg">
                    Tapti Partneriu Dabar
                </button>
            </a>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="py-16 bg-white rounded-b-xl">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-primary-light mb-12">Dažniausiai užduodami klausimai</h2>

            <div class="max-w-3xl mx-auto space-y-6">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="flex justify-between items-center w-full p-4 text-left font-semibold">
                        <span>Kiek kainuoja registracija?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="p-4 pt-0">
                        <p class="text-gray-600">Registracija platformoje yra visiškai nemokama. Mes imame tik nedidelį procentą nuo sėkmingai atliktų užsakymų.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="flex justify-between items-center w-full p-4 text-left font-semibold">
                        <span>Kaip gausiu apmokėjimą?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="p-4 pt-0">
                        <p class="text-gray-600">Klientai moka per platformą. Pinigai pervedami į jūsų banko sąskaitą kas savaitę arba po kiekvieno užsakymo, pagal jūsų pasirinkimą.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="flex justify-between items-center w-full p-4 text-left font-semibold">
                        <span>Kokių paslaugų teikėjų ieškote?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="p-4 pt-0">
                        <p class="text-gray-600">Mes ieškome įvairių sričių profesionalų: santechnikų, elektrikai, dailidžių, valytojų, sodinininkų, dizainerių ir kitų paslaugų teikėjų.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Final CTA -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-primary-light mb-8">Pradėk savo kelionę kaip WorkLink partneris</h2>
            <a href="/register/provider" class="inline-block">
                <button class="tracking-wide font-semibold bg-primary-light text-white py-4 px-8 rounded-lg hover:bg-primary-verylight transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none text-lg mx-auto">
                    <span>Registruotis Dabar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </a>
        </div>
    </div>
@endsection
