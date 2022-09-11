import AdminLayout from "@/layouts/AdminLayout.vue";

function page(val) {
    return () =>
        import(`../../../pages/admin/${val}.vue`).then((m) => m.default);
}

export default [
    {
        path: "/dashboard",
        name: "DashboardPage",
        hidden: false,
        component: page("DashboardPage"),
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
            affix: true,
            separator: true,
        },
    },
];
