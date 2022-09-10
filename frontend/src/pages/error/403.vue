<template>
    <h1>403</h1>
</template>

<script>
export default {
    name: "Forbidden",
    data: () => ({
        redirectBack: false,
        // imgError: require("@/assets/img/error/error.jpg"),
    }),
    mounted() {
        this.redirectBack = window.history.length > 2 ? true : false;
    },
};
</script>

<style lang="scss" scoped>
.title {
    font-size: 5rem !important;
    font-weight: 800;
    color: var(--v-primary-base);
}
.title_description {
    font-size: 1.8rem !important;
    font-weight: 800;
    line-height: 2rem;
}
.description {
    font-size: 1.2rem !important;
}
</style>
