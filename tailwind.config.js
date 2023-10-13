import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import { DefaultColors } from 'tailwindcss/types/generated/colors';

const colors = require('tailwindcss/colors');

const custom_gray = {
    100: '#f2f2f2',
    200: '#d9d9d9',
    300: '#bfbfbf',
    400: '#a6a6a6',
    500: '#8c8c8c',
    600: '#737373',
    700: '#595959',
    800: '#404040',
    900: '#262626',
};

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: { ...colors.red, DEFAULT: colors.red[600]
                },
                secondary: {
                    100: '#f7eef6',
                    200: '#e6cce4',
                    300: '#d5a9d2',
                    400: '#c487c0',
                    500: '#b365ae',
                    600: '#9a4c94',
                    700: '#783b73',
                    800: '#562a52',
                    900: '#331931',
                },
                title: {
                    light: custom_gray['700'],
                    dark: custom_gray['200'],
                },
                paragraph: {
                    light: custom_gray['800'],
                    dark: custom_gray['200'],
                    100: '#f2f2f2',
                    200: '#d9d9d9',
                    300: '#bfbfbf',
                    400: '#a6a6a6',
                    500: '#8c8c8c',
                    600: '#737373',
                    700: '#595959',
                    800: '#404040',
                    900: '#262626',
                },
                cbg: {
                    ...colors.zinc, DEFAULT: colors.zinc[500]
                },
                container: {
                    light: custom_gray['200'],
                    dark: custom_gray['800'],
                },
                confirm: {
                    100: '#e5ffe5',
                    200: '#b3ffb3',
                    300: '#80ff80',
                    400: '#4dff4d',
                    500: '#1aff1a',
                    600: '#00e600',
                    700: '#00b300',
                    800: '#008000',
                    900: '#004d00',
                },
                deny_or_cancel: {

                },
                edit: {

                },
                delete: {
                    light: '#f73e3e',
                    dark: '#cc2f2f'
                },
                bdr: {
                    light: custom_gray['400'],
                    dark: custom_gray['600'],
                }
            },            
            boxShadow: {
                hover: "0 0 5px theme('colors.red.200'), 0 0 20px theme('colors.red.700')"
            },
            outlineOffset: {
                hover: 2,
                add: 2,
                DEFAULT: 2,
            },
            outlineWidth: {
                hover: 2,
                add: 2,
                DEFAULT: 0,
            },
            outlineColor: {
                add: colors.green[200],
                DEFAULT: colors.red[600]
            }
        },
    },

    plugins: [
        forms,
        require('tailwind-scrollbar-hide'),
    ],
};
