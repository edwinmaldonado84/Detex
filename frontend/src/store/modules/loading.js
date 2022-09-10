// state
export const state = {
  isLoading: false,
};

// mutations
export const mutations = {
  SET_LOADING: (state, status) => {
    state.isLoading = status;
  },
};

// actions
export const actions = {
  start({ commit }) {
    commit("SET_LOADING", true);
  },
  done({ commit }) {
    commit("SET_LOADING", false);
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
