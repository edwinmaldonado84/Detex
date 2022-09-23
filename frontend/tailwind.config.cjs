/** @type {import('tailwindcss').Config} */
module.exports = {
    prefix: "tw-",
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        // "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#1976d2",
                secondary: "#26A69A",
                third: "#bebebe",
                fourth: "#E5DCD4",
                five: "#413259",
                positive: "#00b029",
                negative: "#C10015",
                info: "#31CCEC",
                warning: "#F2C037",
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
    // plugins: [require("flowbite/plugin")],
};
