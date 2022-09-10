import { createI18n } from "vue-i18n";
import messages from "@intlify/vite-plugin-vue-i18n/messages";
import helpers from "@/helpers";

const i18n = createI18n({
    locale: helpers.getLanguageBrowser(),
    fallbackLocale: "es",
    legacy: true,
    globalInjection: true,
    messages,
});

export default i18n;
