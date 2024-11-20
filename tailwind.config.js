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
                    verylight: '#3ea8a6',
                    light: '#266867',  // lighter version of primary color
                    DEFAULT: '#1A4645', // main primary color
                    dark: '#133232',    // darker version of primary color (optional)
                    backgroundlight:'9BCCCB',
                    backgrounddark: '79A5A4'
                },
            }
        },
    },

    plugins: [forms],
};
