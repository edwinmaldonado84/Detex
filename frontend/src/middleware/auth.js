import store from "@/store";

export default async (to, from, next) => {
    if (!store.getters.checkAuth) {
        next({ name: "AuthPage" });
    } else {
        next();
    }
};
