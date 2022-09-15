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
            icon: "business",
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
    {
        path: "/settings",
        name: "SettingsPage",
        redirect: "/settings/groups",
        meta: {
            title: "Settings",
            icon: "settings",
            affix: false,
            separator: true,
        },
        children: [
            {
                path: "groups",
                name: "Groups",
                component: () =>
                    import("../../../pages/admin/settings/groups/Groups.vue"),
                meta: {
                    title: "Groups",
                    noCache: true,
                    layout: AdminLayout,
                    middleware: "auth",
                    icon: "business",
                    affix: false,
                    separator: false,
                },
            },
            {
                path: "charges",
                name: "Charges",
                component: () =>
                    import("../../../pages/admin/settings/charges/Charges.vue"),
                meta: {
                    title: "Charges",
                    noCache: true,
                    layout: AdminLayout,
                    middleware: "auth",
                    icon: "business",
                    affix: false,
                    separator: false,
                },
            },
        ],
    },
];
