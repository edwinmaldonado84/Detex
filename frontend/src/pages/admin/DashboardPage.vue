<template>
    <q-page
        :style-fn="height"
        class="container text-center row justify-center items-center"
    >
        <div class="q-pa-xl">
            <q-card class="my-card">
                <q-card-section v-text="format.capitalize($t('dashboard'))" />
                <q-card-section v-text="format.humanStorageSize(13087)" />
                <!-- <q-card-section v-text="$rules.required" /> -->
                <q-input label="Standard" :rules="[$rules.required]" />
            </q-card>
        </div>
    </q-page>
</template>
<script setup>
import { format, useQuasar } from "quasar";

const $q = useQuasar();
function height(offset) {
    return { minHeight: offset ? `calc(100vh - ${offset}px)` : "100vh" };
}

$q.dark.set(false);
</script>
<style lang="scss" scoped>
.container {
    border: solid 1px red;
}
</style>
