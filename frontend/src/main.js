import { createApp } from "vue";
import { createMetaManager } from "vue-meta";
import App from "./App.vue";
import { Quasar, Notify } from "quasar";
import quasarLang from "quasar/lang/es";
import quasarIconSet from "quasar/icon-set/svg-material-icons";
import router from "@/router";
import helpers from "@/helpers";
import store from "@/store";
import i18n from "@/plugins/i18n";

import "@/plugins";
import "@/scss/main.scss";

const app = createApp(App)
    .use(Quasar, {
        plugins: {
            Notify,
        }, // import Quasar plugins and add here
        lang: quasarLang,
        iconSet: quasarIconSet,
        config: {
            notify: {
                /* look at QuasarConfOptions from the API card */
            },
        },
    })
    .use(router)
    .use(createMetaManager())
    .use(i18n)
    // .use(workerService)
    .use(store);
//   .use(VueAxios, axios)
//   .use(createMetaManager());

app.provide("$helpers", helpers);
// app.provide("$workerService", workerService);
app.mount("#app");
