@extends('layouts.main')

@section('content')

    <!-- Hero Section -->
    <div class="relative py-16 overflow-hidden bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <!-- Background decorative blobs -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-20 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center space-y-8">
                <!-- Badge -->
                <div class="inline-block">
                    <div class="flex items-center space-x-3 bg-white/80 backdrop-blur-sm px-5 py-2.5 rounded-full shadow-md border border-gray-100">
                        <span class="text-sm font-semibold text-gray-700">24/7 Pagalba</span>
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                        </span>
                    </div>
                </div>

                <!-- Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="block bg-gradient-to-r from-blue-600 via-primary-light to-blue-600 bg-clip-text text-transparent pb-2">
                        Pagalba Naudotojams
                    </span>
                    <span class="block text-gray-900 mt-2">Mes čia, kad padėtume</span>
                </h1>

                <!-- Subheading -->
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    Turite klausimų ar reikia pagalbos? Mūsų komanda pasiruošusi jums padėti rasti geriausius sprendimus ir atsakyti į visus klausimus.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Options Section -->
    <div class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary-light mb-4">Susisiekimo būdai</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Pasirinkite jums patogiausią būdą susisiekti su mumis</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-16 max-w-4xl mx-auto">
                <!-- Email Support -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-teal-200 to-cyan-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-teal-600 to-teal-700 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">El. paštas</h3>
                        <p class="text-gray-600 mb-4">Parašykite mums el. laišką ir atsakysime per 24h</p>
                        <a href="mailto:info@qvicker.lt" class="text-teal-600 hover:text-cyan-600 font-semibold inline-flex items-center transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            info@qvicker.lt
                        </a>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-cyan-200 to-teal-200 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300"></div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">DUK</h3>
                        <p class="text-gray-600 mb-4">Raskite atsakymus į dažniausius klausimus</p>
                        <a href="/duk" class="text-teal-600 hover:text-cyan-600 font-semibold inline-flex items-center transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Peržiūrėti DUK
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="py-20 relative overflow-hidden">
        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-light via-blue-600 to-primary-verylight opacity-95"></div>

        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-overlay opacity-10 blur-3xl"></div>

        <div class="container relative mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Susisiekite su mumis</h2>
                    <p class="text-white/90 text-lg">Užpildykite formą ir mes su jumis susisieksime artimiausiu metu</p>
                </div>

                <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12">
                    <form action="{{ route('seeker.support.send') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="group">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Vardas ir pavardė *</label>
                                <div class="relative">
                                    <input type="text" id="name" name="name" required
                                           class="block w-full pl-4 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-primary-light/20 focus:border-primary-light transition-all duration-300 text-gray-900 placeholder-gray-500"
                                           placeholder="Jūsų vardas ir pavardė"
                                           value="{{ old('name', auth()->user()->name ?? '') }}"
                                           oninvalid="this.setCustomValidity('Įveskite vardą ir pavardę')"
                                           oninput="this.setCustomValidity('')">
                                </div>
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="group">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">El. paštas *</label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" required
                                           class="block w-full pl-4 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-primary-light/20 focus:border-primary-light transition-all duration-300 text-gray-900 placeholder-gray-500"
                                           placeholder="jusu.email@example.com"
                                           value="{{ old('email', auth()->user()->email ?? '') }}"
                                           oninvalid="this.setCustomValidity('Įveskite el. pašto adresą')"
                                           oninput="this.setCustomValidity('')">
                                </div>
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="group">
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Telefono numeris</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone"
                                       class="block w-full pl-4 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-primary-light/20 focus:border-primary-light transition-all duration-300 text-gray-900 placeholder-gray-500"
                                       placeholder="+370 600 00000"
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}">
                            </div>
                            @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div class="group">
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Tema *</label>
                            <div class="relative">
                                <select id="subject" name="subject" required
                                        class="block w-full pl-4 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-primary-light/20 focus:border-primary-light transition-all duration-300 text-gray-900"
                                        oninvalid="this.setCustomValidity('Pasirinkite temą iš sąrašo')"
                                        oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected>Pasirinkite temą</option>
                                    <option value="Techninis klausimas" {{ old('subject') == 'Techninis klausimas' ? 'selected' : '' }}>Techninis klausimas</option>
                                    <option value="Paslaugų paieška" {{ old('subject') == 'Paslaugų paieška' ? 'selected' : '' }}>Paslaugų paieška</option>
                                    <option value="Apmokėjimo klausimai" {{ old('subject') == 'Apmokėjimo klausimai' ? 'selected' : '' }}>Apmokėjimo klausimai</option>
                                    <option value="Rezervacijos klausimai" {{ old('subject') == 'Rezervacijos klausimai' ? 'selected' : '' }}>Rezervacijos klausimai</option>
                                    <option value="Partnerių vertinimas" {{ old('subject') == 'Partnerių vertinimas' ? 'selected' : '' }}>Partnerių vertinimas</option>
                                    <option value="Skundas" {{ old('subject') == 'Skundas' ? 'selected' : '' }}>Skundas</option>
                                    <option value="Pasiūlymas" {{ old('subject') == 'Pasiūlymas' ? 'selected' : '' }}>Pasiūlymas</option>
                                    <option value="Kita" {{ old('subject') == 'Kita' ? 'selected' : '' }}>Kita</option>
                                </select>
                            </div>
                            @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="group">
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Žinutė *</label>
                            <div class="relative">
                                <textarea id="message" name="message" rows="6" required
                                          class="block w-full pl-4 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-primary-light/20 focus:border-primary-light transition-all duration-300 text-gray-900 placeholder-gray-500 resize-none"
                                          placeholder="Detaliai aprašykite savo klausimą ar problemą..."
                                          oninvalid="this.setCustomValidity('Įveskite žinutės tekstą')"
                                          oninput="this.setCustomValidity('')">{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priority -->
                        <div class="group">
                            <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">Prioritetas</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="priority" value="low" {{ old('priority', 'normal') == 'low' ? 'checked' : '' }} class="w-4 h-4 text-primary-light focus:ring-primary-light/30 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Žemas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="priority" value="normal" {{ old('priority', 'normal') == 'normal' ? 'checked' : '' }} class="w-4 h-4 text-primary-light focus:ring-primary-light/30 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Normalus</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="priority" value="high" {{ old('priority') == 'high' ? 'checked' : '' }} class="w-4 h-4 text-primary-light focus:ring-primary-light/30 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Aukštas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="priority" value="urgent" {{ old('priority') == 'urgent' ? 'checked' : '' }} class="w-4 h-4 text-red-500 focus:ring-red-500/30 border-gray-300">
                                    <span class="ml-2 text-sm text-red-600">Skubus</span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" class="group relative w-full md:w-auto">
                                <!-- Button glow -->
                                <div class="absolute -inset-1 bg-gradient-to-r from-primary-light to-primary-verylight rounded-xl blur-md opacity-30 group-hover:opacity-50 transition duration-300"></div>

                                <div class="relative bg-gradient-to-r from-primary-light to-primary-verylight text-white font-bold py-4 px-8 rounded-xl hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center text-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <span>Siųsti žinutę</span>
                                </div>
                            </button>

                            <p class="mt-4 text-sm text-gray-600">
                                * Privalomi laukai. Mes su jumis susisieksime per 24 valandas.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages - SINGLE VERSION ONLY -->
    @if(session('success'))
        <div class="fixed top-4 right-4 z-50 max-w-md" id="success-message">
            <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg border border-green-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.parentElement.remove()" class="ml-4 text-green-200 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 z-50 max-w-md" id="error-message">
            <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg border border-red-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.parentElement.remove()" class="ml-4 text-red-200 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Common Questions Section -->
    <div class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary-light mb-4">Dažni naudotojų klausimai</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Greiti atsakymai į populiariausius klausimus</p>
            </div>

            <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-8">
                <!-- Question 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 mb-2">Kaip rasti tinkamą partnerį?</h3>
                            <p class="text-gray-600 text-sm">Naudokite paieškos filtrą pagal kategoriją, vietą ir kainą. Peržiūrėkite partnerių vertinimus ir atsiliepimus.</p>
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 mb-2">Kaip vyksta apmokėjimas?</h3>
                            <p class="text-gray-600 text-sm">Mokėjimą atliksite tiesiogiai partneriui po darbo atlikimo. Aptarkite mokėjimo būdą iš anksto.</p>
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12v-6m0 0a4 4 0 108 0 4 4 0 10-8 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 mb-2">Ar mano duomenys yra saugūs?</h3>
                            <p class="text-gray-600 text-sm">Taip, visi jūsų duomenys yra šifruojami ir saugomi pagal duomenų apsaugos reikalavimus.</p>
                        </div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 mb-2">Kaip vertinti partnerius?</h3>
                            <p class="text-gray-600 text-sm">Po paslaugos atlikimo galėsite palikti vertinimą ir atsiliepimą, kuris padės kitiems naudotojams.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More help -->
            <div class="text-center mt-12">
                <p class="text-gray-600 mb-4">Neradote atsakymo į savo klausimą?</p>
                <a href="#contact-form" class="inline-flex items-center text-primary-light hover:text-primary-verylight font-semibold transition-colors duration-300">
                    <span>Susisiekite su mumis per formą aukščiau</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Enhanced message handling
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide success messages after 5 seconds
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transform = 'translateX(100%)';
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        if (successMessage.parentElement) {
                            successMessage.remove();
                        }
                    }, 300);
                }, 5000);
            }

            // Auto-hide error messages after 8 seconds (longer for errors)
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.transform = 'translateX(100%)';
                    errorMessage.style.opacity = '0';
                    setTimeout(() => {
                        if (errorMessage.parentElement) {
                            errorMessage.remove();
                        }
                    }, 300);
                }, 8000);
            }

            // Add smooth transitions
            [successMessage, errorMessage].forEach(msg => {
                if (msg) {
                    msg.style.transition = 'all 0.3s ease-in-out';
                    msg.style.transform = 'translateX(100%)';

                    // Slide in animation
                    setTimeout(() => {
                        msg.style.transform = 'translateX(0)';
                    }, 100);
                }
            });
        });

        // Smooth scroll to contact form
        document.querySelectorAll('a[href="#contact-form"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.querySelector('form');
                if (form) {
                    form.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        });
    </script>

@endsection
