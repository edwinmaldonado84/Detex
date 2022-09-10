import axios from "axios";
import store from "@/store";
import i18n from "@/plugins/i18n.js";

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
        NProgress.start();
        Swal.fire({
            icon: "error",
            title: "Oops!",
            text: i18n.global.t("errors.something_is_wrong"),
            reverseButtons: true,
            confirmButtonText: "ok",
        });
        NProgress.done();
        return Promise.reject(error);
    }
);
export default axios;
