<template>
    <q-scroll-area class="fit">
        <q-list>
            <template v-for="item in items" :key="item.path">
                <q-expansion-item
                    v-model="model[item.path]"
                    v-if="item.children"
                    expand-separator
                    group="group"
                    :label="item.meta.title"
                    :icon="item.meta.icon"
                    :expand-icon-class="{ 'text-primary': model[item.path] }"
                    :header-class="{ 'text-primary': model[item.path] }"
                    expand-icon="arrow_circle_down"
                >
                    <template
                        v-for="subItem in item.children"
                        :key="subItem.path"
                    >
                        <q-item clickable v-ripple :to="{ name: subItem.name }">
                            <q-item-section avatar>
                                <!-- <q-icon right :name="subItem.meta.icon" /> -->
                            </q-item-section>
                            <q-item-section v-text="subItem.meta.title" />
                        </q-item>

                        <q-separator
                            :key="'sep' + subItem.path"
                            v-if="subItem.meta.separator"
                        />
                    </template>
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
import { onMounted, onBeforeMount, computed, ref, reactive, watch } from "vue";
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";

const store = useStore();
const router = useRouter();
const route = useRoute();
const model = reactive({});

onBeforeMount(async () => {
    await store.dispatch("permissionRoutes/setRoutes");
});

onMounted(async () => {
    model[route.matched[0].path] = true;
});

const items = computed(() => {
    return store.getters.permission_routes;
});

watch(route, (val) => {
    model[val] = true;
});
</script>
