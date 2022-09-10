import { createApp } from "vue";
import { createMetaManager } from "vue-meta";
import App from "./App.vue";
import { Quasar, Notify, Loading } from "quasar";
import quasarLang from "quasar/lang/es";
import quasarIconSet from "quasar/icon-set/svg-material-icons";
import router from "@/router";
import helpers from "@/helpers";
import store from "@/store";
import i18n from "@/plugins/i18n";
import inputRules from "@/validations/inputsRules";

import "@/plugins";
import "@/scss/main.scss";

const app = createApp(App)
    .use(Quasar, {
        plugins: {
            Notify,
            Loading,
        }, // import Quasar plugins and add here
        lang: quasarLang,
        iconSet: quasarIconSet,
        config: {
            notify: {
                /* look at QuasarConfOptions from the API card */
            },
            loading: {},
        },
    })
    .use(router)
    .use(createMetaManager())
    .use(i18n)
    .use(inputRules)
    .use(store);
//   .use(VueAxios, axios)
//   .use(createMetaManager());

app.provide("$helpers", helpers);
app.mount("#app");
