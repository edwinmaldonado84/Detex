import messages from "@intlify/vite-plugin-vue-i18n/messages";
import defaultSettings from "@/services/settings";
import store from "@/store";

const helpers = {
    getLanguageBrowser: function () {
        const info = window.navigator.userLanguage || window.navigator.language;
        const lang = info.split("-");

        const found = messages[lang[0]] ? lang[0] : defaultSettings.lang;

        let newLang = localStorage.getItem("lang")
            ? localStorage.getItem("lang")
            : found;
        store.dispatch("lang/setLanguage", newLang);
        return newLang;
    },
};

export default helpers;
