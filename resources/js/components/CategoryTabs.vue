<template>
    <section class="relative py-12">
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
                <!-- Scroll arrows -->
                <button
                    v-show="showLeftArrow"
                    @click="scrollLeft"
                    class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 z-20 items-center justify-center w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:bg-gray-50 hover:shadow-xl transition-all duration-300 hover:scale-110"
                    aria-label="Scroll left"
                >
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <button
                    v-show="showRightArrow"
                    @click="scrollRight"
                    class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 z-20 items-center justify-center w-12 h-12 bg-white rounded-full shadow-lg border border-gray-200 hover:bg-gray-50 hover:shadow-xl transition-all duration-300 hover:scale-110"
                    aria-label="Scroll right"
                >
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Category scroller -->
                <div
                    ref="categoryScroller"
                    @scroll="updateArrowVisibility"
                    class="flex snap-x snap-mandatory overflow-x-auto overflow-y-hidden scrollbar-hide scroll-smooth lg:px-12"
                    style="scrollbar-width: none; -ms-overflow-style: none;"
                >
                    <div class="flex gap-3 pb-2 min-w-full justify-start lg:justify-center">
                        <button
                            v-for="category in categories"
                            :key="category.slug"
                            @click="selectCategory(category.slug)"
                            :class="[
                                'group relative flex flex-col items-center justify-center min-w-[120px] p-4 rounded-2xl transition-all duration-300 snap-center',
                                activeCategory === category.slug
                                    ? 'bg-primary-light text-white shadow-lg scale-105'
                                    : 'bg-white text-gray-700 hover:bg-gray-50 hover:shadow-md border border-gray-200 hover:border-primary-light/30'
                            ]"
                            role="tab"
                            :aria-controls="`panel-${category.slug}`"
                            :aria-selected="activeCategory === category.slug"
                        >
                            <!-- Icon container -->
                            <div
                                :class="[
                                    'w-14 h-14 mb-3 rounded-xl flex items-center justify-center transition-all duration-300',
                                    activeCategory === category.slug
                                        ? 'bg-white/20'
                                        : 'bg-primary-light/10 group-hover:bg-primary-light/20'
                                ]"
                            >
                                <!-- Dynamic SVG icon -->
                                <svg
                                    :class="[
                                        'w-8 h-8 transition-transform duration-300 group-hover:scale-110',
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

                            <!-- Category name -->
                            <span
                                :class="[
                                    'text-sm font-semibold text-center leading-tight transition-colors duration-300',
                                    activeCategory === category.slug ? 'text-white' : 'text-gray-800 group-hover:text-primary-light'
                                ]"
                            >
                                {{ getCategoryDisplayName(category.name) }}
                            </span>

                            <!-- Active indicator -->
                            <div
                                v-if="activeCategory === category.slug"
                                class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-white rounded-full shadow-md"
                            />
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category content panels -->
            <div class="relative">
                <div
                    v-for="category in categories"
                    :key="category.slug"
                    :id="`panel-${category.slug}`"
                    role="tabpanel"
                >
                    <Transition
                        name="fade"
                        mode="out-in"
                    >
                        <div
                            v-if="activeCategory === category.slug"
                            class="bg-white rounded-3xl shadow-xl p-6 md:p-10"
                        >
                            <!-- Category header -->
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                                        {{ category.name }}
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ category.subcategories.length }} paslaug{{ category.subcategories.length === 1 ? 'a' : 'os' }}
                                    </p>
                                </div>

                                <!-- Quick stats badge -->
                                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-green-50 rounded-full border border-green-200">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse" />
                                    <span class="text-sm font-medium text-green-700">Aktyvūs specialistai</span>
                                </div>
                            </div>

                            <!-- Subcategories grid -->
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                <a
                                    v-for="subcategory in getVisibleSubcategories(category)"
                                    :key="subcategory.url"
                                    :href="`/search?subcategory=${subcategory.url}`"
                                    class="group relative flex items-center gap-4 p-5 rounded-xl border-2 border-gray-100 bg-white hover:bg-gradient-to-br hover:from-primary-light/5 hover:to-blue-50 hover:border-primary-light/30 shadow-sm hover:shadow-lg transition-all duration-300"
                                >
                                    <!-- Subcategory icon -->
                                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary-light/10 to-blue-100/50 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                        <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>

                                    <!-- Subcategory info -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-900 group-hover:text-primary-light transition-colors duration-300 line-clamp-2">
                                            {{ subcategory.name }}
                                        </h4>
                                    </div>

                                    <!-- Arrow icon -->
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-primary-light group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>

                                    <!-- Hover effect overlay -->
                                    <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-primary-light/0 via-primary-light/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" />
                                </a>

                                <!-- Show More button -->
                                <button
                                    v-if="category.subcategories.length > 8 && !expandedCategories[category.slug]"
                                    @click="expandCategory(category.slug)"
                                    class="group relative flex items-center justify-center gap-3 p-5 rounded-xl border-2 border-dashed border-gray-300 bg-gray-50/50 hover:bg-primary-light/5 hover:border-primary-light transition-all duration-300"
                                >
                                    <div class="text-center">
                                        <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                            <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-primary-light transition-colors">
                                        +{{ category.subcategories.length - 8 }} daugiau
                                    </span>
                                    </div>
                                </button>
                            </div>

                            <!-- Popular services badge -->
                            <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-primary-light/5 rounded-2xl border border-blue-100">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-primary-light rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Populiariausia kategorija šį mėnesį</p>
                                        <p class="text-xs text-gray-600">Vidutinis įvertinimas: 4.9/5 ⭐</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>

            <!-- View all categories CTA -->
            <div class="text-center mt-12">
                <a
                    href="/allservices"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary-light to-blue-600 text-white font-semibold rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300"
                >
                    <span>Peržiūrėti visas kategorijas</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, nextTick, watch } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
        default: () => []
    }
});

const categoryScroller = ref(null);
const activeCategory = ref('');
const showLeftArrow = ref(false);
const showRightArrow = ref(false);
const expandedCategories = ref({});

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

const getCategoryDisplayName = (name) => {
    return categoryDisplayNames[name] || name;
};

const getCategoryIcon = (name) => {
    return categoryIcons[name] || 'M12 6v6m0 0v6m0-6h6m-6 0H6';
};

const selectCategory = (slug) => {
    activeCategory.value = slug;
};

const getVisibleSubcategories = (category) => {
    if (expandedCategories.value[category.slug]) {
        return category.subcategories;
    }
    return category.subcategories.slice(0, 8);
};

const expandCategory = (categorySlug) => {
    expandedCategories.value[categorySlug] = true;
};

const scrollLeft = () => {
    if (categoryScroller.value) {
        categoryScroller.value.scrollBy({ left: -250, behavior: 'smooth' });
    }
};

const scrollRight = () => {
    if (categoryScroller.value) {
        categoryScroller.value.scrollBy({ left: 250, behavior: 'smooth' });
    }
};

const updateArrowVisibility = () => {
    if (!categoryScroller.value) return;

    const scroller = categoryScroller.value;
    const isScrollable = scroller.scrollWidth > scroller.clientWidth;

    if (!isScrollable) {
        showLeftArrow.value = false;
        showRightArrow.value = false;
        return;
    }

    const isAtStart = scroller.scrollLeft <= 10;
    const isAtEnd = scroller.scrollLeft >= scroller.scrollWidth - scroller.clientWidth - 10;

    showLeftArrow.value = !isAtStart;
    showRightArrow.value = !isAtEnd;
};

onMounted(() => {
    if (props.categories.length > 0) {
        activeCategory.value = props.categories[0].slug;
    }

    nextTick(() => {
        updateArrowVisibility();
        setTimeout(updateArrowVisibility, 100);
        window.addEventListener('resize', updateArrowVisibility);
    });
});

watch(activeCategory, () => {
    nextTick(updateArrowVisibility);
});
</script>

<style scoped>
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
