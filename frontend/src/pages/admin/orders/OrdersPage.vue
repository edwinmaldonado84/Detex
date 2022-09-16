<template>
    <h1 v-text="$t(route.meta.title)" />

    <input
        type="text"
        class="w-96 px-3 py-2 border border-slate-600 rounded-xl focus:outline-0"
    />
    <input type="text" />
</template>

<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
</script>
