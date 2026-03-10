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
                sans: ['Inter', 'Roboto', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                chalimbana: {
                    blue: '#003A8F',
                    gold: '#F2A900',
                    light: '#F5F7FA',
                    text: '#333333',
                    border: '#E0E0E0',
                }
            }
        },
    },

    plugins: [forms],
};
