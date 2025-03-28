@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

@section('content')


    <!-- MAIN CONTENT DIV -->
    <div class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 lg:mt-24 md:mt-14">
        <div class="text-center mt-10">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary-light font-sans leading-7">Rasti profesionalią pagalbą - dabar lengva.</h1>
            <p class="mt-10 text-lg text-primary-light font-sans">Susisiekite tiesiogiai su patikimais paslaugų teikėjais visiems namų poreikiams, nuo žolės
        pjovimo iki dažymo ir dar daugiau.</p>
        </div>
    <div>

        @livewire('search-bar')

        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md my-8 mt-12">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>


        @include('components.landingpage-categories', ['categories' => $categories])


        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md ">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>

        <!-- kaip mes veikiame -->
        <section class="py-16 md:py-24 relative bg-gray-50">
            <div class="w-full max-w-7xl px-4 md:px-8 mx-auto">
                <div class="w-full flex-col justify-start items-center gap-12 inline-flex">
                    <!-- Section header -->
                    <div class="w-full max-w-2xl mx-auto flex-col justify-start items-center gap-4 flex">
                        <h2 class="text-primary-light text-3xl md:text-4xl font-bold font-manrope">Kaip viskas veikia</h2>
                        <p class="text-center text-gray-600 text-lg">Raskite profesionalią pagalbą vos trimis paprastais žingsniais</p>
                    </div>

                    <!-- Process steps -->
                    <div class="w-full justify-between items-center gap-4 flex md:flex-row flex-col">
                        <!-- Step 1 -->
                        <div class="md:w-1/3 p-6 flex-col justify-start items-center gap-4 inline-flex">
                            <div class="w-16 h-16 rounded-full bg-primary-light/10 flex items-center justify-center mb-2">
                                <!-- Icon could go here -->
                                <span class="text-primary-light text-2xl font-bold">1</span>
                            </div>
                            <h4 class="text-center text-primary text-xl font-semibold">Pasirinkite kategoriją</h4>
                            <p class="text-center text-gray-500">Greitai raskite reikiamą paslaugą naudodami paiešką arba naršykite kategorijose.</p>
                        </div>

                        <!-- Connector for desktop -->
                        <div class="hidden md:flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5.50159 6L11.5018 12.0002L5.49805 18.004M12.5016 6L18.5018 12.0002L12.498 18.004" stroke="#266867" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <!-- Step 2 -->
                        <div class="md:w-1/3 p-6 flex-col justify-start items-center gap-4 inline-flex">
                            <div class="w-16 h-16 rounded-full bg-primary-light/10 flex items-center justify-center mb-2">
                                <!-- Icon could go here -->
                                <span class="text-primary-light text-2xl font-bold">2</span>
                            </div>
                            <h4 class="text-center text-primary text-xl font-semibold">Išsirinkite freelancerį</h4>
                            <p class="text-center text-gray-500">Peržiūrėkite įvertinimus, kainas ir patirtį, kad rastumėte geriausią specialistą.</p>
                        </div>

                        <!-- Connector for desktop -->
                        <div class="hidden md:flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5.50159 6L11.5018 12.0002L5.49805 18.004M12.5016 6L18.5018 12.0002L12.498 18.004" stroke="#266867" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <!-- Step 3 -->
                        <div class="md:w-1/3 p-6 flex-col justify-start items-center gap-4 inline-flex">
                            <div class="w-16 h-16 rounded-full bg-primary-light/10 flex items-center justify-center mb-2">
                                <!-- Icon could go here -->
                                <span class="text-primary-light text-2xl font-bold">3</span>
                            </div>
                            <h4 class="text-center text-primary text-xl font-semibold">Susisiekite ir užsakykite</h4>
                            <p class="text-center text-gray-500">Tiesiogiai susisiekite, aptarkite detales ir po paslaugos suteikimo palikite atsiliepimą.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md my-8 mt-4">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>



{{--        <h2 class="w-full text-center text-primary-light text-4xl font-bold font-manrope leading-normal mb-12">Patikimiausi Partneriai</h2>--}}

{{--        <!-- Karusele su profiliais -->--}}
{{--        <div class="flex flex-wrap justify-center gap-4 relative">--}}
{{--            <!-- Navigation Buttons -->--}}
{{--            <div class="swiper-button-prev absolute left-4 top-1/2 transform -translate-y-1/2 z-10 text-gray-800 hover:bg-gray-300 p-3 rounded-full shadow-md cursor-pointer">--}}
{{--                &lt; <!-- Replace with an icon if needed -->--}}
{{--            </div>--}}
{{--            <div class="swiper-button-next absolute right-4 top-1/2 transform -translate-y-1/2 z-10 text-gray-800 hover:bg-gray-300 p-3 rounded-full shadow-md cursor-pointer">--}}
{{--                &gt; <!-- Replace with an icon if needed -->--}}
{{--            </div>--}}
{{--            <div class="swiper-container">--}}
{{--                <div class="swiper-wrapper">--}}
{{--                    <!-- First Card -->--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <section class="border bg-neutral-100 p-4 rounded-lg max-w-full h-auto sm:h-64 min-h-[300px]">--}}
{{--                            <div class="mx-auto">--}}
{{--                                <div class="card md:flex max-w-lg">--}}
{{--                                    <div class="w-20 h-20 mx-auto mb-6 md:mr-6 flex-shrink-0">--}}
{{--                                        <img class="object-cover rounded-full" src="https://tailwindflex.com/public/images/user.png">--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow text-center md:text-left">--}}
{{--                                        <p class="font-bold">Medkirtys</p>--}}
{{--                                        <div class="flex items-center justify-center md:justify-start space-x-2">--}}
{{--                                            <h3 class="text-xl font-bold heading">Jonas Ponas</h3>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 fill-yellow">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="..." />--}}
{{--                                            </svg>--}}
{{--                                            <span class="text-md text-gray-600">(4.9)</span>--}}
{{--                                        </div>--}}
{{--                                        <p class="mt-2 mb-3">Jonas yra profesionalus medzio apdailininkas galintis padeti jums ivairiausiais klausimais.</p>--}}
{{--                                        <div class="flex flex-wrap gap-2 mt-3">--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Perkraustymas</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Santechnika</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Medkirtys</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </section>--}}
{{--                    </div>--}}

{{--                    <!-- Second Card -->--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <section class="border bg-neutral-100 p-4 rounded-lg max-w-full h-auto sm:h-64 min-h-[300px]">--}}
{{--                            <div class="mx-auto">--}}
{{--                                <div class="card md:flex max-w-lg">--}}
{{--                                    <div class="w-20 h-20 mx-auto mb-6 md:mr-6 flex-shrink-0">--}}
{{--                                        <img class="object-cover rounded-full" src="https://tailwindflex.com/public/images/user.png">--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow text-center md:text-left">--}}
{{--                                        <p class="font-bold">Medkirtys</p>--}}
{{--                                        <div class="flex items-center justify-center md:justify-start space-x-2">--}}
{{--                                            <h3 class="text-xl font-bold heading">Jonas Ponas</h3>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 fill-yellow">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="..." />--}}
{{--                                            </svg>--}}
{{--                                            <span class="text-md text-gray-600">(4.9)</span>--}}
{{--                                        </div>--}}
{{--                                        <p class="mt-2 mb-3">Jonas yra profesionalus medzio apdailininkas...</p>--}}
{{--                                        <div class="flex flex-wrap gap-2 mt-3">--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Perkraustymas</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Santechnika</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Medkirtys</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </section>--}}
{{--                    </div>--}}

{{--                    <!-- Second Card -->--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <section class="border bg-neutral-100 p-4 rounded-lg max-w-full h-auto sm:h-64 min-h-[300px]">--}}
{{--                            <div class="mx-auto">--}}
{{--                                <div class="card md:flex max-w-lg">--}}
{{--                                    <div class="w-20 h-20 mx-auto mb-6 md:mr-6 flex-shrink-0">--}}
{{--                                        <img class="object-cover rounded-full" src="https://tailwindflex.com/public/images/user.png">--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow text-center md:text-left">--}}
{{--                                        <p class="font-bold">Medkirtys</p>--}}
{{--                                        <div class="flex items-center justify-center md:justify-start space-x-2">--}}
{{--                                            <h3 class="text-xl font-bold heading">Jonas Ponas</h3>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 fill-yellow">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="..." />--}}
{{--                                            </svg>--}}
{{--                                            <span class="text-md text-gray-600">(4.9)</span>--}}
{{--                                        </div>--}}
{{--                                        <p class="mt-2 mb-3">Jonas yra profesionalus medzio apdailininkas...</p>--}}
{{--                                        <div class="flex flex-wrap gap-2 mt-3">--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Perkraustymas</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Santechnika</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Medkirtys</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </section>--}}
{{--                    </div>--}}

{{--                    <!-- Second Card -->--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <section class="border bg-neutral-100 p-4 rounded-lg max-w-full h-auto sm:h-64 min-h-[300px]">--}}
{{--                            <div class="mx-auto">--}}
{{--                                <div class="card md:flex max-w-lg">--}}
{{--                                    <div class="w-20 h-20 mx-auto mb-6 md:mr-6 flex-shrink-0">--}}
{{--                                        <img class="object-cover rounded-full" src="https://tailwindflex.com/public/images/user.png">--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow text-center md:text-left">--}}
{{--                                        <p class="font-bold">Medkirtys</p>--}}
{{--                                        <div class="flex items-center justify-center md:justify-start space-x-2">--}}
{{--                                            <h3 class="text-xl font-bold heading">Jonas Ponas</h3>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 fill-yellow">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="..." />--}}
{{--                                            </svg>--}}
{{--                                            <span class="text-md text-gray-600">(4.9)</span>--}}
{{--                                        </div>--}}
{{--                                        <p class="mt-2 mb-3">Jonas yra profesionalus medzio apdailininkas...</p>--}}
{{--                                        <div class="flex flex-wrap gap-2 mt-3">--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Perkraustymas</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Santechnika</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Medkirtys</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </section>--}}
{{--                    </div>--}}

{{--                    <!-- Second Card -->--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <section class="border bg-neutral-100 p-4 rounded-lg max-w-full h-auto sm:h-64 min-h-[300px]">--}}
{{--                            <div class="mx-auto">--}}
{{--                                <div class="card md:flex max-w-lg">--}}
{{--                                    <div class="w-20 h-20 mx-auto mb-6 md:mr-6 flex-shrink-0">--}}
{{--                                        <img class="object-cover rounded-full" src="https://tailwindflex.com/public/images/user.png">--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow text-center md:text-left">--}}
{{--                                        <p class="font-bold">Medkirtys</p>--}}
{{--                                        <div class="flex items-center justify-center md:justify-start space-x-2">--}}
{{--                                            <h3 class="text-xl font-bold heading">Jonas Ponas</h3>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 fill-yellow">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="..." />--}}
{{--                                            </svg>--}}
{{--                                            <span class="text-md text-gray-600">(4.9)</span>--}}
{{--                                        </div>--}}
{{--                                        <p class="mt-2 mb-3">Jonas yra profesionalus medzio apdailininkas...</p>--}}
{{--                                        <div class="flex flex-wrap gap-2 mt-3">--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Perkraustymas</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Santechnika</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Medkirtys</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </section>--}}
{{--                    </div>--}}

{{--                    <!-- Second Card -->--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <section class="border bg-neutral-100 p-4 rounded-lg max-w-full h-auto sm:h-64 min-h-[300px]">--}}
{{--                            <div class="mx-auto">--}}
{{--                                <div class="card md:flex max-w-lg">--}}
{{--                                    <div class="w-20 h-20 mx-auto mb-6 md:mr-6 flex-shrink-0">--}}
{{--                                        <img class="object-cover rounded-full" src="https://tailwindflex.com/public/images/user.png">--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow text-center md:text-left">--}}
{{--                                        <p class="font-bold">Medkirtys</p>--}}
{{--                                        <div class="flex items-center justify-center md:justify-start space-x-2">--}}
{{--                                            <h3 class="text-xl font-bold heading">Jonas Ponas</h3>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 fill-yellow">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="..." />--}}
{{--                                            </svg>--}}
{{--                                            <span class="text-md text-gray-600">(4.9)</span>--}}
{{--                                        </div>--}}
{{--                                        <p class="mt-2 mb-3">Jonas yra profesionalus medzio apdailininkas...</p>--}}
{{--                                        <div class="flex flex-wrap gap-2 mt-3">--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Perkraustymas</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Santechnika</span>--}}
{{--                                            <span class="bg-gray-200 border px-3 py-1.5 rounded-lg text-sm">Medkirtys</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </section>--}}
{{--                    </div>--}}
{{--                    <!-- Add more cards here -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Tapk Partneriu -->
        <div class="overflow-hidden my-4 py-12 max-w-3xl mx-auto rounded-lg">
            <div class="text-primary-light items-center text-center flex flex-col shadow-md p-6">
                <h2 class="font-extrabold text-3xl md:text-3xl sm:text-1xl mb-2">Norite tapti mūsų partneriu ir gauti papildomų pajamų?</h2>
                <p class="mx-auto mt-4 max-w-lg text-md md:text-lg leading-7 text-gray-600 mb-2">
                    Prisijunkite dabar ir išnaudokite visas galimybes!
                </p>
                <a class="mt-6 mb-4 rounded-lg bg-primary-light px-6 py-3 text-base font-medium leading-6 text-white hover:bg-primary-verylight transition focus:outline-none focus:ring focus:border-primary-dark"
                   href="/register">Registruotis</a>
            </div>
        </div>

        <section class="py-24 ">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    class="flex justify-center items-center gap-y-8 lg:gap-y-0 flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between lg:gap-x-8 max-w-sm sm:max-w-2xl lg:max-w-full mx-auto">
                    <div class="w-full lg:w-2/5">
                        <span class="text-sm text-gray-500 font-medium mb-4 block">Atsiliepimai</span>
                        <h2 class="text-4xl font-bold text-gray-900 leading-[3.25rem] mb-8">Jau daugiau nei 100+ klientų paliko <span
                                class=" text-transparent bg-clip-text bg-gradient-to-tr from-primary-dark to-primary-verylight">Atsiliepimą</span>
                        </h2>
                        <!-- Slider controls -->
                        <div class="flex items-center justify-center lg:justify-start gap-10">
                            <button id="slider-button-left"
                                    class="swiper-button-left group flex justify-center items-center border border-solid border-primary-light w-12 h-12 transition-all duration-500 rounded-lg hover:bg-primary-verylight"
                                    data-carousel-prev>
                                <svg class="h-6 w-6 text-primary-light group-hover:text-white" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.9999 12L4.99992 12M9.99992 6L4.70703 11.2929C4.3737 11.6262 4.20703 11.7929 4.20703 12C4.20703 12.2071 4.3737 12.3738 4.70703 12.7071L9.99992 18"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </button>
                            <button id="slider-button-right"
                                    class="swiper-button-right group flex justify-center items-center border border-solid border-primary-light w-12 h-12 transition-all duration-500 rounded-lg hover:bg-primary-verylight"
                                    data-carousel-next>
                                <svg class="h-6 w-6 text-primary-light group-hover:text-white" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 12L19 12M14 18L19.2929 12.7071C19.6262 12.3738 19.7929 12.2071 19.7929 12C19.7929 11.7929 19.6262 11.6262 19.2929 11.2929L14 6"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </button>
                        </div>
                    </div>
                    <div class="w-full lg:w-3/5">
                        <!--Slider wrapper-->
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl max-sm:max-w-sm max-sm:mx-auto p-6 transition-all duration-500 hover:border-primary">
                                    <div class="flex items-center gap-5 mb-5 sm:mb-9">
                                        <img class="rounded-full object-cover" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar">
                                        <div class="grid gap-1">
                                            <h5 class="text-gray-900 font-medium transition-all duration-500  ">Jurga S.</h5>
                                            <span class="text-sm leading-6 text-gray-500">Direktore </span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center mb-5 sm:mb-9 gap-2 text-amber-500 transition-all duration-500  ">
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <p
                                        class="text-sm text-gray-500 leading-6 transition-all duration-500 min-h-24  group-hover:text-gray-800">
                                        Reikėjo greitos fotografės paslaugos, dėka myapp Lietuva, turėjau galimybė greitai rasti profesionalią fotografę.
                                    </p>

                                </div>
                                <div class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl max-sm:max-w-sm max-sm:mx-auto p-6 transition-all duration-500 hover:border-primary">
                                    <div class="flex items-center gap-5 mb-5 sm:mb-9">
                                        <img class="rounded-full object-cover" src="	https://pagedone.io/asset/uploads/1696229994.png" alt="avatar">
                                        <div class="grid gap-1">
                                            <h5 class="text-gray-900 font-medium transition-all duration-500  ">Tomas S.
                                            </h5>
                                            <span class="text-sm leading-6 text-gray-500">Darbininkas </span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center mb-5 sm:mb-9 gap-2 text-amber-500 transition-all duration-500  ">
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <p
                                        class="text-sm text-gray-500 leading-6 transition-all duration-500 min-h-24 group-hover:text-gray-800">
                                        Reikėjo pagalbos kraustantis į kitą butą, my app lietuva leido man greitai surasti puikią pagalbą, vienas nebūčiau susitvarkes.
                                    </p>

                                </div>
                                <div class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl max-sm:max-w-sm max-sm:mx-auto p-6 transition-all duration-500 hover:border-primary">
                                    <div class="flex items-center gap-5 mb-5 sm:mb-9">
                                        <img class="rounded-full object-cover" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar">
                                        <div class="grid gap-1">
                                            <h5 class="text-gray-900 font-medium transition-all duration-500  ">Urte N.</h5>
                                            <span class="text-sm leading-6 text-gray-500">CEO </span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center mb-5 sm:mb-9 gap-2 text-amber-500 transition-all duration-500  ">
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <p
                                        class="text-sm text-gray-500 leading-6 transition-all duration-500 min-h-24 group-hover:text-gray-800">
                                        Reikejo papildomu ranku organizuojant rengini, myapp leido greitai surasti talentinga mergina pagalbai.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md mt-4">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>

        <section class="py-16 relative">
            <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
                <div class="w-full justify-start items-center gap-12 grid lg:grid-cols-2 grid-cols-1">
                    <div class="w-full flex-col justify-center lg:items-start items-center gap-10 inline-flex">
                        <div class="w-full flex-col justify-center items-start gap-8 flex">
                            <div class="w-full flex-col justify-start lg:items-start items-center gap-3 flex">
                                <h2
                                    class="text-primary text-4xl font-bold font-manrope leading-normal lg:text-start text-center">
                                    Skatiname Bendruomenes Dirbti Kartu</h2>
                                <p class="text-gray-500 text-base font-normal leading-relaxed lg:text-start text-center">
                                    MyAPP Lietuva sujungia žmones, kuriems reikia paslaugų, su patikimais specialistais jų mieste. Mūsų platforma
                                    pagrįsta pasitikėjimu ir bendradarbiavimu - nuo kasdienių darbų iki profesionalių paslaugų, padedame
                                    paprastai ir greitai rasti reikiamą pagalbą.</p>
                            </div>
                            <div class="w-full lg:justify-start justify-center items-center sm:gap-10 gap-5 inline-flex">
                                <div class="flex-col justify-start items-start inline-flex">
                                    <h3 class="text-primary-light text-4xl font-bold font-manrope leading-normal">50+</h3>
                                    <h6 class="text-gray-500 text-base font-normal leading-relaxed">Paslaugų Rūšių</h6>
                                </div>
                                <div class="flex-col justify-start items-start inline-flex">
                                    <h4 class="text-primary-light text-4xl font-bold font-manrope leading-normal">5000+</h4>
                                    <h6 class="text-gray-500 text-base font-normal leading-relaxed">Atliktų Užsakymų</h6>
                                </div>
                                <div class="flex-col justify-start items-start inline-flex">
                                    <h4 class="text-primary-light text-4xl font-bold font-manrope leading-normal">500+</h4>
                                    <h6 class="text-gray-500 text-base font-normal leading-relaxed">Įvairių Sričių Partnerių</h6>
                                </div>
                            </div>
                        </div>
                        <button
                            class="sm:w-fit w-full px-3.5 py-2 bg-primary-light hover:bg-primary-verylight transition-all duration-700 ease-in-out rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center flex">
                            <span class="px-1.5 text-white text-sm font-medium leading-6">Rasti Specialistą Dabar</span>
                        </button>
                    </div>
                    <div
                        class="w-full justify-center items-start gap-6 grid sm:grid-cols-2 grid-cols-1 lg:order-last order-first">
                        <div class="pt-24 lg:justify-center sm:justify-end justify-start items-start gap-2.5 flex">
                            <img class=" rounded-1xl object-cover" src="{{ asset('images/delivery-man.jpg') }}" alt="about Us image" />
                        </div>
                        <img class="sm:ml-0 ml-auto rounded-xl object-cover" src="{{ asset('images/wedding-planner1.jpg') }}"
                             alt="about Us image" />
                    </div>
                </div>
            </div>
        </section>




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

