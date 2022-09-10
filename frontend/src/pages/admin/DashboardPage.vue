<template>
    <q-page class="container text-center row justify-center items-center">
        <div class="q-pa-xl">
            <q-card class="my-card">
                <q-card-section v-text="format.capitalize($t('dashboard'))" />
                <q-card-section v-text="format.humanStorageSize(13087)" />
                <!-- <q-card-section v-text="$rules.required" /> -->
                <q-input label="Standard" :rules="[$rules.required]" />
                <q-btn
                    outline
                    color="primary"
                    size="lg"
                    class="full-width text-capitalize"
                    :label="$t('buttons.login')"
                    @click="logout"
                />
            </q-card>
        </div>
    </q-page>
</template>
<script setup>
import { format, useQuasar, QSpinnerGears } from "quasar";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

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
    }, 1000);
};
</script>
<style lang="scss" scoped>
.container {
    border: solid 1px red;
}
</style>
