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

/* export default {
    install: (app) => {
        console.log("execute");
        // inject a globally available $translate() method
        app.config.globalProperties.$translate = (key) => {
            // retrieve a nested property in `options`
            // using `key` as the path
            return key.split(".").reduce((o, i) => {
                if (o) return o[i];
            }, options);
        };
    },
}; */
