<template>
    <div class="q-mx-sm">
        <q-btn flat round color="white">
            <q-icon size="md" :class="'flag_' + store.getters.language" />
        </q-btn>
        <q-menu :offset="[30, 5]">
            <q-list
                v-for="item in $i18n.availableLocales"
                style="min-width: 100px"
            >
                <q-item
                    clickable
                    v-close-popup
                    class="row items-center"
                    @click="locale = item"
                >
                    <q-icon :class="'flag_' + item" size="sm" />
                    <q-item-section
                        class="q-pl-md text-h6 text-capitalize"
                        v-text="item"
                    />
                </q-item>
                <q-separator />
            </q-list>
        </q-menu>
    </div>
</template>

<script setup>
import { onMounted, watch, computed, reactive } from "vue";
import { useI18n } from "vue-i18n";
import { useStore } from "vuex";
import { useQuasar } from "quasar";
const langList = import.meta.glob("../../node_modules/quasar/lang/*.mjs", {
    eager: true,
});

const store = useStore();
const $q = useQuasar();
const Languages = reactive(langList);
const { locale } = useI18n({
    useScope: "global",
});

onMounted(async () => {
    locale.value = store.getters.language;
    changeLanguage(store.getters.language);
});

watch(locale, async (value) => {
    locale.value = value;
    changeLanguage(value);
    store.dispatch("lang/setLanguage", value);
});

const changeLanguage = async (val) => {
    $q.lang.set(
        Languages["../../node_modules/quasar/lang/" + val + ".mjs"].default
    );
};
</script>
<style lang="scss" scoped>
.flag_en-US {
    background: url("@/assets/img/flags/usa.png") no-repeat center center / 100%;
}
.flag_es {
    background: url("@/assets/img/flags/mexico.png") no-repeat center center /
        100%;
}
</style>
