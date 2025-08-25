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
}
    </script>
@endsection

@section('content')

    <!-- Hero Section with Breadcrumbs -->
    <div class="relative py-16 bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <!-- Breadcrumbs for SEO -->
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 mb-6">
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="/" class="text-gray-600 hover:text-primary-light">Pradžia</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="/allservices" class="text-gray-600 hover:text-primary-light">Visos paslaugos</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><span class="text-gray-800 font-medium">{{ $serviceData->subcategory }}</span></li>
                </ol>
            </nav>
        </div>

        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="max-w-4xl">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    {{ $seoData->h1_heading ?? $serviceData->subcategory . ' paslaugos' }}
                </h1>
                <p class="text-lg text-gray-600">
                    {{ $seoData->meta_description ?? 'Profesionalūs ' . $serviceData->subcategory . ' specialistai jūsų rajone. Greitas ir kokybiškas aptarnavimas už konkurencingą kainą.' }}
                </p>

                <!-- CTA Buttons -->
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="/search?service={{ $serviceData->url }}" class="bg-primary-light text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-verylight transition">
                        Rasti specialistą
                    </a>
                    <a href="/register/provider" class="bg-white text-primary-light border-2 border-primary-light px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Tapti specialistu
                    </a>
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

                    <!-- FAQ Section -->
                    <section class="mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Dažnai užduodami klausimai</h2>
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="font-semibold text-gray-900 mb-2">
                                    Kaip greitai galiu gauti {{ $serviceData->subcategory }} specialistą?
                                </h3>
                                <p class="text-gray-600">
                                    Dauguma specialistų gali atvykti per 24-48 valandas nuo užsakymo.
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="font-semibold text-gray-900 mb-2">
                                    Ar {{ $serviceData->subcategory }} specialistai turi draudimą?
                                </h3>
                                <p class="text-gray-600">
                                    Rekomenduojame klausti konkretaus specialisto apie draudimą prieš užsakant paslaugą.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Quick Booking Card -->
                    <div class="bg-gradient-to-br from-primary-light to-primary-verylight rounded-xl p-6 text-white mb-8">
                        <h3 class="text-xl font-bold mb-4">Užsakyti paslaugą</h3>
                        <p class="mb-6">Raskite geriausią specialistą jūsų rajone</p>
                        <a href="/search?service={{ $serviceData->url }}" class="block w-full bg-white text-primary-light text-center py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                            Ieškoti specialisto
                        </a>
                    </div>

                    <!-- Related Services -->
                    @if($relatedServices->count() > 0)
                        <div class="bg-white border rounded-xl p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Susijusios paslaugos</h3>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">
                {{ $serviceData->subcategory }} paslaugos Lietuvoje
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div class="bg-white rounded-lg p-4">Vilnius</div>
                <div class="bg-white rounded-lg p-4">Kaunas</div>
                <div class="bg-white rounded-lg p-4">Klaipėda</div>
                <div class="bg-white rounded-lg p-4">Šiauliai</div>
                <div class="bg-white rounded-lg p-4">Panevėžys</div>
            </div>
        </div>
    </div>

@endsection
