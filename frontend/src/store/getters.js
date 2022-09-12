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
    visitedViews: (state) => state.tagsView.visitedViews,
    tagsViewShow: (state) => state.settings.tagsView,

    darkTheme: (state) => state.settings.darkTheme,
    drawer: (state) => state.settings.drawer,
    mini: (state) => state.settings.mini,
    /*
    btnInterestColor: (state) => state.settings.btn_interest_color,
    mainMenuModify: (state) => state.settings.main_menu_modify,
 */
};
export default getters;
