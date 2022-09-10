import { createRouter, createWebHistory } from "vue-router";
import { constantRoutes, asyncRoutes, errorRoutes } from "./modules";
import store from "@/store";

// const globalMiddleware = ["check-auth"];
const globalMiddleware = ["check-auth"];

const middlewareList = import.meta.glob("../middleware/*.js", {
    eager: true,
});
const routeMiddleware = Object.keys(middlewareList)
    .map((value) => {
        let name = value.replace("../middleware/", "");
        name = name.replace(/(^.\/)|(\.js$)/g, "");
        return [name, middlewareList[value].default];
    })
    .reduce((modules, [name, module]) => {
        modules[name] = module;
        return modules;
    }, []);

/* New */

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

    // Get the middleware for all the matched components.
    const middleware = getMiddleware(to);

    // Call each middleware.
    callMiddleware(middleware, to, from, (...args) => {
        next(...args);
    });

    // next();
});

router.afterEach(() => {
    // Complete the animation of the route progress bar.
    NProgress.done();
});

export default router;

/**
 * Merge the the global middleware with the components middleware.
 *
 * @param  {Array} components
 * @return {Array}
 */
function getMiddleware(to) {
    const middleware = [...globalMiddleware];
    if (to.meta.middleware) {
        if (Array.isArray(to.meta.middleware)) {
            middleware.push(...to.meta.middleware);
        } else {
            middleware.push(to.meta.middleware);
        }
    } /* else {
        middleware.splice(0, 1);
    } */

    return middleware;
}

/**
 * Call each middleware.
 *
 * @param {Array} middleware
 * @param {Route} to
 * @param {Route} from
 * @param {Function} next
 */
function callMiddleware(middleware, to, from, next) {
    const stack = middleware.reverse();

    const _next = (...args) => {
        // Stop if "_next" was called with an argument or the stack is empty.
        if (args.length > 0 || stack.length === 0) {
            if (args.length > 0) {
                /* router.app.$loading.finish(); */
                NProgress.done();
            }

            return next(...args);
        }

        const { middleware, params } = parseMiddleware(stack.pop());

        if (typeof middleware === "function") {
            middleware(to, from, _next, params);
        } else if (routeMiddleware[middleware]) {
            routeMiddleware[middleware](to, from, _next, params);
        } else {
            throw Error(`Undefined middleware [${middleware}]`);
        }
    };

    _next();
}

/**
 * @param  {String|Function} middleware
 * @return {Object}
 */
function parseMiddleware(middleware) {
    if (typeof middleware === "function") {
        return { middleware };
    }

    const [name, params] = middleware.split(":");

    return { middleware: name, params };
}
