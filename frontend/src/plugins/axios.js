import axios from "axios";
import store from "@/store";
import i18n from "@/plugins/i18n.js";
import { Dialog, Notify } from "quasar";

window.axios = axios;

if (process.env.NODE_ENV == "development") {
    //   axios.defaults.baseURL = "https://velkashopping.com";
    axios.defaults.baseURL = "https://detext.test";
    //   axios.defaults.headers.common["Accept-Language"] = lang;
}

// Request interceptor
axios.interceptors.request.use((request) => {
    const token = store.getters.token;
    if (token) {
        request.headers.common.Authorization = `Bearer ${token}`;
    }

    return request;
});

// Response interceptor
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        const { status } = error.response;

        if (status >= 500) {
            Notify.create({
                color: "negative",
                message: i18n.t("errors.error_alert_text"),
                position: "center",
                multiLine: true,
                actions: [
                    {
                        label: "Ok",
                        color: "white",
                        handler: () => {
                            /* console.log('wooow') */
                        },
                    },
                ],
                timeout: 3000,
            });
        }

        /**
         * @status 401 => LOGIN BAD CREDENTIALS
         * @status 403 => PERMITIONS
         * @status 404 => SOME DATE NOT EXIST
         * @status 405 => VALIDATION ERROR
         * @status 422 => ERROR REQUEST
         * @status 429 => TOO ATTEMPS LOGIN
         *
         */
        var DefaultStatus = [400, 429, 404];

        if (DefaultStatus.includes(status)) {
            if (error.response.data.message) {
                Notify.create({
                    color: "negative",
                    message: error.response.data.message,
                    position: "center",
                    multiLine: true,
                    actions: [
                        {
                            label: "Ok",
                            color: "white",
                            handler: () => {
                                /* console.log('wooow') */
                            },
                        },
                    ],
                    timeout: 3000,
                });
            } else {
                Notify.create({
                    color: "negative",
                    message: i18n.t("errors.error_alert_text"),
                    position: "center",
                    multiLine: true,
                    actions: [
                        {
                            label: "Ok",
                            color: "white",
                            handler: () => {
                                /* console.log('wooow') */
                            },
                        },
                    ],
                    timeout: 3000,
                });
            }
        }

        if (status === 401) {
            Notify.create({
                color: "negative",
                icon: "warning",
                message: error.response.data.message,
                position: "center",
                multiLine: true,
                actions: [
                    {
                        label: "Ok",
                        color: "white",
                        handler: () => {
                            /* console.log('wooow') */
                        },
                    },
                ],
                timeout: 3000,
            });
        }

        if (status === 403) {
            router.push({ name: "Dashboard" });
            Notify.create({
                color: "negative",
                icon: "warning",
                message: error.response.data.errors.message,
                position: "center",
                multiLine: true,
                actions: [
                    {
                        label: "Ok",
                        color: "white",
                        handler: () => {
                            /* console.log('wooow') */
                        },
                    },
                ],
                timeout: 3000,
            });
        }
        if (status === 405) {
            Notify.create({
                color: "negative",
                icon: "warning",
                message: error.response.data.message,
                position: "center",
                multiLine: true,
                actions: [
                    {
                        label: "Ok",
                        color: "white",
                        handler: () => {
                            /* console.log('wooow') */
                        },
                    },
                ],
                timeout: 3000,
            });
        }
        //Sugetions
        if (status === 406) {
            str = "";
            for (p in error.response.data.suggestion) {
                if (
                    Object.prototype.hasOwnProperty.call(
                        error.response.data.suggestion,
                        p
                    )
                ) {
                    str += error.response.data.suggestion[p] + "<br>";
                }
            }

            Notify.create({
                color: "negative",
                icon: "warning",
                message: error.response.data.message + ":<br>" + str,
                position: "center",
                multiLine: true,
                html: true,
                actions: [
                    {
                        label: "Ok",
                        color: "white",
                        handler: () => {
                            /* console.log('wooow') */
                        },
                    },
                ],
                timeout: 3000,
            });
        }
        //SESIONID EXPIRED
        if (status === 410) {
            Notify.create({
                color: "negative",
                icon: "warning",
                message: "SESIONID EXPIRED",
                position: "center",
                multiLine: true,
                actions: [
                    {
                        label: "Ok",
                        color: "white",
                        handler: () => {
                            /* console.log('wooow') */
                        },
                    },
                ],
                timeout: 3000,
            });
        }

        if (status === 422) {
            //TODO: check errors from
            str = "";
            for (p in error.response.data.errors.message) {
                if (
                    Object.prototype.hasOwnProperty.call(
                        error.response.data.errors.message,
                        p
                    )
                ) {
                    str += error.response.data.errors.message[p] + "<br>";
                }
            }
            Notify.create({
                color: "negative",
                icon: "warning",
                message: str,
                position: "center",
                multiLine: true,
                actions: [
                    {
                        label: "Ok",
                        color: "white",
                        handler: () => {
                            /* console.log('wooow') */
                        },
                    },
                ],
                timeout: 3000,
            });
        }

        return Promise.reject(error);
    }
);
export default axios;
