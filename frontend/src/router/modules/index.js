/**
 * Note: sub-menu only appear when route children.length >= 1
 *
 * hidden: true                   if set true, item will not show in the sidebar(default is false)
 * alwaysShow: true               if set true, will always show the root menu
 *                                if not set alwaysShow, when item has more than one children route,
 *                                it will becomes nested mode, otherwise not show the root menu
 * redirect: noRedirect           if set noRedirect will no redirect in the breadcrumb
 * name:'router-name'             the name is used by <keep-alive> (must set!!!) need to be the same that the views name for the cache
 * noSearch: true                 it will be not search it.
* meta : {
    permissions: ['admin','editor']    control the page roles (you can set multiple roles)
    title: 'title'               the name show in sidebar and breadcrumb (recommend set)
    icon: 'svg-name'/'el-icon-x' the icon show in the sidebar
    noCache: true                if set true, the page will no be cached(default is false)
    affix: true                  if set true, the tag will affix in the tags-view
    breadcrumb: false            if set false, the item will hidden in breadcrumb(default is true)
    activeMenu: '/example/list'  if set path, the sidebar will highlight the path you set
  }
 */

// Load guest routes dynamically.

const contextPublic = import.meta.glob("./public/*.js", {
    eager: true,
});

export const constantRoutes = Object.keys(contextPublic)
    .map((path) => {
        name = path.replace("./modules/", "");
        name = name.replace(/(^.\/)|(\.js$)/g, "");

        return [name, contextPublic[path].default];
    })
    .reduce((modules, [, module]) => {
        return [...modules, ...module];
    }, []);

// Load admin routes dynamically.

/* const contextAdmin = import.meta.glob("./admin/*.js", {
    eager: true,
});

export const asyncRoutes = Object.keys(contextAdmin)
    .map((path) => {
        name = path.replace("./modules/", "");
        name = name.replace(/(^.\/)|(\.js$)/g, "");

        return [name, contextAdmin[path].default];
    })
    .reduce((modules, [, module]) => {
        return [...modules, ...module];
    }, []); */

const adminList = import.meta.glob("./admin/*.js", {
    eager: true,
});

export const asyncRoutes = Object.keys(adminList)
    .map((value) => {
        return [value, adminList[value].default];
    })
    .reduce((modules, [, module]) => {
        return [...modules, ...module];
    }, []);

// Errors

const contextError = import.meta.glob("./error/*.js", {
    eager: true,
});
export const errorRoutes = Object.keys(contextError)
    .map((path) => {
        name = path.replace("./modules/", "");
        name = name.replace(/(^.\/)|(\.js$)/g, "");

        return [name, contextError[path].default];
    })
    .reduce((modules, [, module]) => {
        return [...modules, ...module];
    }, []);
