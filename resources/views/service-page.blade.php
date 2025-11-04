@extends('layouts.main')

@section('title', $seoData->meta_title ?? $serviceData->subcategory . ' paslaugos Lietuvoje | Qvicker')
@section('description', $seoData->meta_description ?? 'Raskite geriausius ' . $serviceData->subcategory . ' specialistus. Patikimi meistrai, konkurencingos kainos, greitas aptarnavimas visoje Lietuvoje.')
@section('keywords', $seoData->meta_keywords ?? $serviceData->subcategory . ', ' . $serviceData->category . ', paslaugos, meistrai, Lietuva')

@section('structured-data')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Service",
          "name": "{{ $serviceData->subcategory }}",
          "category": "{{ $serviceData->category }}",
          "provider": {
            "@type": "Organization",
            "name": "Qvicker",
            "url": "{{ url('/') }}"
          },
          "areaServed": {
            "@type": "Country",
            "name": "Lithuania"
          },
          "url": "{{ url($serviceData->url) }}"
        @if(isset($seoData) && !empty($seoData->image_path))
            ,
            "image": "{{ asset('storage/' . $seoData->image_path) }}"
        @endif
        }
    </script>
@endsection

@section('content')

    <!-- Hero Section with Breadcrumbs -->
    <div class="relative py-16 bg-gradient-to-br from-slate-50 via-white to-blue-50 overflow-hidden min-h-[500px]">
        <!-- Background Image (if exists) -->
        @if(isset($seoData) && !empty($seoData->image_path))
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('storage/' . $seoData->image_path) }}"
                     alt="{{ $seoData->alt_text }}"
                     class="w-full h-full object-cover">
                <!-- Dark overlay for better text readability -->
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
            </div>
        @endif

        <!-- Content -->
        <div class="relative z-10">
            <!-- Breadcrumbs for SEO -->
            <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 mb-6">
                <nav aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li><a href="/" class="@if(isset($seoData) && !empty($seoData->image_path)) text-white/90 hover:text-white @else text-gray-600 hover:text-primary-light @endif">Pradžia</a></li>
                        <li><span class="@if(isset($seoData) && !empty($seoData->image_path)) text-white/60 @else text-gray-400 @endif">/</span></li>
                        <li><a href="/allservices" class="@if(isset($seoData) && !empty($seoData->image_path)) text-white/90 hover:text-white @else text-gray-600 hover:text-primary-light @endif">Visos paslaugos</a></li>
                        <li><span class="@if(isset($seoData) && !empty($seoData->image_path)) text-white/60 @else text-gray-400 @endif">/</span></li>
                        <li><span class="@if(isset($seoData) && !empty($seoData->image_path)) text-white font-medium @else text-gray-800 font-medium @endif">{{ $serviceData->subcategory }}</span></li>
                    </ol>
                </nav>
            </div>

            <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
                <div class="max-w-3xl">
                    <h1 class="text-4xl sm:text-5xl font-bold @if(isset($seoData) && !empty($seoData->image_path)) text-white @else text-gray-900 @endif mb-4">
                        {{ $seoData->h1_heading ?? $serviceData->subcategory . ' paslaugos' }}
                    </h1>
                    <p class="text-lg @if(isset($seoData) && !empty($seoData->image_path)) text-white/90 @else text-gray-600 @endif">
                        {{ $seoData->meta_description ?? 'Profesionalūs ' . $serviceData->subcategory . ' specialistai jūsų rajone. Greitas ir kokybiškas aptarnavimas už konkurencingą kainą.' }}
                    </p>

                    <!-- CTA Buttons -->
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="/search?subcategory={{ urlencode($serviceData->subcategory) }}"
                           class="@if(isset($seoData) && !empty($seoData->image_path)) bg-white text-primary-light hover:bg-gray-100 @else bg-primary-light text-white hover:bg-primary-verylight @endif px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                            Rasti specialistą
                        </a>
                        <a href="{{route('register.provider')}}"
                           class="@if(isset($seoData) && !empty($seoData->image_path)) bg-white/10 text-white border-2 border-white backdrop-blur-sm hover:bg-white/20 @else bg-white text-primary-light border-2 border-primary-light hover:bg-gray-50 @endif px-6 py-3 rounded-lg font-semibold transition">
                            Tapti specialistu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="grid lg:grid-cols-3 gap-12">

                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($seoData && $seoData->content)
                        <div class="prose prose-lg max-w-none">
                            {!! $seoData->content !!}
                        </div>
                    @else
                        <!-- Default content structure -->
                        <div class="space-y-8">
                            <section>
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                                    Apie {{ $serviceData->subcategory }} paslaugas
                                </h2>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $serviceData->subcategory }} paslaugos yra vienos populiariausių mūsų platformoje.
                                    Qvicker jungia patikimus specialistus su klientais visoje Lietuvoje.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                                    Kodėl rinktis Qvicker {{ $serviceData->subcategory }} specialistus?
                                </h2>
                                <ul class="space-y-3">
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-600">Patikrinti ir patvirtinti specialistai</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-600">Skaidrios kainos be paslėptų mokesčių</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-600">Klientų atsiliepimai ir įvertinimai</span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                                    {{ $serviceData->subcategory }} paslaugų kainos
                                </h2>
                                <p class="text-gray-600 leading-relaxed">
                                    Kainos priklauso nuo darbo sudėtingumo, lokacijos ir specialisto patirties.
                                    Vidutiniškai {{ $serviceData->subcategory }} paslaugos kainuoja nuo 20€ iki 100€.
                                </p>
                            </section>
                        </div>
                    @endif

                    <!-- Dynamic FAQ Section -->
                    @if($seoData && $seoData->faq)
                        @php
                            $faqData = json_decode($seoData->faq, true);
                        @endphp

                        @if($faqData && is_array($faqData) && count($faqData) > 0)
                            <section class="mt-12">
                                <h2 class="text-2xl font-bold text-primary mb-4">Dažnai užduodami klausimai</h2>
                                <div class="space-y-3">
                                    @foreach($faqData as $faq)
                                        @if(!empty($faq['question']) && !empty($faq['answer']))
                                            <details class="group bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                                                <summary class="flex justify-between items-center cursor-pointer p-4 hover:bg-gray-100 transition">
                                                    <h3 class="font-semibold text-primary-light text-md">
                                                        {{ $faq['question'] }}
                                                    </h3>
                                                    <svg class="w-5 h-5 text-gray-500 transition-transform group-open:rotate-180 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </summary>
                                                <div class="px-4 pb-4 pt-2 text-gray-600 text-sm font-bold">
                                                    {{ $faq['answer'] }}
                                                </div>
                                            </details>
                                        @endif
                                    @endforeach
                                </div>
                            </section>

                            <!-- FAQ Schema for SEO -->
                            <script type="application/ld+json">
                                {
                                  "@context": "https://schema.org",
                                  "@type": "FAQPage",
                                  "mainEntity": [
                                @foreach($faqData as $index => $faq)
                                    @if(!empty($faq['question']) && !empty($faq['answer']))
                                        {
                                          "@type": "Question",
                                          "name": "{{ addslashes($faq['question']) }}",
                                      "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "{{ addslashes($faq['answer']) }}"
                                      }
                                    }{{ $loop->last ? '' : ',' }}
                                    @endif
                                @endforeach
                                ]
                              }
                            </script>
                        @endif
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Quick Booking Card -->
                    <div class="bg-gradient-to-br from-primary-light to-primary-verylight rounded-xl p-6 text-white mb-8">
                        <h3 class="text-xl font-bold mb-4">Užsakyti paslaugą</h3>
                        <p class="mb-6">Raskite geriausią specialistą jūsų rajone</p>
                        <a href="/search?subcategory={{ urlencode($serviceData->subcategory) }}" class="block w-full bg-white text-primary-light text-center py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                            Ieškoti specialisto
                        </a>
                    </div>

                    <!-- Related Services -->
                    @if($relatedServices->count() > 0)
                        <div class="bg-white border rounded-xl p-6">
                            <h3 class="text-lg font-bold text-primary mb-4">Susijusios paslaugos</h3>
                            <ul class="space-y-2">
                                @foreach($relatedServices as $related)
                                    <li>
                                        <a href="/{{ $related->url }}" class="text-primary-light hover:text-primary-verylight transition">
                                            {{ $related->subcategory }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Location Section for Local SEO -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center shadow-sm">
                {{ $serviceData->subcategory }} paslaugos Lietuvoje
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
                <div class="bg-white rounded-lg p-4 text-lg text-primary-light font-bold">Vilnius</div>
                <div class="bg-white rounded-lg p-4 text-lg text-primary-light font-bold">Kaunas</div>
                <div class="bg-white rounded-lg p-4 text-lg text-primary-light font-bold">Klaipėda</div>
                <div class="bg-white rounded-lg p-4 text-lg text-primary-light font-bold">Šiauliai</div>
                <div class="bg-white rounded-lg p-4 text-lg text-primary-light font-bold">Panevėžys</div>
            </div>
        </div>
    </div>

@endsection
