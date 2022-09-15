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
import { onMounted, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useStore } from "vuex";
import { useQuasar } from "quasar";
import esLang from "quasar/lang/es";
import enLang from "quasar/lang/en-US";

const store = useStore();
const $q = useQuasar();
const { locale } = useI18n({
    useScope: "global",
});

onMounted(() => {
    locale.value = store.getters.language;
    $q.lang.set(locale.value == "es" ? esLang : enLang);
});

watch(locale, async (value) => {
    locale.value = value;
    console.log(
        "🚀 ~ file: DeLanguageComponent.vue ~ line 49 ~ watch ~ value",
        value
    );

    $q.lang.set(value == "es" ? esLang : enLang);
    // $q.lang.set("es");
    /*    import("quasar/lang/" + value).then((language) => {
        console.log(
            "🚀 ~ file: DeLanguageComponent.vue ~ line 50 ~ awaitimport ~ language.default",
            language.default
        );
        $q.lang.set(language.default);
    }); */
    $q.lang.getLocale();

    store.dispatch("lang/setLanguage", value);
});
</script>
<style lang="scss" scoped>
.flag_en {
    background: url("@/assets/img/flags/usa.png") no-repeat center center / 100%;
}
.flag_es {
    background: url("@/assets/img/flags/mexico.png") no-repeat center center /
        100%;
}
</style>
