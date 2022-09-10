import path from "path";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { quasar, transformAssetUrls } from "@quasar/vite-plugin";
import vueI18n from "@intlify/vite-plugin-vue-i18n";
import Components from "unplugin-vue-components/vite";

// https://vitejs.dev/config/
export default defineConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./src"),
            // "@": fileURLToPath(new URL("./src", import.meta.url)),
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
    ],
});
