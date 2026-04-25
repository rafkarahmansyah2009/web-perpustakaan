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
            colors: {
                primary: {
                    DEFAULT: '#1a4d2e',
                    dark: '#00361a',
                    light: '#366847',
                    50: '#f0faf4',
                    100: '#d8f0d8',
                    200: '#b8f0c5',
                    300: '#9dd3aa',
                    400: '#6db880',
                    500: '#1a4d2e',
                    600: '#155a28',
                    700: '#0f4420',
                    800: '#0a3018',
                    900: '#00210e',
                },
                cream: {
                    DEFAULT: '#faf8f3',
                    50: '#ffffff',
                    100: '#fbf9f4',
                    200: '#f5f3ee',
                    300: '#f0eee9',
                    400: '#eae8e3',
                    500: '#e4e2dd',
                    600: '#dbdad5',
                    700: '#c1c9bf',
                },
                gold: {
                    DEFAULT: '#d4a017',
                    light: '#ffc641',
                    dark: '#795900',
                    50: '#fef9e7',
                    100: '#fdf0c4',
                    200: '#fce49d',
                    300: '#f6be39',
                    400: '#d4a017',
                    500: '#795900',
                },
                brick: {
                    DEFAULT: '#c8401a',
                    light: '#ff9477',
                    dark: '#5b1200',
                    50: '#fef2ee',
                    100: '#ffdbd1',
                    200: '#ffb4a1',
                    300: '#ff9477',
                    400: '#c8401a',
                    500: '#831d00',
                    600: '#5b1200',
                },
                surface: {
                    DEFAULT: '#fbf9f4',
                    dim: '#dbdad5',
                    bright: '#fbf9f4',
                    container: '#f0eee9',
                    'container-high': '#eae8e3',
                    'container-highest': '#e4e2dd',
                    'container-low': '#f5f3ee',
                    'container-lowest': '#ffffff',
                },
                dark: {
                    DEFAULT: '#1b1c19',
                    light: '#30312e',
                    muted: '#414942',
                },
            },
            fontFamily: {
                headline: ['Newsreader', ...defaultTheme.fontFamily.serif],
                body: ['Manrope', ...defaultTheme.fontFamily.sans],
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                'card': '0.75rem',
                'btn': '0.5rem',
            },
            boxShadow: {
                'card': '0 12px 48px rgba(26, 77, 46, 0.08)',
                'card-hover': '0 20px 60px rgba(26, 77, 46, 0.12)',
                'nav': '0 2px 20px rgba(26, 77, 46, 0.06)',
                'btn': 'inset 0 1px 2px rgba(0, 0, 0, 0.1)',
            },
        },
    },

    plugins: [forms],
};
