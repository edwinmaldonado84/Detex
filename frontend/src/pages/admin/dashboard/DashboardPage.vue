<template>
    <div class="q-px-md">
        <q-layout view="lHh Lpr lFf" container style="height: 88vh">
            <div class="q-pa-md">
                <div class="q-gutter-x-xs q-gutter-y-lg">
                    <div class="full-width row wrap justify-evenly">
                        <q-card class="col col-4">
                            <chart-bar />
                        </q-card>
                        <q-card class="col col-3">
                            <chart-doughnut />
                        </q-card>
                        <q-card class="col col-4">
                            <chart-line />
                        </q-card>
                    </div>
                </div>
            </div>
        </q-layout>
    </div>
</template>
<script setup>
import { format, useQuasar, QSpinnerGears } from "quasar";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { useMeta } from "vue-meta";

useMeta({
    title: "Dasboard",
});

const store = useStore();
const $q = useQuasar();
const router = useRouter();

$q.dark.set(false);

const logout = async () => {
    $q.loading.show({
        spinner: QSpinnerGears,
        spinnerColor: "white",
        messageColor: "white",
        backgroundColor: "gray",
        message: "Eliminando datos de sesion...",
    });
    await store.dispatch("auth/logout").catch(function (error) {
        $q.loading.hide();
    });
    setTimeout(() => {
        $q.loading.hide();
        router.push({ name: "Home" });
    }, 700);
};
</script>
<style lang="scss" scoped>
.container {
    border: solid 1px red;
}
</style>
