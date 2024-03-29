const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        {
            pattern: /(bg|text)-(white|secondary|primary|info|accent|error|warning|success)/,
        },
        {
            pattern: /(h)-(6|9|14)/,
        },
    ],
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                primary: colors.slate['800'],
                secondary: colors.gray["500"],
                info: colors.indigo["600"],
                light: colors.slate["100"],
                demi: colors.blue["100"],
                accent: colors.indigo["900"],
                error: colors.red['600'],
                warning: colors.yellow['500'],
                success: colors.green['500'],
            },
        },
    },
    plugins: [],
}
