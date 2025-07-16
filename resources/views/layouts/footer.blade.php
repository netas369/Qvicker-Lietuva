{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-primary text-white">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Company Info -->
            <div class="lg:col-span-1">
                <div class="mb-6">
                    <a href="#" class="inline-block">
                        <h3 class="text-2xl font-bold text-white">
                            Q<span class="text-primary-verylight">vicker</span>
                            <small class="text-gray-300 text-xs ml-1">LT</small>
                        </h3>
                    </a>
                </div>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Paslaugų teikėjai vienoje vietoje. Modernus sprendimas jūsų kasdieninėm problemom.
                </p>

                <!-- Social Media Links -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-primary-verylight transition-colors duration-300" aria-label="Twitter">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary-verylight transition-colors duration-300" aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary-verylight transition-colors duration-300" aria-label="Instagram">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348zm7.718 0c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary-verylight transition-colors duration-300" aria-label="LinkedIn">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-6">Navigacija</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('landingpage') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Pagrindinis</a></li>
                    <li><a href="{{ route('aboutus') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Apie Mus</a></li>
                    <li><a href="{{ route('duk') }}" class="text-gray-300 hover:text-white transition-colors duration-300">DUK</a></li>
                    <li><a href="{{ route('partners') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Partneriams</a></li>
                    <li><a href="{{ route('seekers') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Naudotojams</a></li>
                </ul>
            </div>

            <!-- Services/Products -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-6">Paslaugos</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Visos Paslaugos</a></li>
                </ul>
            </div>

            <!-- Contact & Support -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-6">Kontaktai ir Pagalba</h4>
                <ul class="space-y-3 mb-6">
                    <li><a href="{{ route('seeker.support') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Pagalba</a></li>
                    <li><a href="{{ route('duk') }}" class="text-gray-300 hover:text-white transition-colors duration-300">DUK</a></li>
                </ul>

                <!-- Contact Info -->
                <div class="space-y-2">
                    <div class="flex items-center text-gray-300">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span class="text-sm">info@qvicker.lt</span>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span class="text-sm">+370 600 00000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bottom Footer -->
    <div class="border-t border-primary-dark bg-primary-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="md:flex md:items-center md:justify-between">
                <div class="text-sm text-gray-300">
                    <p>&copy; {{ date('Y') }} <a href="#" class="hover:text-white transition-colors duration-300">Qvicker Lietuva</a>. Visos teisės saugomos.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <ul class="flex flex-wrap items-center space-x-6 text-sm text-gray-300">
                        <li><a href="{{ route('termsofuse') }}" class="hover:text-white transition-colors duration-300">Naudojimo sąlygos</a></li>
                        <li><a href="{{ route('cookies.policy') }}" class="hover:text-white transition-colors duration-300">Slapukų politika</a></li>
                        <li><a href="{{ route('privacy.policy') }}" class="hover:text-white transition-colors duration-300">Privatumo Politika</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Usage in main layout --}}
{{--
@include('components.footer')
or if using Laravel components:
<x-footer />
--}}
