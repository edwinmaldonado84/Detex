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
                <DeProfileComponent />
            </q-toolbar>
        </q-header>

        <q-drawer
            show-if-above
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
            <DeDrawerMenu />
        </q-drawer>

        <q-page-container>
            <div v-if="tagsViewShow" class="tagsView">
                <DeTagsView />
            </div>
            <router-view v-slot="{ Component }">
                <keep-alive :include="cachedViews">
                    <component :is="Component" />
                </keep-alive>
            </router-view>
        </q-page-container>
    </q-layout>
</template>

<script setup>
import DeProfileComponent from "./components/DeProfileComponent.vue";
import DeTagsView from "./components/DeTagsView.vue";
import DeDrawerMenu from "./components/DeDrawerMenu.vue";
import { ref, onBeforeMount, computed } from "vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

const store = useStore();
const route = useRoute();
const drawer = ref(false);
const miniEffect = ref(false);
const miniState = ref(false);
const tagsViewShow = ref(true);

const cachedViews = computed(() => {
    return store.getters.cachedViews;
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
