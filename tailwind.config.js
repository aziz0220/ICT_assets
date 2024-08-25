import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            colors:{
                "black": "#030505ff",
                "vanilla": "#FBF8B3ff",
                "icterine": "#F1ED40ff",
                "yellow": "#F5F70Bff",
                "yellow1": "#F2E205",
                "yellow-green": "#B9D13Fff",
                "ash-gray": "#B4C4C4ff",
                "dark-cyan": "#649698ff",
                "french-blue": "#0573BAff",
                "denim": "#0160C7ff",
                "honolulu-blue": "#2979AFff",
                "blue1": "#0A8CBF",
                "blue2": "#0A7ABF",
                "blue3": "#0460D9",
                "blue4": "#0554F2",

            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                border: 'background ease infinite',
            },
            keyframes: {
                background: {
                    '0%, 100%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                },
            },

        },
    },

    plugins: [forms,
        require('flowbite/plugin')
    ],
};
