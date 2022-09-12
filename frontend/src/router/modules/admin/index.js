import AdminLayout from "@/layouts/AdminLayout.vue";

export default [
    {
        path: "/redirect/:id",
        hidden: true,
        component: () => import("../../../pages/redirect/RedirectPage.vue"),
    },
    {
        path: "/dashboard",
        name: "DashboardPage",
        hidden: false,
        component: () =>
            import("../../../pages/admin/dashboard/DashboardPage.vue"),
        meta: {
            title: "Dashboard",
            noCache: false,
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
            import("../../../pages/admin/companies/CompaniesPage.vue"),
        meta: {
            title: "Companies",
            noCache: false,
            layout: AdminLayout,
            middleware: "auth",
            icon: "apartment",
            affix: false,
            separator: true,
        },
    },
    {
        path: "/users",
        name: "UsersPage",
        hidden: false,
        component: () => import("../../../pages/admin/users/UsersPage.vue"),
        meta: {
            title: "Users",
            noCache: false,
            layout: AdminLayout,
            middleware: "auth",
            icon: "group",
            affix: false,
            separator: true,
        },
    },
];
