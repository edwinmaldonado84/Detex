<template>
    <div class="flex">
        <h1 v-text="$t(route.meta.title)" />

        <div class="tw-bg-black tw-h-10">
            <q-input
                v-model="text"
                label="Label"
                dense
                class="tw-border-b-2 focus:tw-border-b-red-500"
            />
        </div>
    </div>
</template>

<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
</script>
