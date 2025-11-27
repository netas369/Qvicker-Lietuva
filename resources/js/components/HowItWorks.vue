<template>
    <section class="py-20 relative bg-gradient-to-b from-gray-50/50 to-white rounded-3xl overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden opacity-30">
            <div
                v-for="(line, index) in connectingLines"
                :key="index"
                class="absolute h-0.5 bg-gradient-to-r from-transparent via-primary-light to-transparent"
                :style="{
          width: line.width + '%',
          left: line.x + '%',
          top: line.y + '%',
          transform: `rotate(${line.rotation}deg)`,
          animation: `pulse-line ${line.duration}s ease-in-out infinite`,
          animationDelay: line.delay + 's'
        }"
            ></div>
        </div>

        <div class="w-full max-w-7xl px-4 md:px-8 mx-auto relative z-10">
            <!-- Section Header -->
            <div
                class="w-full max-w-2xl mx-auto text-center mb-16 transition-all duration-700"
                :class="{ 'opacity-100 translate-y-0': isVisible, 'opacity-0 translate-y-10': !isVisible }"
            >
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-light/10 rounded-full mb-6">
                    <span class="w-2 h-2 bg-primary-light rounded-full animate-ping"></span>
                    <span class="text-primary-light font-semibold text-sm">PROCESAS</span>
                </div>

                <h2 class="text-primary-light text-5xl font-bold mb-6 bg-gradient-to-r from-primary-light to-blue-600 bg-clip-text text-transparent">
                    Kaip viskas veikia
                </h2>
                <p class="text-gray-600 text-xl leading-relaxed">
                    Raskite tinkamą specialistą vos trimis paprastais žingsniais
                </p>
            </div>

            <!-- Process Steps -->
            <div class="relative">
                <!-- Connection Line (Desktop) -->
                <div class="hidden md:block absolute top-32 left-0 right-0 h-1 z-0">
                    <div class="w-full h-full bg-gradient-to-r from-transparent via-primary-light/20 to-transparent">
                        <div
                            class="h-full bg-gradient-to-r from-primary-light to-blue-600 transition-all duration-1000 ease-out"
                            :style="{ width: progressWidth + '%' }"
                        ></div>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-8 relative z-10">
                    <!-- Step 1 -->
                    <div
                        ref="step1"
                        class="group relative transition-all duration-700"
                        :class="{
              'opacity-100 translate-y-0': steps[0].visible,
              'opacity-0 translate-y-10': !steps[0].visible
            }"
                        @mouseenter="activeStep = 0"
                        @mouseleave="activeStep = null"
                    >
                        <div class="relative p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <!-- Animated Border -->
                            <div
                                class="absolute inset-0 rounded-2xl transition-all duration-500"
                                :class="activeStep === 0 ? 'ring-4 ring-primary-light/30' : ''"
                            ></div>

                            <!-- Step Number Badge -->
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-primary-light rounded-full blur-xl opacity-50 animate-pulse"></div>
                                    <div class="relative w-16 h-16 bg-gradient-to-br from-primary-light to-blue-600 rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold text-2xl">1</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Icon -->
                            <div class="relative mt-8 mb-6">
                                <div
                                    class="w-32 h-32 mx-auto rounded-2xl bg-gradient-to-br from-blue-50 to-purple-50 flex items-center justify-center transform group-hover:rotate-6 transition-all duration-500"
                                    :style="{ transform: activeStep === 0 ? 'rotate(6deg) scale(1.05)' : '' }"
                                >
                                    <svg class="w-16 h-16 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>

                                <!-- Floating Particles -->
                                <div
                                    v-for="i in 3"
                                    :key="'p1-' + i"
                                    class="absolute w-2 h-2 bg-primary-light rounded-full opacity-0 group-hover:opacity-60 transition-opacity duration-500"
                                    :style="{
                    top: Math.random() * 100 + '%',
                    left: Math.random() * 100 + '%',
                    animation: `float 3s ease-in-out infinite`,
                    animationDelay: i * 0.5 + 's'
                  }"
                                ></div>
                            </div>

                            <!-- Content -->
                            <h4 class="text-gray-800 text-2xl font-bold mb-4 text-center">
                                Pasirinkite kategoriją
                            </h4>
                            <p class="text-gray-600 text-center leading-relaxed mb-6">
                                Greitai raskite reikiamą paslaugą naudodami paiešką arba naršykite kategorijose.
                            </p>

                            <!-- Progress Indicator -->
                            <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
                                <div
                                    class="h-full bg-gradient-to-r from-primary-light to-blue-600 transition-all duration-1000 ease-out"
                                    :style="{ width: steps[0].visible ? '100%' : '0%' }"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div
                        ref="step2"
                        class="group relative transition-all duration-700"
                        :class="{
              'opacity-100 translate-y-0': steps[1].visible,
              'opacity-0 translate-y-10': !steps[1].visible
            }"
                        style="transition-delay: 0.2s"
                        @mouseenter="activeStep = 1"
                        @mouseleave="activeStep = null"
                    >
                        <div class="relative p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div
                                class="absolute inset-0 rounded-2xl transition-all duration-500"
                                :class="activeStep === 1 ? 'ring-4 ring-blue-600/30' : ''"
                            ></div>

                            <div class="absolute -top-6 left-1/2 -translate-x-1/2">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-blue-600 rounded-full blur-xl opacity-50 animate-pulse"></div>
                                    <div class="relative w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold text-2xl">2</span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative mt-8 mb-6">
                                <div
                                    class="w-32 h-32 mx-auto rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center transform group-hover:rotate-6 transition-all duration-500"
                                    :style="{ transform: activeStep === 1 ? 'rotate(6deg) scale(1.05)' : '' }"
                                >
                                    <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>

                                <div
                                    v-for="i in 3"
                                    :key="'p2-' + i"
                                    class="absolute w-2 h-2 bg-blue-600 rounded-full opacity-0 group-hover:opacity-60 transition-opacity duration-500"
                                    :style="{
                    top: Math.random() * 100 + '%',
                    left: Math.random() * 100 + '%',
                    animation: `float 3s ease-in-out infinite`,
                    animationDelay: i * 0.5 + 's'
                  }"
                                ></div>
                            </div>

                            <h4 class="text-gray-800 text-2xl font-bold mb-4 text-center">
                                Išsirinkite specialistą
                            </h4>
                            <p class="text-gray-600 text-center leading-relaxed mb-6">
                                Peržiūrėkite įvertinimus, kainas ir patirtį, kad rastumėte geriausią specialistą.
                            </p>

                            <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
                                <div
                                    class="h-full bg-gradient-to-r from-blue-500 to-blue-700 transition-all duration-1000 ease-out"
                                    :style="{ width: steps[1].visible ? '100%' : '0%' }"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div
                        ref="step3"
                        class="group relative transition-all duration-700"
                        :class="{
              'opacity-100 translate-y-0': steps[2].visible,
              'opacity-0 translate-y-10': !steps[2].visible
            }"
                        style="transition-delay: 0.4s"
                        @mouseenter="activeStep = 2"
                        @mouseleave="activeStep = null"
                    >
                        <div class="relative p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div
                                class="absolute inset-0 rounded-2xl transition-all duration-500"
                                :class="activeStep === 2 ? 'ring-4 ring-green-500/30' : ''"
                            ></div>

                            <div class="absolute -top-6 left-1/2 -translate-x-1/2">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-green-500 rounded-full blur-xl opacity-50 animate-pulse"></div>
                                    <div class="relative w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold text-2xl">3</span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative mt-8 mb-6">
                                <div
                                    class="w-32 h-32 mx-auto rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 flex items-center justify-center transform group-hover:rotate-6 transition-all duration-500"
                                    :style="{ transform: activeStep === 2 ? 'rotate(6deg) scale(1.05)' : '' }"
                                >
                                    <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>

                                <div
                                    v-for="i in 3"
                                    :key="'p3-' + i"
                                    class="absolute w-2 h-2 bg-green-600 rounded-full opacity-0 group-hover:opacity-60 transition-opacity duration-500"
                                    :style="{
                    top: Math.random() * 100 + '%',
                    left: Math.random() * 100 + '%',
                    animation: `float 3s ease-in-out infinite`,
                    animationDelay: i * 0.5 + 's'
                  }"
                                ></div>
                            </div>

                            <h4 class="text-gray-800 text-2xl font-bold mb-4 text-center">
                                Susisiekite ir užsakykite
                            </h4>
                            <p class="text-gray-600 text-center leading-relaxed mb-6">
                                Tiesiogiai susisiekite, aptarkite detales ir po paslaugos suteikimo palikite atsiliepimą.
                            </p>

                            <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
                                <div
                                    class="h-full bg-gradient-to-r from-green-500 to-green-700 transition-all duration-1000 ease-out"
                                    :style="{ width: steps[2].visible ? '100%' : '0%' }"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div
                class="mt-16 text-center transition-all duration-700"
                :class="{ 'opacity-100 translate-y-0': isVisible, 'opacity-0 translate-y-10': !isVisible }"
                style="transition-delay: 0.6s"
            >
                <button
                    class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary-light to-blue-600 text-white rounded-xl font-semibold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 overflow-hidden"
                >
                    <span class="relative z-10">Pradėti Dabar</span>
                    <svg class="relative z-10 w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-primary-light opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'HowItWorks',
    data() {
        return {
            isVisible: false,
            activeStep: null,
            steps: [
                { visible: false },
                { visible: false },
                { visible: false }
            ],
            progressWidth: 0,
            connectingLines: []
        }
    },

    mounted() {
        this.generateConnectingLines();
        this.observeSection();
    },

    methods: {
        generateConnectingLines() {
            for (let i = 0; i < 5; i++) {
                this.connectingLines.push({
                    width: 30 + Math.random() * 40,
                    x: Math.random() * 70,
                    y: Math.random() * 100,
                    rotation: -45 + Math.random() * 90,
                    duration: 3 + Math.random() * 3,
                    delay: Math.random() * 2
                });
            }
        },

        observeSection() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.isVisible = true;
                        this.animateSteps();
                    }
                });
            }, { threshold: 0.2 });

            observer.observe(this.$el);
        },

        animateSteps() {
            // Animate steps sequentially
            setTimeout(() => {
                this.steps[0].visible = true;
                this.progressWidth = 33;
            }, 200);

            setTimeout(() => {
                this.steps[1].visible = true;
                this.progressWidth = 66;
            }, 600);

            setTimeout(() => {
                this.steps[2].visible = true;
                this.progressWidth = 100;
            }, 1000);
        }
    }
}
</script>

<style scoped>
@keyframes pulse-line {
    0%, 100% {
        opacity: 0.3;
        transform: scaleX(1);
    }
    50% {
        opacity: 0.6;
        transform: scaleX(1.05);
    }
}
</style>
