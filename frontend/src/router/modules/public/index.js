export default [
    {
        path: "/",
        name: "AuthPage",
        component: () => import("../../../pages/public/AuthPage.vue"),
        hidden: true,
        meta: {
            title: "Home",
            noCache: true,
        },
    },
];
