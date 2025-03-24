import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/layouts/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', 'Rubik', ...defaultTheme.fontFamily.sans],
                franklin: ['"Franklin Gothic Heavy"', 'sans-serif'], // Add your font here
                arial: ['Arial', 'Helvetica', 'sans-serif'], // Add Arial with fallbacks
            },
            colors: {
                primary: {
                    verylight: '#0A97B0',    // Very light blue, good for backgrounds
                    light: '#266867',        // Light blue, good for secondary elements
                    DEFAULT: '#1A4645',      // Main primary - trustworthy blue
                    dark: '#133232',         // Darker blue for hover states
                    backgroundlight: '#9BCCCB', // Light teal for backgrounds
                    backgrounddark: '#79A5A4'
                },
            }
        },
    },

    plugins: [forms],
};
