import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                imk: {
                    50: '#F4FBF6',
                    100: '#DAF1DE',
                    200: '#8EB69B',
                    300: '#235347',
                    400: '#163832',
                    500: '#0B2B26',
                    600: '#051F20',
                    700: '#031314',
                }
            }
        },
    },

    plugins: [forms],
};
