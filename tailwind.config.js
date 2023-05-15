import defaultTheme from 'tailwindcss/defaultTheme';
import colors from 'tailwindcss/colors';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './config/pcs.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"M PLUS Rounded 1c"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                indigo: colors.gray,
                '2d': {
                    DEFAULT: '#9ed8f6'
                },
                bg: {
                    DEFAULT: '#f7c8d5'
                },
                photo: {
                    DEFAULT: '#f9ddad'
                },
                bgm: {
                    DEFAULT: '#dbe8a7'
                },
                voice: {
                    DEFAULT: '#d4bad9'
                },
                '3d': {
                    DEFAULT: '#c1e3de'
                },
                live2d: {
                    DEFAULT: '#f3a593'
                }
            }
        },
    },

    plugins: [forms, typography],
};
