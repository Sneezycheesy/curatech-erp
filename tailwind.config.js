import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import { DefaultColors } from 'tailwindcss/types/generated/colors';

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

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    100: '#ffe5e5',
                    200: '#ffb3b3',
                    300: '#ff8080',
                    400: '#ff4d4d',
                    500: '#ff1a1a',
                    600: '#e60000',
                    700: '#b30000',
                    800: '#800000',
                    900: '#4d0000',
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
                    light: custom_gray['600'],
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
                container: {
                    light: custom_gray['200'],
                    dark: custom_gray['800'],
                },
                confirm: {

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
            }
        },
    },

    plugins: [forms],
};
