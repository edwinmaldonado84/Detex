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
const { id } = params;
const visible = ref(true);

router.replace({ path: "/" + id });
</script>
