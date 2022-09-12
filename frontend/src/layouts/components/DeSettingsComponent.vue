<template>
    <q-avatar class="q-mx-lg">
        <q-icon size="lg" name="settings" />
        <q-menu :offset="[90, 5]">
            <q-list style="min-width: 100px">
                <q-item class="row items-center">
                    <q-btn-toggle
                        v-model="theme"
                        no-caps
                        unelevated
                        toggle-color="primary"
                        color="white"
                        text-color="primary"
                        :options="optionsTheme"
                        class="custom-toggle"
                        ripple
                    >
                        <template v-slot:dark>
                            <div
                                class="row items-center no-wrap"
                                :class="!theme ? 'opacity-50' : ''"
                            >
                                <q-icon left name="dark_mode" />
                                <div class="text-center">Dark</div>
                            </div>
                        </template>

                        <template v-slot:light>
                            <div class="row items-center no-wrap">
                                <div class="text-center">Light</div>
                                <q-icon right name="light_mode" />
                            </div>
                        </template>
                    </q-btn-toggle>
                </q-item>
                <q-separator />
                <q-item class="row items-center">
                    <q-btn-toggle
                        v-model="tags"
                        no-caps
                        unelevated
                        toggle-color="primary"
                        color="white"
                        text-color="primary"
                        :options="optionsTags"
                        class="custom-toggle"
                    >
                        <template v-slot:available>
                            <div
                                class="row items-center no-wrap"
                                :class="!tags ? 'opacity-50' : ''"
                            >
                                <q-icon left name="visibility" />
                                <div class="text-center">Show</div>
                            </div>
                        </template>

                        <template v-slot:disable>
                            <div
                                class="row items-center no-wrap"
                                :class="tags ? 'opacity-50' : ''"
                            >
                                <div class="text-center">Hidde</div>
                                <q-icon right name="visibility_off" />
                            </div>
                        </template>
                    </q-btn-toggle>
                </q-item>
            </q-list>
        </q-menu>
    </q-avatar>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useStore } from "vuex";
import { useQuasar } from "quasar";

const store = useStore();
const $q = useQuasar();
const theme = ref(null);
const tags = ref(null);

const optionsTheme = [
    { value: true, slot: "dark" },
    { value: false, slot: "light" },
];

const optionsTags = [
    { value: true, slot: "available" },
    { value: false, slot: "disable" },
];

onMounted(() => {
    theme.value = store.getters.darkTheme;
    tags.value = store.getters.tagsViewShow;
});

watch(theme, (value) => {
    $q.dark.set(value);
    store.dispatch("settings/changeSetting", {
        key: "darkTheme",
        value: value,
    });
});

watch(tags, (value) => {
    store.dispatch("settings/changeSetting", {
        key: "tagsView",
        value: value,
    });
});
</script>
<style lang="sass" scoped>
.custom-toggle
  border: 1px solid #027be3

  .opacity-50
    opacity: .5
</style>
