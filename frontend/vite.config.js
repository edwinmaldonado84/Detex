import path from "path";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { quasar, transformAssetUrls } from "@quasar/vite-plugin";
import vueI18n from "@intlify/vite-plugin-vue-i18n";
import Components from "unplugin-vue-components/vite";
import { VitePWA } from "vite-plugin-pwa";

// https://vitejs.dev/config/
export default defineConfig({
    build: {
        target: "esnext",
        manifest: true,
        outDir: "../public/frontend/",
        assetsInlineLimit: 0,
        rollupOptions: {
            input: "src/main.js",
            output: {
                assetFileNames: (assetInfo) => {
                    let extType = assetInfo.name.split(".").at(1);
                    if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
                        extType = "img";
                    }
                    if (extType === "css") {
                        return `assets/${extType}/[name][extname]`;
                    } else {
                        return `assets/${extType}/[name]-[hash][extname]`;
                    }
                },
                chunkFileNames: "assets/js/[name]-[hash].js",
                entryFileNames: "assets/js/[name].js",
            },
        },
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./src"),
        },
    },
    plugins: [
        vue({
            template: { transformAssetUrls },
        }),
        quasar({
            sassVariables: "src/sass/quasar-variables.sass",
        }),
        vueI18n({
            compositionOnly: true,
            include: path.resolve(__dirname, "./src/lang/**"),
        }),
        Components(),
        VitePWA({
            mode: "production",
            strategies: "generateSW", //generateSW autoUpdate injectManifest
            injectRegister: "script", //inline null script auto
            registerType: "prompt",
            includeAssets: [
                "favicon.ico",
                "apple-touch-icon.png",
                "masked-icon.svg",
            ],
            // srcDir: "src",
            filename: "sw-front.js",
            scope: "/",
            workbox: {
                globPatterns: ["**/*.{js,css,ico,png,svg,woff}"],
                // globIgnores: ['**/node_modules/**/*', '**/sw-front.js'],
                navigateFallback: null,
            },
            manifest: {
                name: "Detex",
                short_name: "Detex",
                start_url: "/",
                scope: "/",
                description: "",
                theme_color: "#FFF",
                icons: [
                    {
                        src: "/frontend/icons/pwa-192x192.png",
                        sizes: "192x192",
                        type: "image/png",
                    },
                    {
                        src: "/frontpage/icons/pwa-512x512.png",
                        sizes: "512x512",
                        type: "image/png",
                    },
                ],
                background_color: "#ffffff",
                display: "standalone",
            },
            devOptions: {
                enabled: process.env.SW_DEV === true,
                /* when using generateSW the PWA plugin will switch to classic */
                type: "module",
                navigateFallback: "index.html",
            },
        }),
    ],
});
