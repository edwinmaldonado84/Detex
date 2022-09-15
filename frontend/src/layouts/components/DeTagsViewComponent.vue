<template>
    <div ref="rootRef" class="q-pa-sm">
        <q-chip
            v-for="(tag, i) in visitedViews"
            ref="tagRef"
            :key="tag.path"
            square
            clickable
            @click="
                router.push({
                    path: tag.path,
                    query: tag.query,
                    fullPath: tag.fullPath,
                })
            "
            :to="{ path: tag.path, query: tag.query, fullPath: tag.fullPath }"
            :removable="i > 0"
            @remove="closeSelectedTag(tag)"
            @contextmenu.prevent.native="openMenu(tag, $event)"
            :color="isActive(tag) ? 'primary' : ''"
            :text-color="isActive(tag) ? 'white' : ''"
            class="q-bg--dark-red"
        >
            {{ tag.title }}
            <q-menu v-model="visible" v-if="selectedTag == tag" auto-close>
                <q-list style="min-width: 100px">
                    <q-item
                        clickable
                        v-close-popup
                        @click="refreshSelectedTag(tag)"
                    >
                        <q-item-section>Refresh</q-item-section>
                    </q-item>

                    <q-separator />

                    <q-item clickable v-close-popup @click="closeOthersTags">
                        <q-item-section>Close Others</q-item-section>
                    </q-item>

                    <q-separator />

                    <q-item clickable v-close-popup @click="closeAllTags">
                        <q-item-section>Close All</q-item-section>
                    </q-item>

                    <q-separator />
                </q-list>
            </q-menu>
        </q-chip>
    </div>
</template>

<script setup>
import { ref, reactive, computed, watch, onMounted, nextTick } from "vue";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";

const store = useStore();
const currentlyRoute = useRoute();
const router = useRouter();
const selectedTag = ref(null);
const affixTags = reactive([]);
const tagRef = ref([]);
const rootRef = ref(null);
const top = ref(0);
const left = ref(0);
const visible = ref(false);

const visitedViews = computed(() => {
    return store.state.tagsView.visitedViews;
});

const routes = computed(() => {
    return store.getters.permission_routes;
});

watch(currentlyRoute, async (value) => {
    addTags();
    moveToCurrentTag();
});

onMounted(async () => {
    initTags();
    addTags();
});

const initTags = () => {
    const affixTagsList = (affixTags.value = filterAffixTags(routes.value));

    for (const tag of affixTagsList) {
        // Must have tag name
        if (tag.name) {
            store.dispatch("tagsView/addVisitedView", tag);
        }
    }
};

const filterAffixTags = (routes, basePath = "/") => {
    let tags = [];
    routes.forEach((route) => {
        if (route.meta && route.meta.affix) {
            // const tagPath = path.resolve(basePath, route.path);
            const tagPath = route.path;
            tags.push({
                fullPath: tagPath,
                path: tagPath,
                name: route.name,
                meta: { ...route.meta },
            });
        }
        if (route.children) {
            const tempTags = filterAffixTags(route.children, route.path);
            if (tempTags.length >= 1) {
                tags = [...tags, ...tempTags];
            }
        }
    });
    return tags;
};

const addTags = () => {
    const { name } = currentlyRoute;

    if (name) {
        store.dispatch("tagsView/addView", currentlyRoute);
    }
    return false;
};

const moveToCurrentTag = async () => {
    await nextTick();
    for (const tag of tagRef.value) {
        if (tag.$attrs.to.path === currentlyRoute.path) {
            //this.$refs.scrollPane.moveToTarget(tag);
            // when query is different then update
            if (tag.$attrs.to.fullPath !== currentlyRoute.fullPath) {
                store.dispatch("tagsView/updateVisitedView", currentlyRoute);
            }
            break;
        }
    }
};

const closeSelectedTag = (view) => {
    store.dispatch("tagsView/delView", view).then(({ visitedViews }) => {
        if (isActive(view)) {
            toLastView(visitedViews, view);
        }
    });
};

const isActive = (route) => {
    return route.path === currentlyRoute.path;
};

const toLastView = (visitedViews, view) => {
    const latestView = visitedViews.slice(-1)[0];
    if (latestView) {
        router.push(latestView.fullPath);
    } else {
        // now the default is to redirect to the home page if there is no tags-view,
        // you can adjust it according to your needs.
        if (view.name === "Dashboard") {
            // to reload home page
            router.replace({ path: "/redirect" + view.fullPath });
        } else {
            router.push("/");
        }
    }
};

const openMenu = (tag, e) => {
    selectedTag.value = tag;
    visible.value = true;
};

const isAffix = (tag) => {
    return tag.meta && tag.meta.affix;
};

const refreshSelectedTag = async (view) => {
    store.dispatch("tagsView/delCachedView", view).then(async () => {
        const { path } = view;
        await nextTick(() => {
            router.replace({
                path: "/redirect" + path,
            });
        });
    });
};

const closeOthersTags = () => {
    router.push(selectedTag.value);
    store.dispatch("tagsView/delOthersViews", selectedTag.value).then(() => {
        moveToCurrentTag();
    });
};

const closeAllTags = (view) => {
    store.dispatch("tagsView/delAllViews");
    router.replace({
        path: "/redirect/dashboard",
    });
};
</script>
<style lang="scss" scoped>
.contextmenu {
    margin: 0;
    background: #fff;
    list-style-type: none;
    padding: 5px 0;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 400;
    color: #333;
    box-shadow: 2px 2px 3px 0 rgba(0, 0, 0, 0.3);
    li {
        margin: 0;
        padding: 7px 16px;
        cursor: pointer;
        &:hover {
            background: #eee;
        }
    }
}
</style>
