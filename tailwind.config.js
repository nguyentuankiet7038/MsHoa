/** @type {import('tailwindcss').Config} */

const colors = {
    // Primary
    primary: "#4f378a",
    "primary-container": "#6750a4",
    "primary-fixed": "#e9ddff",
    "primary-fixed-dim": "#cfbcff",
    "inverse-primary": "#cfbcff",

    // Secondary
    secondary: "#63597c",
    "secondary-container": "#e1d4fd",
    "secondary-fixed": "#e9ddff",
    "secondary-fixed-dim": "#cdc0e9",

    // Tertiary
    tertiary: "#765b00",
    "tertiary-container": "#c9a74d",
    "tertiary-fixed": "#ffdf93",
    "tertiary-fixed-dim": "#e7c365",

    // Surface
    background: "#fdf7ff",
    surface: "#fdf7ff",
    "surface-dim": "#ded8e0",
    "surface-bright": "#fdf7ff",
    "surface-container-lowest": "#ffffff",
    "surface-container-low": "#f8f2fa",
    "surface-container": "#f2ecf4",
    "surface-container-high": "#ece6ee",
    "surface-container-highest": "#e6e0e9",
    "surface-variant": "#e6e0e9",
    "surface-tint": "#6750a4",
    "inverse-surface": "#322f35",

    // Text / On Colors
    "on-primary": "#ffffff",
    "on-primary-container": "#e0d2ff",
    "on-primary-fixed": "#22005d",
    "on-primary-fixed-variant": "#4f378a",

    "on-secondary": "#ffffff",
    "on-secondary-container": "#645a7d",
    "on-secondary-fixed": "#1f1635",
    "on-secondary-fixed-variant": "#4b4263",

    "on-tertiary": "#ffffff",
    "on-tertiary-container": "#503d00",
    "on-tertiary-fixed": "#241a00",
    "on-tertiary-fixed-variant": "#594400",

    "on-background": "#1d1b20",
    "on-surface": "#1d1b20",
    "on-surface-variant": "#494551",
    "inverse-on-surface": "#f5eff7",

    // Error
    error: "#ba1a1a",
    "error-container": "#ffdad6",
    "on-error": "#ffffff",
    "on-error-container": "#93000a",

    // Outline
    outline: "#7a7582",
    "outline-variant": "#cbc4d2",

    // Custom Brand
    "brand-turquoise": "#00CED1",
};

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],

    darkMode: "class",

    theme: {
        extend: {
            colors,

            borderRadius: {
                DEFAULT: "0.125rem",
                lg: "0.25rem",
                xl: "0.5rem",
                full: "0.75rem",
            },

            fontFamily: {
                headline: ["Public Sans", "sans-serif"],
                display: ["Public Sans", "sans-serif"],
                body: ["Public Sans", "sans-serif"],
                label: ["Public Sans", "sans-serif"],
            },
        },
    },

    plugins: [],
};