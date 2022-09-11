<template>
    <q-avatar class="q-mx-lg">
        <q-icon size="md" :class="'flag_' + store.getters.language" />
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
    </q-avatar>
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
<style lang="scss" scoped>
.flag_en {
    background: url("@/assets/img/flags/usa.png") no-repeat center center / 100%;
}
.flag_es {
    background: url("@/assets/img/flags/mexico.png") no-repeat center center /
        100%;
}
</style>
