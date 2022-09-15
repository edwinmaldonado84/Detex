<template>
    <h1 v-text="$t(route.meta.title)" />
</template>

<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
</script>
