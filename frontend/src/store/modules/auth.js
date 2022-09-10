import axios from "axios";
// state
export const state = {
    user: null,
    token: localStorage.getItem("token"),
    permissions: [],
    isSuperAdmin: false,
};

export const getters = {
    user: (state) => state.user,
    token: (state) => state.token,
    check: (state) => state.user !== null,
};

// mutations
export const mutations = {
    SET_TOKEN: (state, { token, remember }) => {
        state.token = token;
        localStorage.setItem("token", token, {
            expires: remember ? 365 : null,
        });
    },

    FETCH_USER_SUCCESS: (state, { user }) => {
        state.user = user;
        state.isSuperAdmin = user.role === "SuperAdmin";
    },

    FETCH_USER_FAILURE: (state) => {
        state.token = null;
        localStorage.removeItem("token");
    },

    LOGOUT: (state) => {
        state.token = null;
        state.user = null;
        state.permissions = [];
        state.isAdmin = false;
        localStorage.removeItem("token");
    },
};

// actions
export const actions = {
    setToken({ commit }, payload) {
        commit("SET_TOKEN", payload);
    },

    async fetchUser({ commit }) {
        try {
            const { data } = await axios.get("api/profile");
            commit("FETCH_USER_SUCCESS", { user: data.data });
        } catch (e) {
            commit("FETCH_USER_FAILURE");
            return false;
        }
    },

    async logout({ commit }) {
        try {
            await axios.post("api/logout");
            commit("LOGOUT");
        } catch (e) {
            console.log(e);
        }

        commit("LOGOUT");
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
};
