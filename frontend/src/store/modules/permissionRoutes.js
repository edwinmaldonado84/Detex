import store from "@/store";
import { asyncRoutes } from "@/router/modules";

export const state = {
    routes: [],
};

// mutations
export const mutations = {
    SET_ROUTES: (state, routes) => {
        state.routes = routes;
    },
};

// actions
export const actions = {
    setRoutes({ commit }) {
        let permissions = store.getters.permissions;
        let accessedRoutes;
        accessedRoutes = filterAsyncRoutes(asyncRoutes, permissions);
        commit("SET_ROUTES", accessedRoutes);
    },
};

/**
 * Filter asynchronous routing tables by recursion
 * @param routes asyncRoutes
 * @param permissions
 */
export function filterAsyncRoutes(routes, permissions) {
    const res = [];
    routes.forEach((route) => {
        const tmp = { ...route };
        if (hasPermission(permissions, tmp)) {
            if (tmp.children) {
                tmp.children = filterAsyncRoutes(tmp.children, permissions);
            }
            if (!tmp.hidden) {
                res.push(tmp);
            }
        }
    });

    return res;
}

/**
 * Use meta.role to determine if the current user has permission
 * @param permissions
 * @param route
 */
function hasPermission(permissions, route) {
    if (store.getters.user.role == "SuperAdmin") {
        return true;
    } else {
        if (route.meta && route.meta.permission) {
            return permissions.some((item) => item === route.meta.permission);
        } else {
            return true;
        }
    }
}
export default {
    namespaced: true,
    state,
    mutations,
    actions,
};
