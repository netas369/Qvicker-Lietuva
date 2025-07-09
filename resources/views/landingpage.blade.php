@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
@endpush

@section('content')

    <!-- MAIN CONTENT DIV -->
    <div class="relative">
        <!-- Hero Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-purple-50 -z-10"></div>

        <!-- Decorative blobs -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>

        <div class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 lg:pt-32 md:pt-24 pt-16 pb-12 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-primary-light to-blue-600 bg-clip-text text-transparent leading-tight">
                    Rasti profesionalią pagalbą - dabar lengva.
                </h1>
                <div class="flex justify-center">
                    <p class="mt-8 text-lg md:text-xl text-gray-600 font-sans max-w-3xl leading-relaxed">
                        Susisiekite tiesiogiai su patikimais paslaugų teikėjais visiems namų poreikiams, nuo žolės pjovimo iki dažymo ir dar daugiau.
                    </p>
                </div>
            </div>

            <div class="mt-12 relative">
                <!-- Glow effect behind search bar -->
                <div class="absolute inset-0 bg-gradient-to-r from-primary-light/20 to-blue-600/20 blur-3xl"></div>
                <div class="relative">
                    @livewire('search-bar')
                </div>
            </div>

            <!-- Enhanced separator -->
            <div class="flex justify-center items-center space-x-4 mx-auto max-w-md my-16">
                <div class="w-20 h-1.5 bg-gradient-to-r from-transparent to-primary-light rounded-full"></div>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-light to-primary-light rounded-full"></div>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-light to-transparent rounded-full"></div>
            </div>

            @include('components.landingpage-categories', ['categories' => $categories])

            <!-- How it works section - Enhanced -->
            <section class="py-20 md:py-24 relative bg-gradient-to-b from-gray-50/50 to-white rounded-3xl mt-16">
                <div class="w-full max-w-7xl px-4 md:px-8 mx-auto">
                    <div class="w-full flex-col justify-start items-center gap-16 inline-flex">
                        <!-- Section header -->
                        <div class="w-full max-w-2xl mx-auto flex-col justify-start items-center gap-6 flex">
                            <span class="px-4 py-2 bg-primary-light/10 text-primary-light rounded-full text-sm font-semibold">
                                Paprastas procesas
                            </span>
                            <h2 class="text-primary-light text-4xl md:text-5xl font-bold">
                                Kaip viskas veikia
                            </h2>
                            <p class="text-center text-gray-600 text-lg md:text-xl">
                                Raskite profesionalią pagalbą vos trimis paprastais žingsniais
                            </p>
                        </div>

                        <!-- Process steps - Enhanced -->
                        <div class="w-full justify-between items-center gap-8 flex md:flex-row flex-col relative">
                            <!-- Connection line for desktop -->
                            <div class="hidden md:block absolute top-24 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-primary-light/30 to-transparent z-0"></div>

                            <!-- Step 1 -->
                            <div class="md:w-1/3 p-6 flex-col justify-start items-center gap-6 inline-flex group relative z-10">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-primary-light/20 rounded-full blur-2xl scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                                    <div class="relative md:w-36 md:h-36 w-32 h-32 rounded-full flex items-center justify-center mb-2 bg-white shadow-xl group-hover:shadow-2xl transition-all duration-300">
                                        <img src="{{ asset('images/lp_icon1.png') }}" alt="pasirinkite-kategorija" class="transform group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                    <div class="absolute -top-2 -right-2 w-10 h-10 bg-gradient-to-br from-primary-light to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                        1
                                    </div>
                                </div>
                                <h4 class="text-center text-gray-800 text-xl font-bold">Pasirinkite kategoriją</h4>
                                <p class="text-center text-gray-500 leading-relaxed">
                                    Greitai raskite reikiamą paslaugą naudodami paiešką arba naršykite kategorijose.
                                </p>
                            </div>

                            <!-- Connector for desktop -->
                            <div class="hidden md:flex items-center z-10">
                                <div class="w-12 h-12 rounded-full bg-primary-light/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5.50159 6L11.5018 12.0002L5.49805 18.004M12.5016 6L18.5018 12.0002L12.498 18.004" stroke="#266867" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="md:w-1/3 p-6 flex-col justify-start items-center gap-6 inline-flex group relative z-10">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-primary-light/20 rounded-full blur-2xl scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                                    <div class="relative md:w-36 md:h-36 w-32 h-32 rounded-full flex items-center justify-center mb-2 bg-white shadow-xl group-hover:shadow-2xl transition-all duration-300">
                                        <img src="{{ asset('images/lp_icon2.png') }}" alt="isirinkite-tiekeja" class="transform group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                    <div class="absolute -top-2 -right-2 w-10 h-10 bg-gradient-to-br from-primary-light to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                        2
                                    </div>
                                </div>
                                <h4 class="text-center text-gray-800 text-xl font-bold">Išsirinkite freelancerį</h4>
                                <p class="text-center text-gray-500 leading-relaxed">
                                    Peržiūrėkite įvertinimus, kainas ir patirtį, kad rastumėte geriausią specialistą.
                                </p>
                            </div>

                            <!-- Connector for desktop -->
                            <div class="hidden md:flex items-center z-10">
                                <div class="w-12 h-12 rounded-full bg-primary-light/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5.50159 6L11.5018 12.0002L5.49805 18.004M12.5016 6L18.5018 12.0002L12.498 18.004" stroke="#266867" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="md:w-1/3 p-6 flex-col justify-start items-center gap-6 inline-flex group relative z-10">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-green-500/20 rounded-full blur-2xl scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                                    <div class="relative md:w-36 md:h-36 w-32 h-32 rounded-full flex items-center justify-center mb-2 bg-white shadow-xl group-hover:shadow-2xl transition-all duration-300">
                                        <img src="{{ asset('images/lp_icon3.png') }}" alt="susisiekite-ir-uzsisakykite" class="transform group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                    <div class="absolute -top-2 -right-2 w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                        3
                                    </div>
                                </div>
                                <h4 class="text-center text-gray-800 text-xl font-bold">Susisiekite ir užsakykite</h4>
                                <p class="text-center text-gray-500 leading-relaxed">
                                    Tiesiogiai susisiekite, aptarkite detales ir po paslaugos suteikimo palikite atsiliepimą.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Partner CTA - Enhanced -->
            <div class="relative overflow-hidden my-16 max-w-4xl mx-auto">
                <!-- Background gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-light via-blue-600 to-primary-verylight rounded-2xl"></div>

                <!-- Pattern overlay -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-60 h-60 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
                </div>

                <div class="relative text-white items-center text-center flex flex-col p-12">
                    <h2 class="font-bold text-3xl md:text-4xl mb-4">
                        Norite tapti mūsų partneriu ir gauti papildomų pajamų?
                    </h2>
                    <p class="mx-auto mt-4 max-w-lg text-lg md:text-xl leading-relaxed text-white/90 mb-8">
                        Prisijunkite dabar ir išnaudokite visas galimybes!
                    </p>
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-white rounded-xl blur opacity-25 group-hover:opacity-50 transition duration-300"></div>
                        <a class="relative inline-block rounded-xl bg-white px-8 py-4 text-base font-semibold text-primary-light hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-xl" href="/register/provider">
                            Registruotis
                        </a>
                    </div>
                </div>
            </div>

            <!-- Testimonials Section - Enhanced -->
            <section class="py-24 relative">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center items-center gap-y-8 lg:gap-y-0 flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between lg:gap-x-8 max-w-sm sm:max-w-2xl lg:max-w-full mx-auto">
                        <div class="w-full lg:w-2/5">
                            <span class="text-sm text-gray-500 font-semibold mb-4 block uppercase tracking-wider">Atsiliepimai</span>
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-8">
                                Jau daugiau nei 100+ klientų paliko
                                <span class="bg-gradient-to-r from-primary-dark to-primary-verylight bg-clip-text text-transparent">
                                    Atsiliepimą
                                </span>
                            </h2>
                            <!-- Enhanced slider controls -->
                            <div class="flex items-center justify-center lg:justify-start gap-4">
                                <button id="slider-button-left" class="swiper-button-left group flex justify-center items-center bg-white border-2 border-primary-light w-14 h-14 transition-all duration-300 rounded-full hover:bg-primary-light shadow-lg hover:shadow-xl" data-carousel-prev>
                                    <svg class="h-6 w-6 text-primary-light group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.9999 12L4.99992 12M9.99992 6L4.70703 11.2929C4.3737 11.6262 4.20703 11.7929 4.20703 12C4.20703 12.2071 4.3737 12.3738 4.70703 12.7071L9.99992 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button id="slider-button-right" class="swiper-button-right group flex justify-center items-center bg-white border-2 border-primary-light w-14 h-14 transition-all duration-300 rounded-full hover:bg-primary-light shadow-lg hover:shadow-xl" data-carousel-next>
                                    <svg class="h-6 w-6 text-primary-light group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 12L19 12M14 18L19.2929 12.7071C19.6262 12.3738 19.7929 12.2071 19.7929 12C19.7929 11.7929 19.6262 11.6262 19.2929 11.2929L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="w-full lg:w-3/5">
                            <!--Enhanced slider wrapper-->
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <!-- Testimonial 1 -->
                                    <div class="swiper-slide">
                                        <div class="group bg-white border-2 border-gray-100 rounded-2xl p-8 transition-all duration-500 hover:border-primary-light/50 hover:shadow-2xl relative overflow-hidden">
                                            <!-- Decorative element -->
                                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-light/10 to-transparent rounded-bl-full"></div>

                                            <div class="flex items-center gap-5 mb-6 relative z-10">
                                                <div class="relative">
                                                    <img class="w-16 h-16 rounded-full object-cover ring-4 ring-primary-light/20" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar">
                                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white"></div>
                                                </div>
                                                <div class="grid gap-1">
                                                    <h5 class="text-gray-900 font-bold text-lg">Jurga S.</h5>
                                                    <span class="text-sm leading-6 text-gray-500 font-medium">Direktore</span>
                                                </div>
                                            </div>
                                            <div class="flex items-center mb-6 gap-1 text-amber-400">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="text-gray-600 leading-relaxed min-h-[96px]">
                                                Reikėjo greitos fotografės paslaugos, dėka myapp Lietuva, turėjau galimybė greitai rasti profesionalią fotografę.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Testimonial 2 -->
                                    <div class="swiper-slide">
                                        <div class="group bg-white border-2 border-gray-100 rounded-2xl p-8 transition-all duration-500 hover:border-primary-light/50 hover:shadow-2xl relative overflow-hidden">
                                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-light/10 to-transparent rounded-bl-full"></div>

                                            <div class="flex items-center gap-5 mb-6 relative z-10">
                                                <div class="relative">
                                                    <img class="w-16 h-16 rounded-full object-cover ring-4 ring-primary-light/20" src="https://pagedone.io/asset/uploads/1696229994.png" alt="avatar">
                                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white"></div>
                                                </div>
                                                <div class="grid gap-1">
                                                    <h5 class="text-gray-900 font-bold text-lg">Tomas S.</h5>
                                                    <span class="text-sm leading-6 text-gray-500 font-medium">Darbininkas</span>
                                                </div>
                                            </div>
                                            <div class="flex items-center mb-6 gap-1 text-amber-400">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="text-gray-600 leading-relaxed min-h-[96px]">
                                                Reikėjo pagalbos kraustantis į kitą butą, my app lietuva leido man greitai surasti puikią pagalbą, vienas nebūčiau susitvarkes.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Testimonial 3 -->
                                    <div class="swiper-slide">
                                        <div class="group bg-white border-2 border-gray-100 rounded-2xl p-8 transition-all duration-500 hover:border-primary-light/50 hover:shadow-2xl relative overflow-hidden">
                                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-light/10 to-transparent rounded-bl-full"></div>

                                            <div class="flex items-center gap-5 mb-6 relative z-10">
                                                <div class="relative">
                                                    <img class="w-16 h-16 rounded-full object-cover ring-4 ring-primary-light/20" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar">
                                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white"></div>
                                                </div>
                                                <div class="grid gap-1">
                                                    <h5 class="text-gray-900 font-bold text-lg">Urte N.</h5>
                                                    <span class="text-sm leading-6 text-gray-500 font-medium">CEO</span>
                                                </div>
                                            </div>
                                            <div class="flex items-center mb-6 gap-1 text-amber-400">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="text-gray-600 leading-relaxed min-h-[96px]">
                                                Reikejo papildomu ranku organizuojant rengini, myapp leido greitai surasti talentinga mergina pagalbai.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Enhanced separator -->
            <div class="flex justify-center items-center space-x-4 mx-auto max-w-md mt-8 mb-16">
                <div class="w-20 h-1.5 bg-gradient-to-r from-transparent to-primary-light rounded-full"></div>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-light to-primary-light rounded-full"></div>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-light to-transparent rounded-full"></div>
            </div>

            <!-- About Section - Fully Responsive -->
            <section class="py-12 sm:py-16 md:py-20 relative">
                <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
                    <div class="w-full justify-start items-center gap-8 md:gap-12 grid lg:grid-cols-2 grid-cols-1">
                        <div class="w-full flex-col justify-center lg:items-start items-center gap-6 sm:gap-8 md:gap-10 inline-flex">
                            <div class="w-full flex-col justify-center items-start gap-6 md:gap-8 flex">
                                <div class="w-full flex-col justify-start lg:items-start items-center gap-3 md:gap-4 flex">
                        <span class="px-3 md:px-4 py-1.5 md:py-2 bg-primary-light/10 text-primary-light rounded-full text-xs md:text-sm font-semibold">
                            Apie mus
                        </span>
                                    <h2 class="text-primary text-3xl sm:text-4xl md:text-5xl font-bold leading-tight lg:text-start text-center">
                                        Skatiname Bendruomenes Dirbti Kartu
                                    </h2>
                                    <p class="text-gray-600 text-base md:text-lg font-normal leading-relaxed lg:text-start text-center">
                                        MyAPP Lietuva sujungia žmones, kuriems reikia paslaugų, su patikimais specialistais jų mieste. Mūsų platforma pagrįsta pasitikėjimu ir bendradarbiavimu - nuo kasdienių darbų iki profesionalių paslaugų, padedame paprastai ir greitai rasti reikiamą pagalbą.
                                    </p>
                                </div>

                                <!-- Enhanced responsive stats grid -->
                                <div class="w-full grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                                    <div class="group">
                                        <div class="flex-col justify-start items-start inline-flex p-4 sm:p-5 md:p-6 rounded-2xl bg-gradient-to-br from-primary-light/5 to-primary-light/10 hover:from-primary-light/10 hover:to-primary-light/20 transition-all duration-300 w-full">
                                            <h3 class="text-primary-light text-2xl sm:text-xl md:text-4xl font-bold leading-tight group-hover:scale-110 transform transition-transform duration-300">
                                                50+
                                            </h3>
                                            <h6 class="text-gray-600 text-sm md:text-base font-medium mt-1 md:mt-2">Paslaugų Rūšių</h6>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div class="flex-col justify-start items-start inline-flex p-4 sm:p-5 md:p-6 rounded-2xl bg-gradient-to-br from-blue-500/5 to-blue-500/10 hover:from-blue-500/10 hover:to-blue-500/20 transition-all duration-300 w-full">
                                            <h4 class="text-blue-600 text-2xl sm:text-xl md:text-4xl font-bold leading-tight group-hover:scale-110 transform transition-transform duration-300">
                                                5000+
                                            </h4>
                                            <h6 class="text-gray-600 text-sm md:text-base font-medium mt-1 md:mt-2">Atliktų Užsakymų</h6>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div class="flex-col justify-start items-start inline-flex p-4 sm:p-5 md:p-6 rounded-2xl bg-gradient-to-br from-green-500/5 to-green-500/10 hover:from-green-500/10 hover:to-green-500/20 transition-all duration-300 w-full">
                                            <h4 class="text-green-600 text-2xl sm:text-xl md:text-4xl font-bold leading-tight group-hover:scale-110 transform transition-transform duration-300">
                                                500+
                                            </h4>
                                            <h6 class="text-gray-600 text-sm md:text-base font-medium mt-1 md:mt-2">Įvairių Sričių Partnerių</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced responsive image section -->
                        <div class="w-full justify-center items-start gap-4 md:gap-6 grid sm:grid-cols-2 grid-cols-1 lg:order-last order-first">
                            <div class="pt-12 sm:pt-16 md:pt-24 lg:justify-center sm:justify-end justify-start items-start gap-2.5 flex">
                                <div class="relative group w-full">
                                    <div class="absolute -inset-2 sm:-inset-3 md:-inset-4 bg-gradient-to-r from-primary-light to-blue-600 rounded-2xl blur-xl opacity-25 group-hover:opacity-50 transition duration-300"></div>
                                    <img class="relative rounded-2xl object-cover shadow-2xl w-full h-64 sm:h-72 md:h-80 lg:h-auto" src="{{ asset('images/delivery-man.jpg') }}" alt="Delivery service professional"/>
                                </div>
                            </div>
                            <div class="relative group w-full">
                                <div class="absolute -inset-2 sm:-inset-3 md:-inset-4 bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl blur-xl opacity-25 group-hover:opacity-50 transition duration-300"></div>
                                <img class="relative sm:ml-0 ml-auto rounded-2xl object-cover shadow-2xl w-full h-64 sm:h-72 md:h-80 lg:h-auto" src="{{ asset('images/wedding-planner1.jpg') }}" alt="Wedding planning service"/>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // ============= TAB FUNCTIONALITY =============
            const tabButtons = document.querySelectorAll("[data-tabs-target]");
            const tabPanels = document.querySelectorAll("[role='tabpanel']");

            // Get active and inactive classes from data attributes
            const tabsToggle = document.querySelector('[data-tabs-toggle]');
            const activeClasses = tabsToggle?.getAttribute('data-tabs-active-classes')?.split(' ') ||
                ["text-primary-light", "border-b-2", "border-primary-light", "font-semibold"];
            const inactiveClasses = tabsToggle?.getAttribute('data-tabs-inactive-classes')?.split(' ') ||
                ["text-gray-500", "hover:text-gray-600", "hover:border-gray-300"];

            // Function to handle tab switching
            const switchTab = (targetId) => {
                // Hide all panels
                tabPanels.forEach((tabPanel) => {
                    if (tabPanel.id === targetId) {
                        tabPanel.classList.remove("hidden");
                    } else {
                        tabPanel.classList.add("hidden");
                    }
                });

                // Update classes on tab buttons
                tabButtons.forEach((tabButton) => {
                    const tabTarget = tabButton.getAttribute("data-tabs-target").substring(1);

                    if (tabTarget === targetId) {
                        // Add active classes
                        activeClasses.forEach(cls => tabButton.classList.add(cls));
                        // Remove inactive classes
                        inactiveClasses.forEach(cls => tabButton.classList.remove(cls));
                        tabButton.setAttribute('aria-selected', 'true');

                        // Sync selection between mobile and desktop versions
                        const buttonId = tabButton.getAttribute('id') || '';
                        let counterpartId = '';

                        if (buttonId.startsWith('desktop-')) {
                            counterpartId = buttonId.replace('desktop-', '');
                        } else {
                            counterpartId = 'desktop-' + buttonId;
                        }

                        const counterpartButton = document.getElementById(counterpartId);
                        if (counterpartButton) {
                            // Apply active classes to counterpart button
                            activeClasses.forEach(cls => counterpartButton.classList.add(cls));
                            inactiveClasses.forEach(cls => counterpartButton.classList.remove(cls));
                            counterpartButton.setAttribute('aria-selected', 'true');
                        }
                    } else {
                        // Remove active classes
                        activeClasses.forEach(cls => tabButton.classList.remove(cls));
                        // Add inactive classes
                        inactiveClasses.forEach(cls => tabButton.classList.add(cls));
                        tabButton.setAttribute('aria-selected', 'false');
                    }
                });
            };

            // Add event listeners to all tab buttons
            tabButtons.forEach((button) => {
                button.addEventListener("click", () => {
                    const targetId = button.getAttribute("data-tabs-target").substring(1);
                    switchTab(targetId);
                });
            });

            // Initialize the first tab as active
            if (tabButtons.length > 0) {
                const firstTabId = tabButtons[0].getAttribute("data-tabs-target").substring(1);
                switchTab(firstTabId);
            }

            // ============= SWIPER INITIALIZATION =============
            // Initialize the main Swiper instance if it exists
            const swiperContainer = document.querySelector('.swiper-container');
            if (swiperContainer) {
                const swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1, // Default to 1 slide per view
                    spaceBetween: 20, // Space between slides
                    centeredSlides: true, // Center the active slide
                    loop: true, // Enable infinite looping
                    autoplay: {
                        delay: 3000, // Move to the next slide every 3 seconds
                        disableOnInteraction: false,
                    },
                    autoHeight: true, // Adjust height based on content
                    navigation: {
                        nextEl: '.swiper-button-next', // Class for the "next" button
                        prevEl: '.swiper-button-prev', // Class for the "previous" button
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: 2, // Show 2 slides per view on larger screens
                            centeredSlides: false,
                        },
                    },
                });
            }

            // Initialize the specific Swiper instance for the "mySwiper" class
            const mySwiperContainer = document.querySelector('.mySwiper');
            if (mySwiperContainer) {
                const reviewSwiper = new Swiper('.mySwiper', {
                    slidesPerView: 2,
                    spaceBetween: 28,
                    centeredSlides: false,
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '#slider-button-right', // Specific navigation buttons for this Swiper
                        prevEl: '#slider-button-left',
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                            spaceBetween: 20,
                            centeredSlides: false,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 28,
                            centeredSlides: false,
                        },
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 32,
                        },
                    },
                });
            }
        });
    </script>

@endsection
