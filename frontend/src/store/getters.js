const getters = {
    isLoading: (state) => state.loading.isLoading,
    locale: (state) => state.lang.locale,
    language: (state) => state.lang.lang,
    checkAuth: (state) => state.auth.user !== null,
    token: (state) => state.auth.token,
    user: (state) => state.auth.user,

    permission_routes: (state) => state.permissionRoutes.routes,
    permissions: (state) => state.auth.permissions,

    cachedViews: (state) => state.tagsView.cachedViews,
    // tagsViewShow: (state) => state.settings.tagsView,
    visitedViews: (state) => state.tagsView.visitedViews,

    /* btnInterestColor: (state) => state.settings.btn_interest_color,
    cachedViews: (state) => state.tagsView.cachedViews,
    check: (state) => state.auth.user !== null,
    darkTheme: (state) => state.settings.darkTheme,
    drawer: (state) => state.settings.drawer,
    mainMenuModify: (state) => state.settings.main_menu_modify,
    mini: (state) => state.settings.mini,

    tagsViewShow: (state) => state.settings.tagsView,
    visitedViews: (state) => state.tagsView.visitedViews, */
};
export default getters;
