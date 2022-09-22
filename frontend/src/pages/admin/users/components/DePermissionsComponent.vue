<template>
    <q-dialog v-model="show" transition-show="rotate" transition-hide="rotate">
        <q-card style="width: 500px; max-width: 90vw">
            <q-card-section
                class="flex items-center q-py-sm bg-primary q-px-lg"
            >
                <q-icon size="md" class="text-white tw-pr-2" name="lock" />
                <div
                    class="tw-text-2xl text-white"
                    v-text="$t('tables.permissions')"
                />
                <q-space />
                <q-btn outline color="white" icon="close" v-close-popup />
            </q-card-section>

            <q-separator />

            <q-card-section
                style="max-height: 50vh"
                class="scroll tw-py-10 tw-px-5"
            >
                <q-chip
                    v-if="datas.length > 0"
                    v-for="item in datas"
                    :key="item"
                    outline
                    color="primary"
                    text-color="white"
                    icon-right="lock"
                    v-text="item"
                />
                <div
                    v-else
                    class="tw-text-negative text-center tw-text-lg"
                    v-text="$t('errors.there_are_not_permissions')"
                />
            </q-card-section>
        </q-card>
    </q-dialog>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";

const props = defineProps({
    datas: Object || String,
});

const show = ref(true);
const emit = defineEmits(["clean", "update:show"]);

watch(show, (val) => {
    if (!val) {
        emit("clean");
        emit("update:show", false);
    }
});
onMounted(() => {
    console.log("in", props.datas);
});
</script>
