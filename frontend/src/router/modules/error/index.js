export default [
    {
        path: "/403",
        name: "Forbidden",
        hidden: true,
        component: () => import("../../../pages/error/403.vue"),

        meta: {
            title: "Forbidden",
            error: true,
            noCache: true,
        },
    },
    {
        path: "/404",
        name: "NotFound",
        hidden: true,
        component: () => import("../../../pages/error/404.vue"),
        meta: {
            title: "Not Found",
            error: true,
            noCache: true,
        },
    },
    {
        path: "/:pathMatch(.*)*",
        hidden: true,
        name: "NoFound",
        component: () => import("../../../pages/error/404.vue"),
        meta: {
            title: "Not Found",
        },
    },
];
