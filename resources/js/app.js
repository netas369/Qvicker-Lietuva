import './bootstrap';

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Lithuanian } from "flatpickr/dist/l10n/lt.js";

// Make flatpickr available globally
window.flatpickr = flatpickr;
window.flatpickrLithuanian = Lithuanian;

// Import Vue
import { createApp } from 'vue';
import { createPinia } from 'pinia';

// Import existing components
import TestimonialsCarousel from './components/TestimonialsCarousel.vue';
import CategoryTabs from './components/CategoryTabs.vue';

// Import new landing page components
import HeroSection from './components/HeroSection.vue';
import HowItWorks from './components/HowItWorks.vue';
import AboutSection from './components/AboutSection.vue';

// Create Pinia store
const pinia = createPinia();

// Function to mount Vue components
function mountVueComponents() {
    // Mount existing Testimonials Carousel
    const testimonialsElement = document.getElementById('testimonials-carousel');
    if (testimonialsElement) {
        const testimonialsApp = createApp(TestimonialsCarousel);
        testimonialsApp.use(pinia);
        testimonialsApp.mount(testimonialsElement);
    }

    // Mount existing Category Tabs
    const categoryTabsElement = document.getElementById('category-tabs');
    if (categoryTabsElement) {
        const categoryTabsApp = createApp(CategoryTabs, {
            categories: JSON.parse(categoryTabsElement.dataset.categories || '[]')
        });
        categoryTabsApp.use(pinia);
        categoryTabsApp.mount(categoryTabsElement);
    }

    // Mount new Hero Section
    const heroElement = document.getElementById('hero-section');
    if (heroElement) {
        const heroApp = createApp(HeroSection);
        heroApp.use(pinia);
        heroApp.mount(heroElement);
    }

    // Mount new How It Works Section
    const howItWorksElement = document.getElementById('how-it-works-section');
    if (howItWorksElement) {
        const howItWorksApp = createApp(HowItWorks);
        howItWorksApp.use(pinia);
        howItWorksApp.mount(howItWorksElement);
    }

    // Mount new About Section
    const aboutElement = document.getElementById('about-section');
    if (aboutElement) {
        const aboutApp = createApp(AboutSection);
        aboutApp.use(pinia);
        aboutApp.mount(aboutElement);
    }
}

// Mount components when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mountVueComponents);
} else {
    mountVueComponents();
}
