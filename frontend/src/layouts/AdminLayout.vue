<template>
    <q-layout view="hHh lpR fFf">
        <q-header elevated class="bg-primary text-white" height-hint="98">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleDrawer" />

                <q-toolbar-title>
                    <!--               <q-avatar>
                        <img
                            src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"
                        />
                    </q-avatar> -->
                    Detex
                </q-toolbar-title>
                <DeLanguageComponent />
                <DeSettingsComponent />
                <DeProfileComponent />
            </q-toolbar>
        </q-header>

        <q-drawer
            v-model="drawer"
            side="left"
            bordered
            :mini="miniEffect ? miniState : false"
            @mouseover="drawer ? (miniState = false) : ''"
            @mouseout="drawer ? (miniState = true) : ''"
            :width="200"
            :breakpoint="500"
            class="bg-grey-3"
        >
            <DeDrawerMenuComponent />
        </q-drawer>

        <q-page-container>
            <div v-if="store.getters.tagsViewShow" class="tagsView">
                <DeTagsViewComponent />
            </div>
            <router-view v-slot="{ Component, route }">
                <q-slide-transition :duration="3000">
                    <keep-alive :include="cachedViews">
                        <component :is="Component" :key="route.path" />
                    </keep-alive>
                </q-slide-transition>
            </router-view>
        </q-page-container>
    </q-layout>
</template>

<script setup>
import DeSettingsComponent from "./components/DeSettingsComponent.vue";
import DeProfileComponent from "./components/DeProfileComponent.vue";
import DeTagsViewComponent from "./components/DeTagsViewComponent.vue";
import DeDrawerMenuComponent from "./components/DeDrawerMenuComponent.vue";
import { ref, onBeforeMount, computed } from "vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

const store = useStore();
const route = useRoute();
const miniState = ref(false);

const cachedViews = computed(() => {
    return store.getters.cachedViews;
});

const key = computed(() => {
    return route.path;
});

const drawer = computed({
    get() {
        return store.getters.drawer;
    },
    set(newValue) {
        store.dispatch("settings/changeSetting", {
            key: "drawer",
            value: newValue,
        });
    },
});

const miniEffect = computed({
    get() {
        return store.getters.mini;
    },
    set(newValue) {
        store.dispatch("settings/changeSetting", {
            key: "mini",
            value: newValue,
        });
    },
});

function toggleDrawer() {
    switch (true) {
        case drawer.value == true && miniEffect.value == false:
            miniEffect.value = true;
            break;
        case drawer.value == false && miniState.value == false:
            drawer.value = true;
            break;
        case drawer.value == true && miniState.value == true:
            drawer.value = false;
            miniEffect.value = false;
            break;
        default:
            drawer.value = true;
            break;
    }
}
</script>
