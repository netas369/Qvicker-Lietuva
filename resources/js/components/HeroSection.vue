<template>
    <div class="relative overflow-hidden min-h-screen">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-purple-50">
            <!-- Animated Grid -->
            <div class="absolute inset-0 opacity-20">
                <div
                    class="absolute inset-0 bg-grid-pattern"
                    :style="{
            transform: `translate(${mouseX * 0.02}px, ${mouseY * 0.02}px)`
          }"
                ></div>
            </div>

            <!-- Floating Orbs -->
            <div
                v-for="(orb, index) in orbs"
                :key="index"
                class="absolute rounded-full mix-blend-multiply filter blur-3xl animate-pulse"
                :class="orb.color"
                :style="{
          width: orb.size + 'px',
          height: orb.size + 'px',
          left: orb.x + '%',
          top: orb.y + '%',
          transform: `translate(${mouseX * orb.speed}px, ${mouseY * orb.speed}px)`,
          animationDelay: orb.delay + 's',
          transition: 'transform 0.3s ease-out'
        }"
            ></div>

            <!-- Animated Particles -->
            <div class="absolute inset-0 overflow-hidden">
                <div
                    v-for="(particle, index) in particles"
                    :key="'particle-' + index"
                    class="absolute w-2 h-2 bg-primary-light rounded-full opacity-30"
                    :style="{
            left: particle.x + '%',
            top: particle.y + '%',
            animation: `float ${particle.duration}s ease-in-out infinite`,
            animationDelay: particle.delay + 's'
          }"
                ></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 pt-32 pb-12">
            <!-- Hero Section with Staggered Animation -->
            <div class="text-center">
                <div class="inline-block">
          <span
              class="inline-block px-4 py-2 mb-6 text-sm font-semibold text-primary-light bg-primary-light/10 rounded-full backdrop-blur-sm border border-primary-light/20"
              :class="{ 'animate-fade-in-down': isVisible }"
          >
            🎉 Prisijunkite prie 1000+ patenkintų vartotojų
          </span>
                </div>

                <h1
                    class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6"
                    :class="{ 'animate-fade-in-up': isVisible }"
                >
          <span
              v-for="(word, index) in heroWords"
              :key="index"
              class="inline-block bg-gradient-to-r from-primary-light to-blue-600 bg-clip-text text-transparent"
              :style="{ animationDelay: (index * 0.1) + 's' }"
              :class="{ 'animate-word-fade': isVisible }"
          >
            {{ word }}&nbsp;
          </span>
                </h1>

                <p
                    class="mt-8 text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed"
                    :class="{ 'animate-fade-in-up': isVisible }"
                    style="animation-delay: 0.4s"
                >
                    Susisiekite tiesiogiai su
                    <span class="relative inline-block">
            <span class="text-primary-light font-semibold">patikimais</span>
            <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 100 8" preserveAspectRatio="none">
              <path d="M0,7 Q50,0 100,7" stroke="currentColor" stroke-width="2" fill="none" class="text-primary-light"/>
            </svg>
          </span>
                    paslaugų teikėjais visiems namų poreikiams.
                </p>

                <!-- Animated Feature Pills -->
                <div
                    class="flex flex-wrap justify-center gap-4 mt-12"
                    :class="{ 'animate-fade-in-up': isVisible }"
                    style="animation-delay: 0.6s"
                >
                    <div
                        v-for="(feature, index) in features"
                        :key="index"
                        class="group px-6 py-3 bg-white/80 backdrop-blur-sm rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 cursor-pointer border border-gray-100"
                        @mouseenter="hoveredFeature = index"
                        @mouseleave="hoveredFeature = null"
                    >
                        <div class="flex items-center gap-2">
              <span class="text-2xl transform group-hover:scale-110 transition-transform duration-300">
                {{ feature.icon }}
              </span>
                            <span class="text-gray-700 font-medium">{{ feature.text }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Search Bar with Glow Effect -->
            <div
                class="mt-16 relative"
                :class="{ 'animate-fade-in-up': isVisible }"
                style="animation-delay: 0.8s"
            >
                <div
                    class="absolute inset-0 bg-gradient-to-r from-primary-light/30 to-blue-600/30 blur-3xl transition-all duration-500"
                    :style="{
            opacity: searchFocused ? 1 : 0.5,
            transform: searchFocused ? 'scale(1.1)' : 'scale(1)'
          }"
                ></div>

                <div class="relative bg-white rounded-2xl shadow-2xl p-4 backdrop-blur-sm border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="relative flex-1">
                            <input
                                type="text"
                                v-model="searchQuery"
                                @focus="searchFocused = true"
                                @blur="searchFocused = false"
                                placeholder="Kokios paslaugos jums reikia?"
                                class="w-full px-6 py-4 text-lg rounded-xl border-2 border-transparent focus:border-primary-light focus:outline-none transition-all duration-300"
                            />
                            <div
                                v-if="searchQuery.length > 0"
                                class="absolute right-4 top-1/2 -translate-y-1/2"
                            >
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <button
                            class="group relative px-8 py-4 bg-gradient-to-r from-primary-light to-blue-600 text-white rounded-xl font-semibold overflow-hidden transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
                            @click="handleSearch"
                        >
              <span class="relative z-10 flex items-center gap-2">
                <span>Ieškoti</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
              </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-primary-light opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>

                    <!-- Quick Suggestions -->
                    <div v-if="searchFocused || searchQuery.length > 0" class="mt-4 flex flex-wrap gap-2">
                        <span class="text-sm text-gray-500 mr-2">Populiaru:</span>
                        <button
                            v-for="(suggestion, index) in suggestions"
                            :key="index"
                            @click="searchQuery = suggestion"
                            class="px-3 py-1 text-sm bg-gray-100 hover:bg-primary-light hover:text-white rounded-full transition-all duration-300 transform hover:scale-105"
                        >
                            {{ suggestion }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Trust Indicators with Animation -->
            <div
                class="mt-16 flex flex-wrap justify-center items-center gap-8"
                :class="{ 'animate-fade-in-up': isVisible }"
                style="animation-delay: 1s"
            >
                <div
                    v-for="(badge, index) in trustBadges"
                    :key="index"
                    class="group flex items-center gap-3 px-6 py-3 bg-white/80 backdrop-blur-sm rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer"
                >
                    <div
                        class="w-10 h-10 rounded-full flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300"
                        :class="badge.bgColor"
                    >
                        <component :is="badge.icon" class="w-6 h-6" :class="badge.iconColor" />
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-800">{{ badge.title }}</div>
                        <div class="text-xs text-gray-600">{{ badge.subtitle }}</div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div
                class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce"
                :class="{ 'opacity-0': !showScrollIndicator }"
            >
                <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>

        <!-- Floating Action Button -->
        <transition name="fab">
            <div
                v-if="showFAB"
                class="fixed bottom-8 right-8 z-50"
            >
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-primary-light to-blue-600 rounded-full blur-lg opacity-75 group-hover:opacity-100 transition duration-300 animate-pulse"></div>
                    <button
                        class="relative flex items-center gap-3 bg-gradient-to-r from-primary-light to-blue-600 text-white px-6 py-4 rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300 font-semibold"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="hidden md:inline">Rasti paslaugą</span>
                    </button>
                </div>
            </div>
        </transition>

<!--        &lt;!&ndash; Activity Ticker &ndash;&gt;-->
<!--        <transition name="slide-left">-->
<!--            <div-->
<!--                v-if="showActivity"-->
<!--                class="fixed top-24 right-8 z-40 max-w-sm"-->
<!--            >-->
<!--                <div class="bg-white rounded-2xl shadow-2xl p-4 border-l-4 border-green-500 backdrop-blur-sm">-->
<!--                    <div class="flex items-start gap-3">-->
<!--                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center animate-pulse">-->
<!--                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">-->
<!--                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <div class="flex-1 min-w-0">-->
<!--                            <p class="text-sm font-semibold text-gray-900">{{ currentActivity.name }}</p>-->
<!--                            <p class="text-xs text-gray-600">{{ currentActivity.text }}</p>-->
<!--                            <p class="text-xs text-gray-400 mt-1">Ką tik</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </transition>-->
    </div>
</template>

<script>
export default {
    name: 'HeroSection',
    data() {
        return {
            isVisible: false,
            mouseX: 0,
            mouseY: 0,
            searchQuery: '',
            searchFocused: false,
            hoveredFeature: null,
            showFAB: false,
            showScrollIndicator: true,
            showActivity: false,
            currentActivityIndex: 0,

            heroWords: ['Rasti', 'profesionalią', 'pagalbą', '-', 'dabar', 'lengva.'],

            orbs: [
                { x: 10, y: 20, size: 400, color: 'bg-blue-200', speed: 0.02, delay: 0 },
                { x: 70, y: 60, size: 350, color: 'bg-purple-200', speed: 0.03, delay: 1 },
                { x: 40, y: 40, size: 300, color: 'bg-pink-200', speed: 0.025, delay: 2 },
            ],

            particles: [],


            suggestions: [
                'Santechnikas',
                'Elektrikas',
                'Valymas',
                'Fotografas',
                'Remonto darbai'
            ],

            trustBadges: [
            ],

            activities: [
                { name: 'Jonas K.', text: 'užsakė santechniką Vilniuje' },
                { name: 'Laura M.', text: 'surado fotografą Kaune' },
                { name: 'Tomas S.', text: 'pasamdė valytoją Klaipėdoje' },
                { name: 'Greta P.', text: 'rado elektriką Šiauliuose' },
                { name: 'Mindaugas R.', text: 'užsakė kraustymą Panevėžyje' }
            ]
        }
    },

    computed: {
        currentActivity() {
            return this.activities[this.currentActivityIndex];
        }
    },

    mounted() {
        // Trigger animations on mount
        setTimeout(() => {
            this.isVisible = true;
        }, 100);

        // Generate particles
        this.generateParticles();

        // Mouse move parallax
        document.addEventListener('mousemove', this.handleMouseMove);

        // Scroll listeners
        window.addEventListener('scroll', this.handleScroll);

        // Activity ticker
        setTimeout(() => this.showActivityTicker(), 3000);
        setInterval(() => this.showActivityTicker(), 15000);
    },

    beforeUnmount() {
        document.removeEventListener('mousemove', this.handleMouseMove);
        window.removeEventListener('scroll', this.handleScroll);
    },

    methods: {
        generateParticles() {
            for (let i = 0; i < 20; i++) {
                this.particles.push({
                    x: Math.random() * 100,
                    y: Math.random() * 100,
                    duration: 3 + Math.random() * 4,
                    delay: Math.random() * 5
                });
            }
        },

        handleMouseMove(e) {
            this.mouseX = (e.clientX / window.innerWidth - 0.5) * 20;
            this.mouseY = (e.clientY / window.innerHeight - 0.5) * 20;
        },

        handleScroll() {
            const scrollY = window.scrollY;
            this.showFAB = scrollY > 300;
            this.showScrollIndicator = scrollY < 100;
        },

        handleSearch() {
            if (this.searchQuery.trim()) {
                window.location.href = `/search?q=${encodeURIComponent(this.searchQuery)}`;
            }
        },

        showActivityTicker() {
            this.showActivity = true;
            this.currentActivityIndex = Math.floor(Math.random() * this.activities.length);

            setTimeout(() => {
                this.showActivity = false;
            }, 5000);
        }
    },

    components: {
        CheckIcon: {
            template: `
        <svg fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      `
        },
        ShieldIcon: {
            template: `
        <svg fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
      `
        },
        StarIcon: {
            template: `
        <svg fill="currentColor" viewBox="0 0 20 20">
          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
      `
        }
    }
}
</script>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes word-fade {
    from {
        opacity: 0;
        transform: translateY(20px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.6s ease-out forwards;
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
}

.animate-word-fade {
    animation: word-fade 0.5s ease-out forwards;
    opacity: 0;
}

/* Background Grid Pattern */
.bg-grid-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23266867' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v6h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

/* Transitions */
.fab-enter-active, .fab-leave-active {
    transition: all 0.3s ease;
}

.fab-enter-from, .fab-leave-to {
    opacity: 0;
    transform: translateY(20px);
}

.slide-left-enter-active, .slide-left-leave-active {
    transition: all 0.5s ease;
}

.slide-left-enter-from {
    opacity: 0;
    transform: translateX(100%);
}

.slide-left-leave-to {
    opacity: 0;
    transform: translateX(100%);
}
</style>
