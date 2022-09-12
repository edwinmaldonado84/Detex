<template>
    <div class="q-mx-sm">
        <q-chip clickable>
            <q-avatar>
                <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
            </q-avatar>
            <span v-text="store.getters.user?.name" />
            <q-menu :offset="[0, 10]">
                <q-list style="min-width: 150px">
                    <q-item clickable v-close-popup class="row items-center">
                        <q-icon size="xs" :name="'edit'" />
                        <q-item-section
                            class="q-pl-md"
                            v-text="'Edit account'"
                        />
                    </q-item>
                    <q-separator />
                    <q-item
                        clickable
                        v-close-popup
                        class="row items-center"
                        @click.native="logout"
                    >
                        <q-icon size="xs" :name="'logout'" />
                        <q-item-section class="q-pl-md" v-text="'Logout'" />
                    </q-item>
                    <q-separator />
                </q-list>
            </q-menu>
        </q-chip>
    </div>
</template>
<script setup>
import { useStore } from "vuex";
import { useQuasar, QSpinnerGears } from "quasar";
import { useRouter } from "vue-router";
import { useMeta } from "vue-meta";

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
    router.push({ name: "AuthPage" });
    setTimeout(() => {
        $q.loading.hide();
    }, 700);
};
</script>
