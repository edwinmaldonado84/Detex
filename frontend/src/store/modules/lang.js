import helpers from "@/helpers";

// state
export const state = {
  lang: localStorage.getItem("lang"),
  locale:
    localStorage.getItem("locale") === null
      ? window.navigator.userLanguage
      : localStorage.getItem("locale"),
};

// getters
export const getters = {
  lang: (state) => state.lang,
  locale: (state) => state.locale,
};

// mutations
export const mutations = {
  SET_LANGUAGE: (state, payload) => {
    state.lang = payload;
    localStorage.setItem("lang", payload, { expires: 365 });
  },
  SET_LOCALE: (state, payload) => {
    state.locale = payload;
    localStorage.setItem("locale", payload, { expires: 365 });
  },
};

// actions
export const actions = {
  setLanguage({ commit }, payload) {
    commit("SET_LANGUAGE", payload);
  },
  setLocale({ commit }, payload) {
    commit("SET_LOCALE", payload);
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
