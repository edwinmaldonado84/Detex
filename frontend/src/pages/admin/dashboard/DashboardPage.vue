<template>
    <div class="q-px-md">
        <q-layout view="lHh Lpr lFf" container style="height: 88vh">
            <div class="q-pa-md">
                <div class="q-gutter-sm">
                    <div class="full-width row wrap justify-evenly">
                        <q-card class="col col-5 q-my-lg">
                            <chart-bar />
                        </q-card>
                        <q-card class="col col-5 q-my-lg">
                            <chart-line />
                        </q-card>
                        <q-card class="col col-4 q-my-lg">
                            <chart-doughnut />
                        </q-card>

                        <q-card class="col col-6 q-my-lg">
                            <chart-bar2 />
                        </q-card>

                        <q-card class="col col-5 q-my-lg">
                            <chart-polar-area />
                        </q-card>
                        <q-card class="col col-5 q-my-lg">
                            <chart-radar />
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
        router.push({ name: "AuthPage" });
    }, 700);
};
</script>
