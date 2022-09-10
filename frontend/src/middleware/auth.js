import store from "@/store";

export default async (to, from, next) => {
    if (!store.getters.checkAuth) {
        next({ name: "Home" });
    } else {
        next();
    }
};
