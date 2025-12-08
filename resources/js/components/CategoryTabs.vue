<template>
    <section class="relative pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-3 sm:mt-6">
                    Populiariausios kategorijos
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
                    class="overflow-x-auto overflow-y-hidden scrollbar-hide"
                    @mouseenter="handleMouseEnter"
                    @mouseleave="handleMouseLeave"
                    @touchstart="handleTouchStart"
                    @touchmove="handleTouchMove"
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
                                <div
                                    :class="[
                                        'w-8 h-8 sm:w-9 sm:h-9 transition-transform duration-300 group-hover:scale-110',
                                        activeCategory === category.slug ? 'text-white' : 'text-primary-light'
                                    ]"
                                    v-html="getCategoryIcon(category.name)"
                                ></div>
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
                        <!-- Winter Gradient Background with Snowflakes -->
                        <div class="absolute inset-0 z-0">
                            <!-- Gradient Background -->
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50"></div>

                            <!-- Animated Snowflakes -->
                            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                                <div
                                    v-for="i in 30"
                                    :key="`snowflake-${i}`"
                                    class="snowflake absolute text-white/40"
                                    :style="getSnowflakeStyle(i)"
                                >
                                    ❄
                                </div>
                            </div>

                            <!-- Decorative Circles -->
                            <div class="absolute top-10 right-10 w-64 h-64 bg-primary-light/5 rounded-full blur-3xl"></div>
                            <div class="absolute bottom-10 left-10 w-80 h-80 bg-blue-400/5 rounded-full blur-3xl"></div>
                        </div>

                        <!-- Content wrapper with relative positioning -->
                        <div class="relative z-10 p-6 md:p-10">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
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
                                    class="group relative flex items-center p-4 rounded-xl border-2 border-gray-100 bg-white/80 backdrop-blur-sm hover:bg-white/95 shadow-sm hover:shadow-lg transition-all duration-300 hover:border-primary-light/30"
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
                                    class="group flex items-center justify-center p-4 rounded-xl border-2 border-dashed border-gray-300 hover:border-primary-light transition-all bg-white/80 backdrop-blur-sm hover:bg-white/95"
                                >
                                    <div class="text-center">
                                        <div class="w-4 h-4 mx-auto mb-2 bg-white rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
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
const isUserScrolling = ref(false);
const scrollDebounceTimer = ref(null);



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
    'Namų priežiūra ir valymas': `<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0">
 <path d="m20.688 95.91c-5.5-0.003906-10.664-2.6602-13.871-7.1289-3.207-4.4727-4.0664-10.215-2.3047-15.426 1.7578-5.2148 5.9219-9.2578 11.184-10.871 5.2617-1.6133 10.977-0.59375 15.352 2.7383 2.7266-2.1758 5.082-4.7812 6.9766-7.7109-2.1016-3.5234-1.6094-8.0117 1.207-10.992 2.8164-2.9805 7.2695-3.7266 10.902-1.8281l1.5469 0.81641 1.2148-2.3047v-0.003906c1.5-2.8242 4.9062-4.0391 7.8555-2.8008l18.215-34.637h-0.003906c0.38672-0.73438 1.0469-1.2852 1.8359-1.5312 0.79297-0.24219 1.6484-0.16406 2.3867 0.21875l11.527 6.0625h-0.003907c0.73438 0.38281 1.2852 1.0469 1.5312 1.8359 0.24609 0.79297 0.16406 1.6484-0.22266 2.3828l-18.207 34.637c1.2188 0.76953 2.1211 1.9531 2.543 3.332 0.49219 1.5664 0.33594 3.2617-0.43359 4.7109l-1.2109 2.3047 1.5938 0.83594c4.4648 2.3711 6.168 7.9102 3.8125 12.383-1.4844 2.8125-4.3203 4.6562-7.4961 4.8633-1.4805 3.6133-2.3242 7.4531-2.4961 11.355-0.11719 2.4336-1.4727 4.6406-3.5938 5.8398-2.0547 1.1719-4.5625 1.207-6.6484 0.097656l-15.41-8.1094c-1.4141 5.2578-6.1797 8.9141-11.625 8.9219zm0-27.926c-5.9844 0-10.836 4.8516-10.836 10.836 0 5.9883 4.8516 10.84 10.836 10.84l16.152-0.007812c3.1953-0.003906 5.7852-2.5898 5.7852-5.7852 0-0.36719-0.03125-0.73438-0.10156-1.0938-0.035157-0.12109-0.066407-0.24609-0.085938-0.37109-0.39062-1.4844-1.3516-2.7539-2.6758-3.5273s-2.9023-0.98828-4.3867-0.60156c-0.13672 0.054687-0.27344 0.10156-0.41797 0.13672l-0.078125 0.019532c-1.1367 0.41016-2.1172 1.168-2.8047 2.1641-0.46875 0.68359-1.1914 1.1523-2.0078 1.3047-0.81641 0.15234-1.6562-0.027344-2.3398-0.5-0.68359-0.46875-1.1523-1.1914-1.3008-2.0078-0.15234-0.81641 0.03125-1.6602 0.50391-2.3398 0.89062-1.3008 2.0312-2.4102 3.3516-3.2656-1.8633-3.5742-5.5625-5.8125-9.5938-5.8008zm27.465 11.766 18.645 9.8125c0.19922 0.11719 0.44922 0.11328 0.64844-0.003906 0.26172-0.15625 0.42969-0.4375 0.43359-0.74609 0.20312-4.3438 1.1016-8.6289 2.668-12.688l-27.703-14.566c-2.1133 3.125-4.6758 5.9258-7.6016 8.3086 0.39062 0.63672 0.73828 1.2969 1.0391 1.9805 5.2461-0.20312 10.035 2.9844 11.871 7.9023zm27.473-8.2109h-0.003906c1.3984 0.1875 2.7266-0.64844 3.1641-1.9883 0.43359-1.3398-0.15625-2.8008-1.3945-3.4648l-4.3594-2.293c-0.73438-0.38672-1.2812-1.0469-1.5273-1.8398s-0.16797-1.6484 0.21875-2.3828l2.668-5.0703-1.5625-0.80859c-0.23828-0.0625-0.46875-0.14844-0.68359-0.26562l-11.527-6.0586c-0.082032-0.042969-0.16016-0.089844-0.24219-0.14063l-2.082-1.0781-2.5352 5.0312c-0.38281 0.73437-1.0469 1.2852-1.8359 1.5312-0.79297 0.24609-1.6484 0.16797-2.3828-0.21875l-4.3164-2.2695c-1.2617-0.64844-2.8086-0.29297-3.6641 0.84375-0.85156 1.1328-0.76172 2.7188 0.21484 3.75 0.097656 0.078125 0.1875 0.16406 0.27734 0.25391 0.14453 0.11719 0.30078 0.21875 0.46484 0.30469l30.168 15.863v-0.003906c0.14453 0.078125 0.29688 0.14453 0.45703 0.19531 0.16406 0.023437 0.32422 0.058593 0.48047 0.10937zm5.7266-0.0625m-15.059-28.188 5.9922 3.1523 16.746-31.852-5.9922-3.1523zm-39 17.078c-3.1484 0-5.9883-1.8984-7.1914-4.8047-1.207-2.9102-0.53906-6.2578 1.6875-8.4844 2.2227-2.2227 5.5703-2.8906 8.4805-1.6875 2.9062 1.207 4.8047 4.043 4.8047 7.1914-0.003907 4.2969-3.4844 7.7773-7.7812 7.7852zm0-9.3164c-0.62109 0-1.1797 0.37109-1.418 0.94531-0.23828 0.57422-0.10547 1.2305 0.33203 1.6719 0.4375 0.4375 1.0977 0.56641 1.6719 0.33203 0.57031-0.23828 0.94531-0.79688 0.94531-1.418 0-0.84766-0.6875-1.5312-1.5312-1.5312zm-14.121 3.1719c-1.2188 0-2.3203 0.73438-2.7891 1.8633-0.46484 1.125-0.20703 2.4258 0.65625 3.2891 0.86328 0.86328 2.1602 1.1211 3.2891 0.65234 1.1289-0.46484 1.8633-1.5664 1.8633-2.7891 0-0.80078-0.32031-1.5664-0.88281-2.1328-0.56641-0.56641-1.3359-0.88281-2.1367-0.88281z"/>
`,
    'Kūrybinės Paslaugos': `<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0" >
 <path d="m95.102 83.43c-7.0391-3.3828-8.6797-8.7109-10.098-15.328-1.3047-6.1328-6.0742-11.781-12.156-14.391-1.625-0.69922-3.2617-1.1172-4.8828-1.3203l-5.5547-4.7422 11.82-11.82c0.007812-0.007813 0.019531-0.007813 0.027343-0.019531l8.9805-8.9805c3.6562-3.6562 3.6562-9.6016 0-13.258l-5.1328-5.1328c-3.6523-3.6602-9.6016-3.6523-13.258 0l-8.9805 8.9805c-0.003907 0.003906-0.007813 0.003906-0.007813 0.007812l-13.297 13.301-21.422-18.273c-3.5781-3.0508-8.9727-2.832-12.293 0.49219-3.3203 3.3203-3.5391 8.7188-0.49219 12.289l18.266 21.434-15.156 15.152c-0.28516 0.28125-0.50781 0.61719-0.66797 0.99219l-7.1641 16.91c-1.0117 2.3984-0.47266 5.1328 1.3672 6.9688 1.2227 1.2148 2.832 1.8594 4.4766 1.8594 0.83594 0 1.6797-0.16797 2.4766-0.50781l16.906-7.1641c0.37109-0.16016 0.71094-0.38281 0.99219-0.66797l13.684-13.688 4.9961 5.8672c0.47266 3.7461 2.1016 7.4648 4.8516 10.539 5.9141 6.6133 14.734 11.398 24.484 11.398 5.6758 0 11.664-1.625 17.578-5.4531 0.94922-0.61328 1.4922-1.6914 1.418-2.8203-0.066406-1.1328-0.74219-2.1367-1.7617-2.625zm-25.832-70.566c1.2266-1.2227 3.207-1.2148 4.418-0.003906l5.1328 5.1328c1.2188 1.2188 1.2188 3.1992 0 4.418l-6.7773 6.7773-9.5547-9.5547zm-11.199 11.191 9.5508 9.5508-9.9766 9.9766-10.305-8.7891zm-48.68 58.098 6.125-14.461 6.8672 1.6836 1.6133 6.7539zm20.004-10.32-0.92969-3.9023c-0.55469-2.3516-2.3594-4.1523-4.7031-4.7109l-3.918-0.93359 10.844-10.848 8.7891 10.312zm20.191-7.8516-36.477-42.801c-0.94531-1.1055-0.875-2.7891 0.15625-3.8203 1.0352-1.0312 2.7109-1.0938 3.8164-0.15234l42.668 36.395c-0.56641 0.25781-1.125 0.55469-1.668 0.88281-2.9375 1.8047-6.8281 5.5391-8.4961 9.4961zm8.457 14.773c-2.6562-2.9688-4.5234-7.9258-2.7188-12.305 0.90625-2.2031 3.5547-5.1172 6.0234-6.6328 1.5859-0.97266 3.1836-1.3203 4.6602-1.3203 1.6641 0 3.1797 0.44531 4.375 0.96094 4.207 1.8047 7.625 5.8047 8.5117 9.957 1.0234 4.7852 2.4727 11.574 8.6602 16.613-11.5 4.8281-22.805 0.23047-29.512-7.2734z"/>
</svg>`,
    'Meistrai ir remontas': `<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0">
 <path d="m42.742 93.129h-30.668c-3.4375-0.003906-6.2227-2.7891-6.2266-6.2266v-7.9609c0-3.3789 2.6953-6.1406 6.0742-6.2227l3.0273-25.934c-6.4102-0.58203-11.32-5.9492-11.328-12.383v-15.102c0.007812-6.8594 5.5703-12.422 12.43-12.43h34.348c2.8906 0 5.3828 2.0273 5.9727 4.8555h7.5391c1.7969 0.023438 3.5039 0.80469 4.6914 2.1562 1.1875 1.3516 1.7461 3.1406 1.5352 4.9297h2.6094c3.2539-0.089844 6.2109 1.8789 7.3828 4.9141h13.125c1.7266 0 3.125 1.3984 3.125 3.125 0 1.7266-1.3984 3.125-3.125 3.125h-13.125c-1.1602 3.0195-4.0938 4.9883-7.3281 4.918h-2.6641c0.21094 1.7852-0.34766 3.5742-1.5352 4.9258-1.1875 1.3516-2.8945 2.1328-4.6914 2.1523h-7.5391c-0.79688 3.3203-4.0391 5.4492-7.4023 4.8594v4.2734c-0.003906 3.8359-3.1133 6.9453-6.9531 6.9492h-3.1445l-3.3516 6.8867 1.9844 7.7734c2.8398-0.42969 5.7305 0.38672 7.9258 2.2422 2.1953 1.8555 3.4844 4.5625 3.5391 7.4375v4.5078c-0.003906 3.4375-2.7891 6.2227-6.2266 6.2266zm-30.668-14.164 0.023437 7.9375 30.621-0.019532v-4.4883c0-1.8945-1.5352-3.4297-3.4297-3.4297zm6.1445-6.25h12.832l-1.8711-7.3398c-0.18359-0.71484-0.10547-1.4727 0.21875-2.1406l4.1719-8.5742-2.3398-7.8281h-9.9922zm21.023-20.906h2.7773l-0.003906-0.003906c0.38672 0 0.70312-0.3125 0.70312-0.69922v-4.2734h-4.9688zm6.6055-11.223h4.4062l-0.003906-27.617-34.199 0.15234c-3.4102 0.003906-6.1758 2.7695-6.1797 6.1797v15.102c0.003906 3.4102 2.7695 6.1758 6.1797 6.1797zm10.656-4.8594h7.3867l-0.003906-17.77-7.3867 0.015625zm13.633-7.082h2.6094c0.48047 0.035157 0.94922-0.14844 1.2812-0.49219 0.33203-0.34766 0.49609-0.82422 0.44141-1.3008 0.050781-0.48047-0.11719-0.96094-0.45703-1.3047-0.33594-0.34766-0.8125-0.52344-1.293-0.48438h-2.5781z"/></svg>`,
    'Perkraustymo ir pakavimo paslaugos': `<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0">
 <path d="m96.344 56.312-8.6797-4.3398-8.4688-14.141c-2.1758-3.6094-6.0781-5.8242-10.293-5.8359h-12.902v-16.5c0-1.6562-1.3438-3-3-3h-48c-1.6562 0-3 1.3438-3 3v60c0 1.6562 1.3438 3 3 3h9.3789c1.6562 6.418 8.1992 10.277 14.617 8.625 4.2305-1.0898 7.5312-4.3945 8.625-8.625h24.762c1.6562 6.418 8.1992 10.277 14.617 8.625 4.2305-1.0898 7.5312-4.3945 8.625-8.625h9.375c1.6562 0 3-1.3438 3-3v-16.5c0-1.1367-0.64062-2.1758-1.6562-2.6836zm-46.344-4.8164h-18v-33h18zm-24-33v33h-18v-33zm0 63c-3.3125 0-6-2.6875-6-6s2.6875-6 6-6 6 2.6875 6 6c-0.003906 3.3125-2.6875 5.9961-6 6zm0-18c-5.4688 0.007812-10.246 3.707-11.621 9h-6.3789v-15h42v15h-12.379c-1.375-5.293-6.1523-8.9922-11.621-9zm48 18c-3.3125 0-6-2.6875-6-6s2.6875-6 6-6 6 2.6875 6 6c-0.003906 3.3125-2.6875 5.9961-6 6zm18-9h-6.3789c-1.6562-6.418-8.1992-10.277-14.617-8.625-4.2305 1.0898-7.5312 4.3945-8.625 8.625h-6.3789v-34.5h12.898c2.1094 0.007812 4.0586 1.1133 5.1484 2.918l8.918 14.891c0.29297 0.49219 0.72266 0.88672 1.2344 1.1445l7.8008 3.8984z"/></svg>`,
    'Transporto paslaugos': `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" /></svg>`,
    'Sodininkystės ir lauko paslaugos': `<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0">
 <path d="m96.227 37.691c-4.9336-4.9883-19.633-20.012-20.352-20.684-0.70312-0.625-1.6016-0.77344-2.5-0.72266h-4.4609c-1.5117 0-2.8164 1.1836-2.9297 2.6992-0.03125 0.57031-0.007813 0.875-0.011719 1.5703v12.332c-0.003906 3.6211 0.003906 5.7422 0 8.2578 0.14453-0.14453-5.1523 5.5508-5.3125 5.7266-0.058594-0.32031-0.77344-8.2656-1.1797-12.5-0.16016-1.6719-0.21875-2.4219-0.26172-2.7344-0.17578-1.3711-1.3906-2.4766-2.7695-2.5234-3.1641-0.027343-11.828 0.007813-12.512-0.007812-0.13281-0.64844-0.25-1.4688-0.42969-2.1328-6.7227-24.195-40.961-19.184-40.543 6.0742 0.30469 7.5664 4.9102 14.586 11.691 17.848 1.8242 0.89062 3.8086 1.5117 5.8711 1.8203 0.10938 0.019531 0.042968 0.023437 0.0625 0.054687-0.003906 0.16406 0.003906 0.28906 0 0.53125 0.015625 6.5742-0.011719 32.363 0 32.59-0.019532 1.7109 1.5352 3.1094 3.2461 2.9492 10.344-0.22266 36.984 0.47656 38.852-0.32812 2.0938-1.1133 1.5547-3.1445 1.3672-5.2148-0.39453-4.1992-1.2305-13.129-1.5117-16.133-0.050781-0.52344-0.070313-0.75-0.09375-1.0039 0.085937-0.41016 11.715-12.047 15.434-16.16 0.003907-0.003906 9.1328-1.2188 13.859-1.8477 1.6172-0.21484 2.6758-0.35547 2.7773-0.37109 0.6875-0.097656 1.3633-0.45312 1.8086-0.97656 0.57812-0.64844 0.78906-1.5234 0.73047-2.3906-0.007813-1.1133 0.003906-2.8359 0-3.8672 0.078125-1.0195-0.082032-2.0898-0.80469-2.8281l-0.03125-0.03125zm-87.406-5.6875c0.13672-14.773 18.973-20.684 27.105-8.0312 0.95703 1.5234 1.6562 3.2461 2.0156 5.0742 0.011719 0.085937-0.003906 0.054687-0.035156 0.0625h-0.62109-13.738c-0.76172-0.003906-1.5742 0.32422-2.0938 0.86328-0.54297 0.52344-0.86719 1.332-0.86328 2.0938v12.059 2.5664c-6.5312-1.0703-11.805-7.4805-11.77-14.594zm17.648 50.953c0.007812-8.1953-0.011719-49.543 0.007812-47.965h0.28125c5.8047-0.007813 15.371 0.003906 21.906 0h4.918c0.12891 0.15625 4.4922 47.965 4.5312 47.965-8.1133 0.019531-23.965-0.011719-31.645 0zm64.707-40.664c-0.011719 0.011719-14.836 1.9805-15.105 2.0195-0.55078 0.054688-1.3203 0.44141-1.6875 0.83984-2.5312 2.6484-11.656 12.207-12.578 13.152-0.078126-0.64844-0.23047-2.6875-0.32813-3.6133 0.070313-0.24609 9.2656-9.9883 9.5703-10.371 0.62891-0.65234 0.85547-1.5898 0.79688-2.5078 0.003906-4.75-0.007812-15.207 0.003906-19.641 0.17578-0.03125 0.76172 0.011719 0.83594-0.003906 0.16016 0.10547 0.28125 0.26953 0.48438 0.46484 4.3008 4.3711 10.352 10.527 14.543 14.793 2.0117 2.0508 3.4141 3.4688 3.457 3.5234 0.03125 0.20703-0.015625 1.2695 0.003906 1.3281v0.015625z"/></svg>`,
    'Fitnesas ir Sveikatingumas': `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" viewBox="0 0 134 167.5" version="1.1" xml:space="preserve" style="" x="0px" y="0px" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"><path d="M75.518,42.07l-7.581,-7.581c-4.881,-4.881 -4.881,-12.796 0,-17.678c1.507,-1.507 3.128,-3.127 4.635,-4.635c4.882,-4.881 12.796,-4.881 17.678,0l2.672,2.673l1.013,-1.013c4.882,-4.882 12.796,-4.882 17.678,0c2.973,2.973 6.57,6.57 9.544,9.543c4.881,4.882 4.881,12.797 0,17.678l-1.013,1.013l1.013,1.014c4.881,4.881 4.881,12.796 0,17.677c-1.507,1.507 -3.128,3.128 -4.635,4.635c-4.882,4.882 -12.796,4.882 -17.678,0l-7.581,-7.581l-33.448,33.448l7.581,7.581c4.882,4.882 4.882,12.796 0,17.678c-1.507,1.507 -3.128,3.128 -4.635,4.635c-4.881,4.881 -12.796,4.881 -17.677,0l-1.014,-1.013l-1.013,1.013c-4.881,4.881 -12.796,4.881 -17.678,0c-2.973,-2.974 -6.57,-6.571 -9.543,-9.544c-4.882,-4.882 -4.882,-12.796 0,-17.678l1.013,-1.013l-2.673,-2.672c-4.881,-4.882 -4.881,-12.796 0,-17.678c1.508,-1.507 3.128,-3.128 4.635,-4.635c4.882,-4.881 12.797,-4.881 17.678,0l7.581,7.581l33.448,-33.448Zm-46.921,31.76c8.145,8.145 22.761,22.761 30.907,30.907c1.627,1.627 1.627,4.265 0,5.892c-1.507,1.508 -3.128,3.128 -4.635,4.635c-1.628,1.628 -4.266,1.628 -5.893,0c-8.146,-8.145 -22.761,-22.761 -30.907,-30.907c-1.627,-1.627 -1.627,-4.265 0,-5.892c1.507,-1.507 3.128,-3.128 4.635,-4.635c1.627,-1.628 4.265,-1.628 5.893,0Zm-7.856,24.985l-1.013,1.013c-1.627,1.627 -1.627,4.265 0,5.892c2.974,2.974 6.571,6.571 9.544,9.544c1.627,1.628 4.265,1.628 5.893,0l1.013,-1.013l-15.437,-15.436Zm27.222,-17.404l3.959,3.959l33.448,-33.448l-3.959,-3.959l-33.448,33.448Zm25.867,-52.814c-1.628,-1.628 -1.628,-4.266 0,-5.893c1.507,-1.507 3.128,-3.128 4.635,-4.635c1.627,-1.627 4.265,-1.627 5.892,0c8.146,8.146 22.762,22.761 30.907,30.907c1.628,1.627 1.628,4.265 0,5.893c-1.507,1.507 -3.127,3.128 -4.635,4.635c-1.627,1.627 -4.265,1.627 -5.892,0c-8.146,-8.146 -22.762,-22.762 -30.907,-30.907Zm40.421,7.581l1.013,-1.013c1.628,-1.628 1.628,-4.266 0,-5.893c-2.973,-2.973 -6.57,-6.57 -9.544,-9.544c-1.627,-1.627 -4.265,-1.627 -5.892,0l-1.013,1.013l15.436,15.437Z"/></svg>`,
    'Renginių Pagalba': `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>`,
    'Turizmas': `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
    'IT Pagalba': `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>`,
    'Ezoterines Paslaugos': `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>`,
    'Statyba': `<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0">
 <path d="m81.25 6.25h-1.5625c-2.8438 0-5.375 1.0938-7.3438 2.875-1.7188-1.7812-4.0938-2.875-6.7188-2.875h-14.25c-3.8125 0-7.375 1.7188-9.75 4.6875l-9.6875 12.094c-0.75 0.9375-0.90625 2.2188-0.375 3.3125s1.625 1.7812 2.8125 1.7812h15.625v18.75h-4.9688c-1.6562 0-3.25 0.65625-4.4062 1.8438l-4.4062 4.4062h-14.344c-1.7188 0-3.125 1.4062-3.125 3.125s1.4062 3.125 3.125 3.125h14.344c1.6562 0 3.25-0.65625 4.4062-1.8438l4.4062-4.4062h4.9688v6.25c-1.7188 0-3.125 1.4062-3.125 3.125s1.4062 3.125 3.125 3.125h24.625l-1.8125 16.312c-0.34375 3.1562-3.0312 5.5625-6.2188 5.5625h-21.562l-4.4062-4.4062c-1.1562-1.1562-2.7812-1.8438-4.4062-1.8438h-14.344c-1.7188 0-3.125 1.4062-3.125 3.125s1.4062 3.125 3.125 3.125h14.344l4.4062 4.4062c1.1562 1.1562 2.7812 1.8438 4.4062 1.8438h21.562c6.375 0 11.719-4.7812 12.438-11.125l1.8125-16.312c0.1875-1.75-0.375-3.5312-1.5625-4.8438s-2.875-2.0938-4.6562-2.0938h-5.875v-31.812c1.375-0.5 2.625-1.2812 3.5938-2.3125 1.9375 1.7812 4.5 2.875 7.3438 2.875h1.5625c3.4375 0 6.25-2.8125 6.25-6.25v-9.375c0-3.4375-2.8125-6.25-6.25-6.25zm-25 53.125v-31.25h6.25v31.25zm12.5-40.625c0 1.7188-1.4062 3.125-3.125 3.125h-24.75l5.625-7.0312c1.1875-1.5 2.9688-2.3438 4.875-2.3438h14.25c1.7188 0 3.125 1.4062 3.125 3.125zm10.938 3.125c-2.5938 0-4.6875-2.0938-4.6875-4.6875s2.0938-4.6875 4.6875-4.6875h1.5625v9.375h-1.5625z"/></svg>`,
    'Grožio Paslaugos': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 40" x="0px" y="0px"><rect x="9.29" y="11" width="14.42" height="2" transform="translate(-2.64 19.07) rotate(-56.31)"/><rect x="9.89" y="9" width="7.21" height="2" transform="translate(-2.31 15.69) rotate(-56.31)"/><path d="m27,12c0-6.07-4.93-11-11-11S5,5.93,5,12c0,5.73,4.4,10.45,10,10.95v5.05h-5v2h12v-2h-5v-5.05c5.6-.5,10-5.22,10-10.95Zm-11,9c-4.96,0-9-4.04-9-9S11.04,3,16,3s9,4.04,9,9-4.04,9-9,9Z"/><rect x="9.29" y="11" width="14.42" height="2" transform="translate(-2.64 19.07) rotate(-56.31)"/><rect x="9.89" y="9" width="7.21" height="2" transform="translate(-2.31 15.69) rotate(-56.31)"/></svg>`,
};

// Snowflake animation helper
const getSnowflakeStyle = (index) => {
    const delay = -(index * 0.5) % 10; // NEGATIVE delay
    const duration = 8 + (index % 5);
    const startPos = (index * 3.33) % 100;
    const endPos = startPos + (Math.random() * 20 - 10);
    const size = 0.8 + (Math.random() * 0.6);

    return {
        left: `${startPos}%`,
        fontSize: `${size}rem`,
        animationDelay: `${delay}s`, // Negative delay makes them start mid-animation
        animationDuration: `${duration}s`,
        '--end-pos': `${endPos}%`
    };
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
    const newOffset = Math.max(0, currentOffset.value - step);
    currentOffset.value = newOffset;

    // Pause auto-scroll temporarily
    isUserScrolling.value = true;
    isPaused.value = true;
    if (scrollDebounceTimer.value) clearTimeout(scrollDebounceTimer.value);
    scrollDebounceTimer.value = setTimeout(() => {
        isUserScrolling.value = false;
        isPaused.value = false;
    }, 1000);
};

const manualScrollRight = () => {
    const step = containerWidth.value * 0.6;
    const newOffset = Math.min(maxOffset.value, currentOffset.value + step);
    currentOffset.value = newOffset;

    // Pause auto-scroll temporarily
    isUserScrolling.value = true;
    isPaused.value = true;
    if (scrollDebounceTimer.value) clearTimeout(scrollDebounceTimer.value);
    scrollDebounceTimer.value = setTimeout(() => {
        isUserScrolling.value = false;
        isPaused.value = false;
    }, 1000);
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

    if (!isPaused.value && !isUserScrolling.value) {
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

// Touch handlers
const touchStartX = ref(0);
const touchCurrentX = ref(0);

const handleTouchStart = (e) => {
    touchStartX.value = e.touches[0].clientX;
    touchCurrentX.value = currentOffset.value;
    isUserScrolling.value = true;
    isPaused.value = true;
};

const handleTouchMove = (e) => {
    if (!touchStartX.value) return;
    const diff = touchStartX.value - e.touches[0].clientX;
    const newOffset = Math.max(0, Math.min(maxOffset.value, touchCurrentX.value + diff));
    currentOffset.value = newOffset;
};

const handleTouchEnd = () => {
    touchStartX.value = 0;
    if (scrollDebounceTimer.value) clearTimeout(scrollDebounceTimer.value);
    scrollDebounceTimer.value = setTimeout(() => {
        isUserScrolling.value = false;
        isPaused.value = false;
    }, 1000);
};


// LIFECYCLE
onMounted(() => {
    if (props.categories.length > 0) {
        activeCategory.value = props.categories[0].slug;
    }

    nextTick(() => {
        calculateDimensions();

        // Initialize currentOffset with actual scroll position
        if (scrollerRef.value) {
            currentOffset.value = scrollerRef.value.scrollLeft;
        }

        setTimeout(calculateDimensions, 100);
        setTimeout(calculateDimensions, 500);
        setTimeout(() => {
            if (needsScroll.value) {
                // Ensure currentOffset is synced before starting animation
                if (scrollerRef.value) {
                    currentOffset.value = scrollerRef.value.scrollLeft;
                }
                startAnimation();
            }
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

/* Snowflake animation */
@keyframes snowfall {
    0% {
        transform: translateY(-10vh) translateX(0) rotate(0deg);
        opacity: 0;
    }
    5% {
        opacity: 1;
    }
    95% {
        opacity: 1;
    }
    100% {
        transform: translateY(110vh) translateX(var(--end-pos, 0)) rotate(360deg);
        opacity: 0;
    }
}

.snowflake {
    animation: snowfall linear infinite;
    will-change: transform, opacity;
}

/* Hide scrollbar but keep functionality */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>
