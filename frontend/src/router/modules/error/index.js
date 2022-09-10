function page(val) {
    return () => import(`../../../pages/error/${val}.vue`).then((m) => m);
}

export default [
    {
        path: "/403",
        name: "Forbidden",
        hidden: true,
        component: page("403"),
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
        component: page("404"),
        meta: {
            title: "Not Found",
            error: true,
            noCache: true,
        },
    },
    {
        path: "/redirect/:url",
        name: "Redirect",
        hidden: true,
        component: page("Redirect"),
        props: (route) => ({ url: route.params.url }),
        meta: {
            title: "Redirect",
            error: false,
            noCache: true,
        },
    },
    {
        path: "/:pathMatch(.*)*",
        hidden: true,
        name: "NoFound",
        component: page("404"),
        meta: {
            title: "Not Found",
        },
    },
];
