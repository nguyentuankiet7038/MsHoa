/** @type {import('tailwindcss').Config} */

const colors = {
    // Primary - Ms. Hoa Turquoise
    primary: "#00C2CB",
    "primary-container": "#00A5AF",
    "primary-fixed": "#E0F7F9",
    "primary-fixed-dim": "#B2EBF2",
    "inverse-primary": "#B2EBF2",

    // Secondary - Teal
    secondary: "#008B8B",
    "secondary-container": "#CCF2F4",
    "secondary-fixed": "#E0F7F9",
    "secondary-fixed-dim": "#B2EBF2",

    // Tertiary - Gold/Yellow accent remains for contrast
    tertiary: "#765b00",
    "tertiary-container": "#c9a74d",
    "tertiary-fixed": "#ffdf93",
    "tertiary-fixed-dim": "#e7c365",

    // Surface
    background: "#F8FDFF",
    surface: "#F8FDFF",
    "surface-dim": "#D8E3E6",
    "surface-bright": "#F8FDFF",
    "surface-container-lowest": "#ffffff",
    "surface-container-low": "#F0F9FA",
    "surface-container": "#E6F4F5",
    "surface-container-high": "#DBEDED",
    "surface-container-highest": "#D1E6E6",
    "surface-variant": "#D1E6E6",
    "surface-tint": "#00C2CB",
    "inverse-surface": "#2D3133",

    // Text / On Colors
    "on-primary": "#ffffff",
    "on-primary-container": "#003B3D",
    "on-primary-fixed": "#003B3D",
    "on-primary-fixed-variant": "#004F51",

    "on-secondary": "#ffffff",
    "on-secondary-container": "#003233",
    "on-secondary-fixed": "#001F20",
    "on-secondary-fixed-variant": "#003B3D",

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
    "brand-turquoise": "#00C2CB",
};

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],

    darkMode: "class",

    theme: {
        extend: {
            colors,

            borderRadius: {
                DEFAULT: "0.125rem",
                lg: "0.25rem",
                xl: "0.5rem",
                full: "9999px",
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

