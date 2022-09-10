import AdminLayout from "@/layouts/AdminLayout.vue";

function page(val) {
    return () => import(`../../../pages/admin/${val}.vue`).then((m) => m);
}

export default [
    {
        path: "/dashboard",
        name: "DashboardPage",
        hidden: true,
        component: page("DashboardPage"),
        meta: {
            title: "Dashboard",
            noCache: true,
            layout: AdminLayout,
        },
    },
];
