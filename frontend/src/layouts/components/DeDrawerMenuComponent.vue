<template>
    <q-scroll-area class="fit">
        <q-list>
            <template v-for="(item, index) in items" :key="item.path">
                <q-item clickable v-ripple :to="{ name: item.name }">
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
import { onBeforeMount, computed } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

const store = useStore();
const router = useRouter();

onBeforeMount(async () => {
    await store.dispatch("permissionRoutes/setRoutes");
});

const items = computed(() => {
    return store.getters.permission_routes;
});
</script>
