<template>
    <div>
        <metainfo>
            <template v-slot:title="{ content }">
                {{
                    content
                        ? `${content} | ${defaultSettings.companyName}`
                        : defaultSettings.companyName
                }}
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
import { computed, inject } from "vue";
import { useRoute } from "vue-router";
import workerService from "@/services/workerService";
import defaultSettings from "@/services/settings";

const route = useRoute();

workerService();

useMeta({
    title: "",
    htmlAttrs: { lang: "es", amp: true },
});

const layout = computed(() => {
    return route.meta.layout || PublicLayout;
});
</script>
