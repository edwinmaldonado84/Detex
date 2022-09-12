export const state = {
    /* theme: variables.theme, */
    tagsView:
        localStorage.getItem("tagsView") === null
            ? true
            : JSON.parse(localStorage.getItem("tagsView")),
    darkTheme:
        localStorage.getItem("darkTheme") === null
            ? false
            : JSON.parse(localStorage.getItem("darkTheme")),
    drawer:
        localStorage.getItem("drawer") === null
            ? false
            : JSON.parse(localStorage.getItem("drawer")),
    mini:
        localStorage.getItem("mini") === null
            ? false
            : JSON.parse(localStorage.getItem("mini")),
    btn_interest_color: "fourth",
    main_menu_modify: false,
};

export const mutations = {
    CHANGE_SETTING: (state, { key, value }) => {
        // eslint-disable-next-line no-prototype-builtins
        if (state.hasOwnProperty(key)) {
            state[key] = value;
            localStorage.setItem(key, value);
        }
    },
    SET_BTN_INTEREST_COLOR: (state, color) => {
        state.btn_interest_color = color;
    },
    SET_MAIN_MENU_MODIFY: (state, status) => {
        state.main_menu_modify = status;
    },
};

export const actions = {
    changeSetting({ commit }, data) {
        commit("CHANGE_SETTING", data);
    },
    change_btn_interestcolor({ commit }, data) {
        commit("SET_BTN_INTEREST_COLOR", data);
    },
    change_main_menu_modify({ commit }, data) {
        commit("SET_MAIN_MENU_MODIFY", data);
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
};
