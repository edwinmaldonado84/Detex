import { createRouter, createWebHistory } from "vue-router";
import { constantRoutes, asyncRoutes, errorRoutes } from "./modules";

const router = createRouter({
    history: createWebHistory(),
    routes: [...asyncRoutes, ...constantRoutes, ...errorRoutes],
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return { top: 0 };
    },
});

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start();
    }
    next();
});

router.afterEach(() => {
    // Complete the animation of the route progress bar.
    NProgress.done();
});

export default router;
