<template>
    <h1>redirect</h1>
</template>
<script setup>
import { useRoute, useRouter } from "vue-router";

const router = useRouter();
const { params } = useRoute();
const { id } = params;

router.replace({ path: "/" + id });
</script>
