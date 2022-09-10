import store from "@/store";

/**
 * If have a token but, its reload the page, we need to set the user info again.
 */
export default async (to, from, next) => {
    if (!store.getters.checkAuth && store.getters.token) {
        try {
            await store.dispatch("auth/fetchUser");
        } catch (e) {
            console.log(e);
        }
        if (to.name === "Home") {
            next({ name: "DashboardPage" });
        } else {
            next();
        }
    } else {
        next();
    }
};
