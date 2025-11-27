<template>
    <section class="relative pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-10">
                <span class="inline-block px-4 py-2 bg-primary-light/10 text-primary-light rounded-full text-sm font-semibold mb-4">
                    Populiariausios Paslaugos
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                    Ką norite padaryti šiandien?
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Pasirinkite kategoriją ir raskite profesionalius specialistus per kelias minutes
                </p>
            </div>

            <!-- Category Tabs Navigation -->
            <div class="relative mb-8">
                <!-- Left Arrow -->
                <button
                    v-if="canScrollLeft"
                    @click="manualScrollLeft"
                    class="absolute -left-2 sm:-left-4 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-8 h-8 bg-white rounded-full shadow-md border border-gray-200 hover:bg-gray-50 hover:shadow-lg transition-all duration-200"
                    aria-label="Scroll left"
                >
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Right Arrow -->
                <button
                    v-if="canScrollRight"
                    @click="manualScrollRight"
                    class="absolute -right-2 sm:-right-4 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-8 h-8 bg-white rounded-full shadow-md border border-gray-200 hover:bg-gray-50 hover:shadow-lg transition-all duration-200"
                    aria-label="Scroll right"
                >
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Scroller Container -->
                <div
                    ref="scrollerRef"
                    class="overflow-hidden"
                    @mouseenter="handleMouseEnter"
                    @mouseleave="handleMouseLeave"
                    @touchstart="handleTouchStart"
                    @touchend="handleTouchEnd"
                >
                    <!-- Scrollable Track -->
                    <div
                        ref="trackRef"
                        class="flex gap-2 pb-2 transition-transform duration-100 ease-linear"
                        :style="{ transform: `translateX(${-currentOffset}px)` }"
                        :class="{ 'justify-center': !needsScroll }"
                    >
                        <button
                            v-for="category in categories"
                            :key="category.slug"
                            @click="selectCategory(category.slug)"
                            :class="[
                                'group relative flex flex-col items-center justify-center min-w-[90px] sm:min-w-[100px] p-3 rounded-xl transition-all duration-300 flex-shrink-0',
                                activeCategory === category.slug
                                    ? 'bg-primary-light text-white shadow-lg scale-105'
                                    : 'bg-white text-gray-700 hover:bg-gray-50 hover:shadow-md border border-gray-200 hover:border-primary-light/30'
                            ]"
                            role="tab"
                            :aria-selected="activeCategory === category.slug"
                        >
                            <!-- Icon -->
                            <div
                                :class="[
                                    'w-10 h-10 sm:w-11 sm:h-11 mb-2 rounded-lg flex items-center justify-center transition-all duration-300',
                                    activeCategory === category.slug
                                        ? 'bg-white/20'
                                        : 'bg-primary-light/10 group-hover:bg-primary-light/20'
                                ]"
                            >
                                <svg
                                    :class="[
                                        'w-5 h-5 sm:w-6 sm:h-6 transition-transform duration-300 group-hover:scale-110',
                                        activeCategory === category.slug ? 'text-white' : 'text-primary-light'
                                    ]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :d="getCategoryIcon(category.name)"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    />
                                </svg>
                            </div>

                            <!-- Name -->
                            <span
                                :class="[
                                    'text-xs font-semibold text-center leading-tight whitespace-nowrap',
                                    activeCategory === category.slug ? 'text-white' : 'text-gray-800 group-hover:text-primary-light'
                                ]"
                            >
                                {{ getCategoryDisplayName(category.name) }}
                            </span>

                            <!-- Active dot -->
                            <div
                                v-if="activeCategory === category.slug"
                                class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-white rounded-full shadow-md"
                            />
                        </button>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div v-if="needsScroll" class="flex justify-center mt-3">
                    <div class="h-1 w-16 rounded-full bg-gray-200 overflow-hidden">
                        <div
                            class="h-full bg-primary-light/60 rounded-full transition-all duration-150"
                            :style="{ width: `${scrollPercent}%` }"
                        />
                    </div>
                </div>
            </div>

            <!-- Category Panels -->
            <div class="relative">
                <Transition name="fade" mode="out-in">
                    <div
                        v-if="currentCategory"
                        :key="currentCategory.slug"
                        class="relative bg-white rounded-3xl shadow-xl overflow-hidden"
                    >
                        <!-- Background Image for Namų priežiūra ir valymas -->
                        <div
                            v-if="currentCategory.name === 'Namų priežiūra ir valymas'"
                            class="absolute inset-0 z-0"
                        >
                            <img
                                src="https://cdn.mos.cms.futurecdn.net/CRSQiBvET2uwKdQK97E4Ad-1024-80.jpg.webp"
                                alt="Cleaning services background"
                                class="w-full h-full object-cover"
                            />
                            <!-- Gradient overlay for better readability -->
                            <div class="absolute inset-0 bg-gradient-to-b from-white/0 via-white/0 to-white/0"></div>
                        </div>

                        <!-- Content wrapper with relative positioning -->
                        <div class="relative z-10 p-6 md:p-10">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h3 class="text-2xl md:text-3xl font-bold text-black mb-2">
                                        {{ currentCategory.name }}
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ currentCategory.subcategories.length }} paslaug{{ currentCategory.subcategories.length === 1 ? 'a' : 'os' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Subcategories Grid -->
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                <a
                                    v-for="subcategory in visibleSubcategories"
                                    :key="subcategory.url"
                                    :href="`/search?subcategory=${subcategory.url}`"
                                    :class="[
                                        'group relative flex items-center p-4 rounded-xl border-2 border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300',
                                        currentCategory.name === 'Namų priežiūra ir valymas'
                                            ? 'bg-white/80 backdrop-blur-sm hover:bg-white/90'
                                            : 'bg-white hover:bg-gradient-to-br hover:from-primary-light/5 hover:to-blue-50',
                                        'hover:border-primary-light/30'
                                    ]"
                                >
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-base font-semibold text-gray-900 group-hover:text-primary-light transition-colors">
                                            {{ subcategory.name }}
                                        </h4>
                                    </div>
                                    <svg class="flex-shrink-0 ml-3 w-5 h-5 text-gray-400 group-hover:text-primary-light group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <!-- Show More -->
                                <button
                                    v-if="hasMoreSubcategories"
                                    @click="expandCurrentCategory"
                                    :class="[
                                        'group flex items-center justify-center p-4 rounded-xl border-2 border-dashed border-gray-300 hover:border-primary-light transition-all',
                                        currentCategory.name === 'Namų priežiūra ir valymas'
                                            ? 'bg-white/80 backdrop-blur-sm hover:bg-white/90'
                                            : 'bg-gray-50/50 hover:bg-primary-light/5'
                                    ]"
                                >
                                    <div class="text-center">
                                        <div class="w-10 h-10 mx-auto mb-2 bg-white rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                                            <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-primary-light">
                                            +{{ currentCategory.subcategories.length - 8 }} daugiau
                                        </span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </Transition>
            </div>

            <!-- CTA -->
            <div class="text-center mt-12">
                <a
                    href="/visos-paslaugos"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary-light to-blue-600 text-white font-semibold rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300"
                >
                    <span>Peržiūrėti visas kategorijas</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick, watch } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
        default: () => []
    }
});

// REFS
const scrollerRef = ref(null);
const trackRef = ref(null);
const activeCategory = ref('');
const expandedCategories = ref({});

// Scroll state
const currentOffset = ref(0);
const maxOffset = ref(0);
const containerWidth = ref(0);
const trackWidth = ref(0);

// Auto-scroll state
const isPaused = ref(false);
const direction = ref(1);
const lastTimestamp = ref(0);
const animationId = ref(null);

// Constants
const SCROLL_SPEED = 25;
const PAUSE_AT_EDGE = 1000;
const edgePauseTimeout = ref(null);

// CATEGORY DATA
const categoryDisplayNames = {
    'Namų priežiūra ir valymas': 'Valymas',
    'Kūrybinės Paslaugos': 'Kūryba',
    'Meistrai ir remontas': 'Meistrai',
    'Perkraustymo ir pakavimo paslaugos': 'Kraustymas',
    'Transporto paslaugos': 'Transportas',
    'Sodininkystės ir lauko paslaugos': 'Sodininkystė',
    'Fitnesas ir Sveikatingumas': 'Sportas',
    'Renginių Pagalba': 'Renginiai',
    'Turizmas': 'Turizmas',
    'IT Pagalba': 'IT',
    'Ezoterines Paslaugos': 'Ezoterija',
    'Statyba': 'Statyba',
    'Grožio Paslaugos': 'Grožis'
};

const categoryIcons = {
    'Namų priežiūra ir valymas': 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
    'Kūrybinės Paslaugos': 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
    'Meistrai ir remontas': 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
    'Perkraustymo ir pakavimo paslaugos': 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4',
    'Transporto paslaugos': 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0',
    'Sodininkystės ir lauko paslaugos': 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    'Fitnesas ir Sveikatingumas': 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
    'Renginių Pagalba': 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
    'Turizmas': 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    'IT Pagalba': 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
    'Ezoterines Paslaugos': 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
    'Statyba': 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
    'Grožio Paslaugos': 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'
};

// COMPUTED
const needsScroll = computed(() => maxOffset.value > 0);
const canScrollLeft = computed(() => needsScroll.value && currentOffset.value > 5);
const canScrollRight = computed(() => needsScroll.value && currentOffset.value < maxOffset.value - 5);
const scrollPercent = computed(() => {
    if (maxOffset.value <= 0) return 0;
    return Math.round((currentOffset.value / maxOffset.value) * 100);
});

const currentCategory = computed(() => {
    return props.categories.find(c => c.slug === activeCategory.value) || null;
});

const visibleSubcategories = computed(() => {
    if (!currentCategory.value) return [];
    if (expandedCategories.value[currentCategory.value.slug]) {
        return currentCategory.value.subcategories;
    }
    return currentCategory.value.subcategories.slice(0, 8);
});

const hasMoreSubcategories = computed(() => {
    if (!currentCategory.value) return false;
    return currentCategory.value.subcategories.length > 8 &&
        !expandedCategories.value[currentCategory.value.slug];
});

// HELPERS
const getCategoryDisplayName = (name) => categoryDisplayNames[name] || name;
const getCategoryIcon = (name) => categoryIcons[name] || 'M12 6v6m0 0v6m0-6h6m-6 0H6';
const selectCategory = (slug) => { activeCategory.value = slug; };
const expandCurrentCategory = () => {
    if (currentCategory.value) {
        expandedCategories.value[currentCategory.value.slug] = true;
    }
};

// DIMENSION CALCULATION
const calculateDimensions = () => {
    if (!scrollerRef.value || !trackRef.value) return;
    containerWidth.value = scrollerRef.value.offsetWidth;
    trackWidth.value = trackRef.value.scrollWidth;
    maxOffset.value = Math.max(0, trackWidth.value - containerWidth.value);
    if (currentOffset.value > maxOffset.value) {
        currentOffset.value = maxOffset.value;
    }
};

// MANUAL SCROLL
const manualScrollLeft = () => {
    const step = containerWidth.value * 0.6;
    currentOffset.value = Math.max(0, currentOffset.value - step);
};

const manualScrollRight = () => {
    const step = containerWidth.value * 0.6;
    currentOffset.value = Math.min(maxOffset.value, currentOffset.value + step);
};

// AUTO-SCROLL
const animate = (timestamp) => {
    if (!needsScroll.value) {
        animationId.value = requestAnimationFrame(animate);
        return;
    }

    if (lastTimestamp.value === 0) lastTimestamp.value = timestamp;
    const deltaTime = (timestamp - lastTimestamp.value) / 1000;
    lastTimestamp.value = timestamp;

    if (!isPaused.value) {
        const movement = SCROLL_SPEED * deltaTime * direction.value;
        let newOffset = currentOffset.value + movement;

        if (newOffset >= maxOffset.value) {
            newOffset = maxOffset.value;
            if (direction.value === 1) pauseAtEdge(-1);
        } else if (newOffset <= 0) {
            newOffset = 0;
            if (direction.value === -1) pauseAtEdge(1);
        }

        currentOffset.value = newOffset;
    }

    animationId.value = requestAnimationFrame(animate);
};

const pauseAtEdge = (newDirection) => {
    isPaused.value = true;
    if (edgePauseTimeout.value) clearTimeout(edgePauseTimeout.value);
    edgePauseTimeout.value = setTimeout(() => {
        direction.value = newDirection;
        isPaused.value = false;
    }, PAUSE_AT_EDGE);
};

const startAnimation = () => {
    if (animationId.value) return;
    lastTimestamp.value = 0;
    animationId.value = requestAnimationFrame(animate);
};

const stopAnimation = () => {
    if (animationId.value) {
        cancelAnimationFrame(animationId.value);
        animationId.value = null;
    }
    if (edgePauseTimeout.value) {
        clearTimeout(edgePauseTimeout.value);
        edgePauseTimeout.value = null;
    }
};

// EVENT HANDLERS
const handleMouseEnter = () => { isPaused.value = true; };
const handleMouseLeave = () => { isPaused.value = false; };
const handleTouchStart = () => { isPaused.value = true; };
const handleTouchEnd = () => { setTimeout(() => { isPaused.value = false; }, 300); };

// LIFECYCLE
onMounted(() => {
    if (props.categories.length > 0) {
        activeCategory.value = props.categories[0].slug;
    }

    nextTick(() => {
        calculateDimensions();
        setTimeout(calculateDimensions, 100);
        setTimeout(calculateDimensions, 500);
        setTimeout(() => {
            if (needsScroll.value) startAnimation();
        }, 1000);
    });

    window.addEventListener('resize', calculateDimensions);
});

onUnmounted(() => {
    stopAnimation();
    window.removeEventListener('resize', calculateDimensions);
});

watch(() => props.categories, () => { nextTick(calculateDimensions); }, { deep: true });
watch(needsScroll, (needs) => { if (needs && !animationId.value) startAnimation(); });
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
