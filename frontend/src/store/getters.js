const getters = {
    isLoading: (state) => state.loading.isLoading,
    locale: (state) => state.lang.locale,
    language: (state) => state.lang.lang,
    checkAuth: (state) => state.auth.user !== null,
    token: (state) => state.auth.token,
    user: (state) => state.auth.user,
};
export default getters;
