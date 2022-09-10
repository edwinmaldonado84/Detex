<template>
    <q-select
        v-model="locale"
        :options="$i18n.availableLocales"
        :label="$t('language')"
        dense
        borderless
        emit-value
        map-options
        options-dense
        style="min-width: 100px"
    />
</template>

<script setup>
import { onMounted, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useStore } from "vuex";

const store = useStore();
const { locale } = useI18n({
    useScope: "global",
});

onMounted(() => {
    locale.value = store.getters.language;
});

watch(locale, (value) => {
    locale.value = value;
    store.dispatch("lang/setLanguage", value);
});
</script>
