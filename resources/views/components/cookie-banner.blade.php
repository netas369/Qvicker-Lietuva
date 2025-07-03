{{-- resources/views/components/cookie-banner.blade.php --}}
<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50 transform transition-transform duration-300 ease-in-out" style="display: none;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex-1">
                <p class="text-sm text-gray-700">
                    <strong>Slapukai ir privatumas</strong><br>
                    Naudojame būtinus slapukus svetainės veikimui. Papildomi slapukai padės mums gerinti paslaugas ir suprasti, kaip naudojate svetainę.
                    <a href="{{ route('cookies.policy') }}" class="text-primary hover:text-primary-dark underline">Sužinokite daugiau</a>
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-2">
                <button
                    id="accept-necessary-cookies"
                    class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors duration-200"
                >
                    Tik būtini
                </button>
                <button
                    id="accept-all-cookies"
                    class="px-4 py-2 text-sm bg-primary hover:bg-primary-dark text-white rounded-md transition-colors duration-200"
                >
                    Priimti visus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const banner = document.getElementById('cookie-banner');
        const acceptNecessary = document.getElementById('accept-necessary-cookies');
        const acceptAll = document.getElementById('accept-all-cookies');

        // Check if user has already made a choice
        const cookieConsent = getCookie('cookie_consent');

        if (!cookieConsent) {
            // Show banner if no consent given yet
            banner.style.display = 'block';
        }

        // Handle "Accept Necessary Only"
        acceptNecessary.addEventListener('click', function() {
            setCookie('cookie_consent', 'necessary', 365);
            hideBanner();
            // Don't load analytics or other non-essential cookies
        });

        // Handle "Accept All"
        acceptAll.addEventListener('click', function() {
            setCookie('cookie_consent', 'all', 365);
            hideBanner();

            // Load analytics if accepted all
            if (typeof loadAnalytics === 'function') {
                loadAnalytics();
            }
        });

        function hideBanner() {
            banner.style.transform = 'translateY(100%)';
            setTimeout(() => {
                banner.style.display = 'none';
            }, 300);
        }

        function setCookie(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/;SameSite=Lax';
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
    });

    // Optional: Function to load Google Analytics only after consent
    function loadAnalytics() {
        // Only add this when you implement Google Analytics
        /*
        // Google Analytics 4
        const script = document.createElement('script');
        script.async = true;
        script.src = 'https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID';
        document.head.appendChild(script);

        script.onload = function() {
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'GA_MEASUREMENT_ID');
        };
        */
    }
</script>

