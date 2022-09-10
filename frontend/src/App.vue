<template>
    <div>
        <metainfo>
            <template v-slot:title="{ content }">
                {{ content ? `${content} | ${siteName}` : siteName }}
            </template>
        </metainfo>
        <component :is="layout">
            <router-view />
        </component>
    </div>
</template>

<script setup>
import PublicLayout from "@/layouts/PublicLayout.vue";

import { useMeta } from "vue-meta";
import { computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const siteName = "Detex";

useMeta({
    title: "",
    htmlAttrs: { lang: "es", amp: true },
});

const layout = computed(() => {
    return route.meta.layout || PublicLayout;
});
</script>
