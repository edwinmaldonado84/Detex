/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#701AFF",
                secondary: "#130037",
                third: "#A56FFF",
                fourth: "#E5DCD4",
                five: "#413259",
                layout: {
                    100: "#FAF4EE",
                    200: "#F5EBE2",
                    300: "#F5F5F5",
                    400: "#1C0640",
                },
            },
        },
        /*     fontFamily: {
            light: ["light"],
            semibold: ["semibold"],
            bold: ["bold"],
            regular: ["regular"],
            medium: ["medium"],
        }, */
    },
    plugins: [require("flowbite/plugin")],
};
