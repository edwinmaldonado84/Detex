<template>
    <div class="w-screen h-screen">
        <q-inner-loading :showing="visible">
            <q-spinner-gears size="250px" color="primary" />
        </q-inner-loading>
    </div>
</template>
<script setup>
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";

const router = useRouter();
const { params } = useRoute();
const visible = ref(true);

setTimeout(() => {
    router.replace({ path: "/" + params.pathMatch.join("/") });
}, 200);
</script>
