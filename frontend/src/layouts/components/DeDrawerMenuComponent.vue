<template>
    <q-scroll-area class="fit">
        <q-list>
            <template v-for="item in items" :key="item.path">
                <q-expansion-item
                    v-if="item.children"
                    expand-separator
                    :icon="item.meta.icon"
                    :label="item.meta.title"
                    group="group"
                    :default-opened="route.matched[0].path == item.path"
                    :to="{ path: item.path }"
                >
                    <q-list>
                        <template
                            v-for="subItem in item.children"
                            :key="subItem.path"
                        >
                            <q-item
                                clickable
                                v-ripple
                                :to="{ name: subItem.name }"
                            >
                                <q-item-section class="q-ml-lg" avatar>
                                    <q-icon :name="subItem.meta.icon" />
                                </q-item-section>
                                <q-item-section v-text="subItem.meta.title" />
                            </q-item>

                            <q-separator
                                :key="'sep' + subItem.path"
                                v-if="subItem.meta.separator"
                            />
                        </template>
                    </q-list>
                </q-expansion-item>

                <q-item v-else clickable v-ripple :to="{ name: item.name }">
                    <q-item-section avatar>
                        <q-icon :name="item.meta.icon" />
                    </q-item-section>
                    <q-item-section v-text="item.meta.title" />
                </q-item>

                <q-separator
                    :key="'sep' + item.path"
                    v-if="item.meta.separator"
                />
            </template>
        </q-list>
    </q-scroll-area>
</template>
<script setup>
import { onBeforeMount, computed, ref, reactive, watch } from "vue";
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";

const store = useStore();
const router = useRouter();
const route = useRoute();
const model = reactive({});
console.log(
    "🚀 ~ file: DeDrawerMenuComponent.vue ~ line 60 ~ route",
    route.matched[0].path
);

onBeforeMount(async () => {
    await store.dispatch("permissionRoutes/setRoutes");
});

const items = computed(() => {
    return store.getters.permission_routes;
});

watch(route, (val) => {
    console.log(
        "🚀 ~ file: DeDrawerMenuComponent.vue ~ line 77 ~ watch ~ val",
        val
    );
    model[val.matched[0].path] = true;
});
</script>
<style lang="sass" scoped>
.my-exact-active-class
    border:1px solid #000000
    border-color: cyan
    background-color: cyan
</style>
