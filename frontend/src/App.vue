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
import { useStore } from "vuex";

const route = useRoute();
const store = useStore();

workerService();

useMeta({
    title: "",
    htmlAttrs: { lang: store.getters.lang, amp: true },
});

const layout = computed(() => {
    return route.meta.layout || PublicLayout;
});
</script>
