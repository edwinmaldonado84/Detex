import i18n from "@/plugins/i18n.js";
export default {
    install: (app) => {
        const { t } = i18n;
        app.config.globalProperties.$rules = {
            required: (v) => !!v || i18n.global.t("error.required"),
            /*  minMax: (v, max) =>
                (v && max ? parseInt(v) <= parseInt(max) : true) ||
                i18n("inputs.invalid_min"),
            maxMin: (v, min) =>
                (v && min ? parseInt(v) >= parseInt(min) : true) ||
                i18n("inputs.invalid_max"), */
        };
    },
};
