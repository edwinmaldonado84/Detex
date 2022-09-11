import AdminLayout from "@/layouts/AdminLayout.vue";

function page(val) {
    return () =>
        import(`../../../pages/admin/${val}.vue`).then((m) => m.default);
}

export default [
    {
        path: "/redirect/:id",
        hidden: true,
        component: () => import(`../../../pages/redirect/RedirectPage.vue`),
    },
    {
        path: "/dashboard",
        name: "DashboardPage",
        hidden: false,
        component: () => import(`../../../pages/admin/DashboardPage.vue`),
        meta: {
            title: "Dashboard",
            noCache: true,
            layout: AdminLayout,
            middleware: "auth",
            icon: "dashboard",
            affix: true,
            separator: true,
        },
    },
    {
        path: "/companies",
        name: "CompaniesPage",
        hidden: false,
        component: () =>
            import(`../../../pages/admin/companies/CompaniesPage.vue`),
        meta: {
            title: "Companies",
            noCache: true,
            layout: AdminLayout,
            middleware: "auth",
            icon: "apartment",
            separator: true,
        },
    },
    {
        path: "/users",
        name: "UsersPage",
        hidden: false,
        component: () => import(`../../../pages/admin/users/UsersPage.vue`),
        meta: {
            title: "Users",
            noCache: true,
            layout: AdminLayout,
            middleware: "auth",
            icon: "group",
            separator: true,
        },
    },
];
