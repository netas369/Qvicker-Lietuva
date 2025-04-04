
// Initialize Lottie animation
document.addEventListener('DOMContentLoaded', function() {
    // Get the container element
    const footerAnimationContainer = document.getElementById('footer-lottie-container');

    // Check if container exists and lottie library is loaded
    if (footerAnimationContainer && typeof lottie !== 'undefined') {
        // Initialize the animation
        lottie.loadAnimation({
            container: footerAnimationContainer,
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/animations/lottie_footer.json'
        });
    }
});
