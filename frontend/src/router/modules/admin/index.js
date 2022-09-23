import AdminLayout from "@/layouts/AdminLayout.vue";

export default [
    {
        path: "/redirect",
        hidden: true,
        children: [
            {
                path: "/redirect/:pathMatch(.*)*",
                component: () =>
                    import("../../../pages/redirect/RedirectPage.vue"),
                meta: {
                    title: "pages.redirect",
                    noCache: true,
                    layout: AdminLayout,
                    icon: "refresh",
                    affix: false,
                    separator: false,
                },
            },
        ],
    },
    {
        path: "/dashboard",
        name: "DashboardPage",
        hidden: false,
        component: () =>
            import("../../../pages/admin/dashboard/DashboardPage.vue"),
        meta: {
            title: "pages.dashboard",
            noCache: true,
            layout: AdminLayout,
            middleware: "auth",
            icon: "dashboard",
            affix: true,
            separator: true,
        },
    },
    {
        path: "/quotations",
        name: "QuotationsPage",
        hidden: false,
        component: () =>
            import("../../../pages/admin/quotations/QuotationsPage.vue"),
        meta: {
            title: "pages.quotations",
            noCache: false,
            layout: AdminLayout,
            middleware: "auth",
            icon: "request_quote",
            affix: true,
            separator: true,
        },
    },
    {
        path: "/orders",
        name: "OrdersPage",
        hidden: false,
        component: () => import("../../../pages/admin/orders/OrdersPage.vue"),
        meta: {
            title: "pages.orders",
            noCache: false,
            layout: AdminLayout,
            middleware: "auth",
            icon: "shopping_bag",
            affix: false,
            separator: true,
        },
    },
    {
        path: "/contacts",
        name: "ContactPage",
        hidden: false,
        component: () =>
            import("../../../pages/admin/contacts/ContactPage.vue"),
        meta: {
            title: "pages.contact",
            noCache: false,
            layout: AdminLayout,
            middleware: "auth",
            icon: "contact_phone",
            affix: false,
            separator: true,
        },
    },
    {
        path: "/bank",
        name: "BankPage",
        hidden: false,
        component: () => import("../../../pages/admin/bank/BankPage.vue"),
        meta: {
            title: "pages.bank",
            noCache: true,
            layout: AdminLayout,
            middleware: "auth",
            icon: "account_balance",
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
            title: "pages.users",
            noCache: true,
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
            title: "pages.settings",
            icon: "settings",
            affix: false,
            separator: true,
        },
        children: [
            {
                path: "groups",
                name: "Groups",
                component: () =>
                    import(
                        "../../../pages/admin/settings/groups/GroupsPage.vue"
                    ),
                meta: {
                    title: "pages.groups",
                    noCache: false,
                    layout: AdminLayout,
                    middleware: "auth",
                    icon: "groups",
                    affix: false,
                    separator: false,
                },
            },
            {
                path: "companies",
                name: "CompaniesPage",
                hidden: false,
                component: () =>
                    import(
                        "../../../pages/admin/settings/companies/CompaniesPage.vue"
                    ),
                meta: {
                    title: "pages.companies",
                    noCache: false,
                    layout: AdminLayout,
                    middleware: "auth",
                    icon: "business",
                    affix: false,
                    separator: false,
                },
            },
            {
                path: "charges",
                name: "ChargesPage",
                component: () =>
                    import(
                        "../../../pages/admin/settings/charges/ChargesPage.vue"
                    ),
                meta: {
                    title: "pages.charges",
                    noCache: false,
                    layout: AdminLayout,
                    middleware: "auth",
                    icon: "work",
                    affix: false,
                    separator: false,
                },
            },
        ],
    },
];
