@extends('layouts.main')

@section('title', 'Paslaugų Kategorijos | Raskite Specialistus Lietuvoje - Qvicker')

@section('description', 'Raskite patikimus specialistus 8 paslaugų kategorijose: namų remontas, valymas, sodų priežiūra, IT paslaugos ir daugiau. Nemokama registracija Qvicker.')

@section('keywords', 'paslaugų kategorijos lietuvoje, specialistai vilniuje, namų remontas, valymo paslaugos, IT paslaugos, sodų priežiūra, grožio paslaugos, elektrikai, santechnikai, valytojai, meistrai lietuvoje, qvicker paslaugos')

@section('content')

    <!-- Hero Section -->
    <div class="relative md:py-16 overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-blue-50">
        <!-- Background decorative blobs -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-20 w-80 h-80 bg-emerald-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-cyan-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center space-y-8">
                <!-- Badge with glass effect -->
                <div class="inline-block">
                    <div class="flex items-center space-x-3 bg-white/80 backdrop-blur-sm px-5 py-2.5 rounded-full shadow-md border border-gray-100 hover:shadow-lg hover:scale-105 transform transition-all duration-300">
                        <span class="text-sm font-semibold text-gray-700">Patikimi paslaugų teikėjai</span>
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                    </div>
                </div>

                <!-- Heading with gradient text -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="block bg-gradient-to-r from-emerald-600 via-cyan-600 to-blue-600 bg-clip-text text-transparent pb-2">
                        Rask paslaugas
                    </span>
                    <span class="block text-gray-900 mt-2">kurių tau reikia</span>
                </h1>

                <!-- Subheading -->
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    Surask patikimus specialistus bet kokiam darbui. Nuo namų remonto iki valymo paslaugų - visa tai vienoje vietoje su garantuota kokybe.
                </p>

                <!-- CTA Section -->
                <div class="pt-4 space-y-6">
                    <!-- Main CTA button -->
                    <div class="relative inline-block group">
                        <!-- Glow effect -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl blur-md opacity-30 group-hover:opacity-50 transition duration-300"></div>

                        <a href="/register/seeker" class="relative block">
                            <button class="relative bg-gradient-to-r from-emerald-500 to-cyan-500 hover:from-cyan-500 hover:to-emerald-500 text-white font-semibold py-4 px-8 sm:py-5 sm:px-10 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-3 text-lg">
                                <span>Pradėti Paiešką</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </a>
                    </div>

                    <!-- Trust badges -->
                    <div class="flex flex-wrap justify-center gap-6 text-sm">
                        <div class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Nemokama registracija</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Patikimi specialistai</span>
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

    <!-- Services Categories Section -->
    <div class="py-20 bg-white relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute h-64 w-64 bg-emerald-500 rounded-full -top-32 -left-32"></div>
            <div class="absolute h-64 w-64 bg-cyan-500 rounded-full -bottom-32 -right-32"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4">Populiarios paslaugų kategorijos</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Rask specialistą bet kokiam darbui</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Category 1: Home Repair -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-orange-200 to-red-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Namų Remontas</h3>
                        <p class="text-gray-600 text-sm">Dailidės, elektrikų, santechnikų paslaugos</p>
                    </div>
                </div>

                <!-- Category 2: Cleaning -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-200 to-cyan-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Valymo Paslaugos</h3>
                        <p class="text-gray-600 text-sm">Namų, biurų, langų valymas</p>
                    </div>
                </div>

                <!-- Category 3: Garden -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-green-200 to-emerald-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Sodų Priežiūra</h3>
                        <p class="text-gray-600 text-sm">Želdinimas, pjovimas, tvarkymas</p>
                    </div>
                </div>

                <!-- Category 4: Beauty -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-200 to-purple-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Grožio Paslaugos</h3>
                        <p class="text-gray-600 text-sm">Kirpėjai, kosmetologai, masažuotojai</p>
                    </div>
                </div>

                <!-- Category 5: Transport -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-200 to-purple-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Transportas</h3>
                        <p class="text-gray-600 text-sm">Pervežimo, taksi paslaugos</p>
                    </div>
                </div>

                <!-- Category 6: Education -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Mokymas</h3>
                        <p class="text-gray-600 text-sm">Privatūs mokytojai, korepetitoriai</p>
                    </div>
                </div>

                <!-- Category 7: Pet Care -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-200 to-teal-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Gyvūnų Priežiūra</h3>
                        <p class="text-gray-600 text-sm">Vedžiojimas, priežiūra, veterinarija</p>
                    </div>
                </div>

                <!-- Category 8: IT Services -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-slate-200 to-gray-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-slate-400 to-gray-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">IT Paslaugos</h3>
                        <p class="text-gray-600 text-sm">Kompiuterių remontas, duomenų atkūrimas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute h-64 w-64 bg-emerald-500 rounded-full -top-32 -left-32"></div>
            <div class="absolute h-64 w-64 bg-cyan-500 rounded-full -bottom-32 -right-32"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-emerald-600 mb-4">Kaip rasti specialistą?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Paprastas procesas nuo paieškos iki darbo pabaigos</p>
            </div>

            <div class="relative">
                <!-- Connection line for desktop -->
                <div class="hidden md:block absolute top-10 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-emerald-500 to-transparent opacity-20"></div>

                <div class="grid md:grid-cols-4 gap-8 relative">
                    <!-- Step 1 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-emerald-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Ieškoti Paslaugos</h3>
                        <p class="text-gray-600 leading-relaxed">Pasirink reikiamą kategoriją ir aprašyk darbą.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-emerald-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Peržiūrėti Specialistus</h3>
                        <p class="text-gray-600 leading-relaxed">Rask tinkamus paslaugų teikėjus pagal įvertinimus.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-emerald-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Susisiekti</h3>
                        <p class="text-gray-600 leading-relaxed">Parašyk žinutę ir susitark dėl darbo detalių.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-green-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Gauti Paslaugą</h3>
                        <p class="text-gray-600 leading-relaxed">Mėgaukis kokybiškai atliktu darbu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="py-20 relative overflow-hidden">
        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-cyan-600 to-blue-600 opacity-95"></div>

        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-300 rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-3xl md:text-5xl font-bold text-center text-white mb-4">Kodėl rinktis Qvicker?</h2>
            <p class="text-center text-white/80 max-w-2xl mx-auto mb-16 text-lg">Patikimi specialistai, saugi platforma</p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-white to-cyan-100 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-emerald-100 rounded-full blur-2xl opacity-50 scale-75"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">Patikimi Specialistai</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Visi paslaugų teikėjai yra patikrinti ir turi realius klientų atsiliepimus.</p>

                        <div class="absolute top-4 right-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-cyan-100 rounded-full opacity-50"></div>
                        </div>
                    </div>
                </div>

                <!-- Benefit 2 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-white to-blue-100 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-blue-100 rounded-full blur-2xl opacity-50 scale-75"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">Konkurencingos Kainos</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Palygink kainas ir rask geriausią pasiūlymą savo biudžetui.</p>

                        <div class="absolute top-4 right-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full opacity-50"></div>
                        </div>
                    </div>
                </div>

                <!-- Benefit 3 -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-white to-green-100 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-green-100 rounded-full blur-2xl opacity-50 scale-75"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">Greitas Atsiliepimas</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Gauk pasiūlymus per kelias valandas ir rask specialistą greitai.</p>

                        <div class="absolute top-4 right-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full opacity-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-emerald-600 mb-4">Ką sako mūsų klientai</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Realios istorijos iš mūsų bendruomenės</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-100 to-cyan-100 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="flex items-center mb-6 mt-4">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    AS
                                </div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Asta S.</h4>
                                <p class="text-sm text-gray-500 font-medium">Vilnius</p>
                                <div class="flex mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed italic">"Per Qvicker radau puikų elektrikai. Darbas atliktas kokybiškai ir laiku. Labai patiko, kad galiu matyti specialistų įvertinimus."</p>

                        <div class="mt-6 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Patvirtintas klientas
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="flex items-center mb-6 mt-4">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    JK
                                </div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Jonas K.</h4>
                                <p class="text-sm text-gray-500 font-medium">Kaunas</p>
                                <div class="flex mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed italic">"Nuostabi platforma! Per kelias valandas radau valytoja, kuri puikiai išvalė mano butą. Rekomenduoju visiems."</p>

                        <div class="mt-6 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Patvirtintas klientas
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="group relative lg:col-span-1 md:col-span-2">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-100 to-emerald-100 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="flex items-center mb-6 mt-4">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    DR
                                </div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">Dalia R.</h4>
                                <p class="text-sm text-gray-500 font-medium">Klaipėda</p>
                                <div class="flex mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed italic">"Qvicker išsprendė mano problemą su virtuvės renovacija. Radau patikimą meistrą, kuris viską padarė profesionaliai ir laiku."</p>

                        <div class="mt-6 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Patvirtintas klientas
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 relative overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 via-cyan-600 to-blue-600"></div>

        <!-- Decorative shapes -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white rounded-full mix-blend-overlay opacity-10 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay opacity-10 translate-x-1/2 translate-y-1/2"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Rask specialistą jau šiandien</h2>
                <p class="text-white/90 text-lg md:text-xl mb-10 leading-relaxed">Užsiregistruok vos per kelias minutes ir rask patikimą paslaugų teikėją jau šiandien.</p>

                <div class="inline-block relative group">
                    <!-- Button glow -->
                    <div class="absolute -inset-1 bg-white rounded-xl blur-md opacity-25 group-hover:opacity-50 transition duration-300"></div>

                    <a href="/register/seeker" class="relative block">
                        <button class="relative bg-white text-emerald-600 font-bold py-5 px-10 rounded-xl hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 text-lg shadow-2xl">
                            Pradėti Paiešką Dabar
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
                            <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.94l1-4H9.03z" clip-rule="evenodd"/>
                        </svg>
                        <span>1000+ aktyvių specialistų</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-emerald-600 mb-4">Dažniausiai užduodami klausimai</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Turite klausimų? Čia rasite atsakymus</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <!-- FAQ Item 1 -->
                <div class="group">
                    <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                        <button class="flex justify-between items-center w-full p-6 text-left">
                            <span class="text-lg font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">Ar mokama už naudojimąsi platforma?</span>
                            <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-emerald-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-emerald-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div class="px-6 pb-6">
                            <p class="text-gray-600 leading-relaxed">Ne, registracija ir naudojimasis platforma yra visiškai nemokama klientams. Mokate tik už paslaugas tiesiogiai paslaugų teikėjui.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="group">
                    <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                        <button class="flex justify-between items-center w-full p-6 text-left">
                            <span class="text-lg font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">Kaip patikrinu paslaugų teikėjo patikimumą?</span>
                            <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-emerald-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-emerald-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div class="px-6 pb-6">
                            <p class="text-gray-600 leading-relaxed">Kiekvienas paslaugų teikėjas turi profilį su realiais klientų atsiliepimais, įvertinimais ir darbų pavyzdžiais. Taip pat galite peržiūrėti jų patirtį ir išsilavinimą.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="group">
                    <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                        <button class="flex justify-between items-center w-full p-6 text-left">
                            <span class="text-lg font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">Kiek laiko užtrunka rasti specialistą?</span>
                            <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-emerald-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-emerald-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div class="px-6 pb-6">
                            <p class="text-gray-600 leading-relaxed">Greičiausias būdas rasti paslaugų teikėja yra naudotis mūsų paieškos sistema ir išsirinkti tinkamiausia specialistą, tai užtrunka tik kelias minutes.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="group">
                    <div class="bg-white border-2 border-gray-100 rounded-2xl hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                        <button class="flex justify-between items-center w-full p-6 text-left">
                            <span class="text-lg font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">Ką daryti, jei esu nepatenkintas paslauga?</span>
                            <div class="ml-4 flex-shrink-0 w-10 h-10 bg-gray-100 group-hover:bg-emerald-500/10 rounded-full flex items-center justify-center transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-emerald-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div class="px-6 pb-6">
                            <p class="text-gray-600 leading-relaxed">Susisiekite su mūsų komanda, ir mes padėsime išspręsti konfliktą. Taip pat galite palikti atsiliepimą, kad kiti klientai būtų informuoti.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional help -->
            <div class="text-center mt-12">
                <p class="text-gray-600 mb-4">Neradote atsakymo į savo klausimą?</p>
                <a href="#" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold transition-colors duration-300">
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
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-cyan-300 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-800 mb-6">
                    Pradėk naudotis
                    <span class="bg-gradient-to-r from-emerald-500 to-cyan-500 bg-clip-text text-transparent">Qvicker platforma</span>
                </h2>

                <p class="text-gray-600 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed">
                    Prisijunk prie tūkstančių patenkintu klientų ir rask patikimą specialistą bet kokiam darbui
                </p>

                <a href="/register/seeker" class="group inline-block relative">
                    <!-- Button shadow/glow -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl blur-md opacity-30 group-hover:opacity-50 transition duration-300"></div>

                    <button class="relative bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-bold py-5 px-10 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center text-lg">
                        <span>Registruotis Dabar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </a>

                <!-- Success metrics -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">1000+</div>
                        <div class="text-gray-600">Aktyvių specialistų</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">15k+</div>
                        <div class="text-gray-600">Atliktų užsakymų</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">4.8★</div>
                        <div class="text-gray-600">Vidutinis įvertinimas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">2h</div>
                        <div class="text-gray-600">Vidutinis atsako laikas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center group mt-14 mb-8">
        <div class="relative inline-block mb-6">
            <div class="absolute inset-0 bg-emerald-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
            <div class="relative w-20 h-20 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
        <h3 class="text-xl font-bold mb-3 text-gray-800">Peržiūrėti Specialistus</h3>
        <p class="text-gray-600 leading-relaxed">Rask tinkamus paslaugų teikėjus pagal įvertinimus.</p>
    </div>

    <!-- Step 3 -->
    <div class="text-center group mb-8">
        <div class="relative inline-block mb-6">
            <div class="absolute inset-0 bg-emerald-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
            <div class="relative w-20 h-20 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
        </div>
        <h3 class="text-xl font-bold mb-3 text-gray-800">Susisiekti</h3>
        <p class="text-gray-600 leading-relaxed">Parašyk žinutę ir susitark dėl darbo detalių.</p>
    </div>

    <!-- Step 4 -->
    <div class="text-center group">
        <div class="relative inline-block mb-6">
            <div class="absolute inset-0 bg-green-500 rounded-full opacity-20 scale-110 group-hover:scale-125 transition-transform duration-300"></div>
            <div class="relative w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <h3 class="text-xl font-bold mb-3 text-gray-800">Gauti Paslaugą</h3>
        <p class="text-gray-600 leading-relaxed">Mėgaukis kokybiškai atliktu darbu.</p>
    </div>
@endsection
