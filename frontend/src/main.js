import { createApp } from "vue";
import { createMetaManager } from "vue-meta";
import App from "./App.vue";
import { Quasar } from "quasar";
import quasarLang from "quasar/lang/es";
import quasarIconSet from "quasar/icon-set/svg-material-icons";
import router from "@/router";
import "@/plugins";
import "@/sass/base.sass";
import helpers from "@/helpers";
import store from "@/store";
import i18n from "@/plugins/i18n";

const app = createApp(App)
    .use(Quasar, {
        plugins: {}, // import Quasar plugins and add here
        lang: quasarLang,
        iconSet: quasarIconSet,
    })
    .use(router)
    .use(createMetaManager())
    .use(i18n)
    .use(store);
//   .use(VueAxios, axios)
//   .use(createMetaManager());

app.provide("$helpers", helpers);
app.mount("#app");
