<template>
    <div class="flex">
        <h1 v-text="$t(route.meta.title)" />

        <div class="tw-h-10">
            <q-input v-model="text" label="Label" dense />
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const text = ref(null);
</script>
