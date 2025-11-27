<template>
    <section class="py-20 relative overflow-hidden">
        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
            <div class="w-full grid lg:grid-cols-2 grid-cols-1 gap-12 items-center">
                <!-- Content Side -->
                <div
                    class="w-full flex-col justify-center lg:items-start items-center gap-10 inline-flex transition-all duration-700"
                    :class="{ 'opacity-100 translate-x-0': isVisible, 'opacity-0 -translate-x-10': !isVisible }"
                >
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-light/10 rounded-full">
                        <span class="w-2 h-2 bg-primary-light rounded-full animate-ping"></span>
                        <span class="text-primary-light font-semibold text-sm">APIE MUS</span>
                    </div>

                    <!-- Title -->
                    <div class="w-full flex-col gap-6 flex">
                        <h2 class="text-primary text-5xl font-bold leading-tight lg:text-start text-center">
              <span class="bg-gradient-to-r from-primary-light to-blue-600 bg-clip-text text-transparent">
                Skatiname Bendruomenes
              </span>
                            <br>
                            Dirbti Kartu
                        </h2>
                        <p class="text-gray-600 text-lg leading-relaxed lg:text-start text-center">
                            Qvicker sujungia žmones, kuriems reikia paslaugų, su patikimais specialistais jų mieste. Mūsų platforma pagrįsta pasitikėjimu ir bendradarbiavimu.
                        </p>
                    </div>

                    <!-- Animated Stats -->
                    <div class="w-full grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div
                            v-for="(stat, index) in stats"
                            :key="index"
                            class="group relative overflow-hidden"
                        >
                            <!-- Background Animation -->
                            <div
                                class="absolute inset-0 rounded-2xl transition-all duration-300"
                                :class="stat.bgClass"
                            ></div>

                            <!-- Hover Glow -->
                            <div
                                class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"
                                :class="stat.glowClass"
                            ></div>

                            <!-- Content -->
                            <div class="relative p-6 rounded-2xl transform group-hover:scale-105 transition-all duration-300">
                                <div class="flex flex-col">
                                    <!-- Animated Counter -->
                                    <h3
                                        class="text-4xl font-bold mb-2 transform group-hover:scale-110 transition-transform duration-300"
                                        :class="stat.textClass"
                                    >
                    <span
                        ref="counters"
                        :data-target="stat.value"
                        :data-suffix="stat.suffix"
                    >
                      0
                    </span>{{ stat.suffix }}
                                    </h3>

                                    <h6 class="text-gray-600 text-base font-medium">
                                        {{ stat.label }}
                                    </h6>

                                    <!-- Progress Bar -->
                                    <div class="mt-4 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div
                                            class="h-full rounded-full transition-all duration-1000 ease-out"
                                            :class="stat.progressClass"
                                            :style="{ width: stat.visible ? '100%' : '0%' }"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features List -->
                    <div class="w-full space-y-4">
                        <div
                            v-for="(feature, index) in features"
                            :key="index"
                            class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-all duration-300 transform hover:translate-x-2"
                            :style="{ transitionDelay: (index * 0.1) + 's' }"
                        >
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center transform hover:rotate-12 transition-transform duration-300"
                                :class="feature.iconBg"
                            >
                                <component :is="feature.icon" :class="feature.iconColor" />
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">{{ feature.title }}</h4>
                                <p class="text-gray-600 text-sm">{{ feature.description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <button
                        class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary-light to-blue-600 text-white rounded-xl font-semibold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 overflow-hidden"
                    >
                        <span class="relative z-10">Sužinoti Daugiau</span>
                        <svg class="relative z-10 w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-primary-light opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>

                <!-- Images Side -->
                <div
                    class="w-full grid sm:grid-cols-2 grid-cols-1 gap-6 lg:order-last order-first transition-all duration-700"
                    :class="{ 'opacity-100 translate-x-0': isVisible, 'opacity-0 translate-x-10': !isVisible }"
                >
                    <!-- Image 1 with Parallax -->
                    <div
                        class="pt-24 transform transition-all duration-500"
                        :style="{ transform: `translateY(${scrollOffset * 0.5}px)` }"
                    >
                        <div class="relative group">
                            <!-- Glow Effect -->
                            <div class="absolute -inset-4 bg-gradient-to-r from-primary-light to-blue-600 rounded-2xl blur-2xl opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>

                            <!-- Image Container -->
                            <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                                <img
                                    class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-700"
                                    src="/images/landingpage/delivery-man.webp"
                                    alt="Delivery service professional"
                                />

                                <!-- Overlay Info -->
                                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="text-white font-semibold">Greitas pristatymas</p>
                                    <p class="text-white/80 text-sm">Patikimi paslaugų teikėjai</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Image 2 with Parallax -->
                    <div
                        class="transform transition-all duration-500"
                        :style="{ transform: `translateY(${scrollOffset * 0.3}px)` }"
                    >
                        <div class="relative group">
                            <div class="absolute -inset-4 bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl blur-2xl opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>

                            <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                                <img
                                    class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-700"
                                    src="/images/landingpage/wedding-planner1.webp"
                                    alt="Wedding planning service"
                                />

                                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="text-white font-semibold">Renginių planavimas</p>
                                    <p class="text-white/80 text-sm">Profesionalus požiūris</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Floating Stats Cards -->
                    <div
                        v-for="(card, index) in floatingCards"
                        :key="index"
                        class="absolute bg-white rounded-xl shadow-2xl p-4 transform transition-all duration-500"
                        :class="card.visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                        :style="{
              [card.position]: card.offset,
              transitionDelay: (index * 0.2) + 's',
              zIndex: 10 + index
            }"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg flex items-center justify-center"
                                :class="card.bgClass"
                            >
                                <span class="text-xl">{{ card.icon }}</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold" :class="card.textClass">{{ card.value }}</p>
                                <p class="text-xs text-gray-600">{{ card.label }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'AboutSection',
    data() {
        return {
            isVisible: false,
            scrollOffset: 0,
            stats: [
                {
                    value: 100,
                    suffix: '+',
                    label: 'Paslaugų Rūšių',
                    bgClass: 'bg-gradient-to-br from-primary-light/10 to-primary-light/5',
                    glowClass: 'bg-primary-light/30',
                    textClass: 'text-primary-light',
                    progressClass: 'bg-gradient-to-r from-primary-light to-blue-600',
                    visible: false
                },
                {
                    value: 500,
                    suffix: '+',
                    label: 'Atliktų Užsakymų',
                    bgClass: 'bg-gradient-to-br from-blue-500/10 to-blue-500/5',
                    glowClass: 'bg-blue-500/30',
                    textClass: 'text-blue-600',
                    progressClass: 'bg-gradient-to-r from-blue-500 to-blue-700',
                    visible: false
                },
                {
                    value: 100,
                    suffix: '+',
                    label: 'Patikimų Partnerių',
                    bgClass: 'bg-gradient-to-br from-green-500/10 to-green-500/5',
                    glowClass: 'bg-green-500/30',
                    textClass: 'text-green-600',
                    progressClass: 'bg-gradient-to-r from-green-500 to-green-700',
                    visible: false
                }
            ],
            features: [
                {
                    icon: 'CheckCircleIcon',
                    iconBg: 'bg-green-100',
                    iconColor: 'text-green-600',
                    title: 'Patikrinti Specialistai',
                    description: 'Visi mūsų partneriai yra kruopščiai patikrinti ir patvirtinti'
                },
                {
                    icon: 'ClockIcon',
                    iconBg: 'bg-purple-100',
                    iconColor: 'text-purple-600',
                    title: 'Greitas Atsakymas',
                    description: 'Specialistai atsako per 24 valandas'
                }
            ],
            floatingCards: [
            ]
        }
    },

    mounted() {
        this.observeSection();
        window.addEventListener('scroll', this.handleScroll);
    },

    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
    },

    methods: {
        observeSection() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.isVisible = true;
                        this.animateCounters();
                        this.animateStats();
                        this.animateFloatingCards();
                    }
                });
            }, { threshold: 0.2 });

            observer.observe(this.$el);
        },

        animateCounters() {
            if (!this.$refs.counters) return;

            const counters = Array.isArray(this.$refs.counters)
                ? this.$refs.counters
                : [this.$refs.counters];

            counters.forEach(counter => {
                const target = parseInt(counter.dataset.target);
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 16);
            });
        },

        animateStats() {
            this.stats.forEach((stat, index) => {
                setTimeout(() => {
                    stat.visible = true;
                }, index * 200);
            });
        },

        animateFloatingCards() {
            this.floatingCards.forEach((card, index) => {
                setTimeout(() => {
                    card.visible = true;
                }, 800 + index * 300);
            });
        },

        handleScroll() {
            const rect = this.$el.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            if (rect.top < windowHeight && rect.bottom > 0) {
                this.scrollOffset = (windowHeight - rect.top) * 0.1;
            }
        }
    },

    components: {
        CheckCircleIcon: {
            template: `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      `
        },
        ShieldIcon: {
            template: `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
      `
        },
        ClockIcon: {
            template: `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      `
        }
    }
}
</script>
