function page(val) {
    return () => import(`../../../pages/public/${val}.vue`).then((m) => m);
}

export default [
    {
        path: "/",
        name: "Home",
        component: page("HomePage"),
        hidden: true,
        meta: {
            title: "Home",
            noCache: true,
        },
    },
];
