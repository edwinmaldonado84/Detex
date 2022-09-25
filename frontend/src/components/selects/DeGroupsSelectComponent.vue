<template>
    <q-select
        v-model="model"
        :options="items"
        :label="$t('inputs.group')"
        option-label="name"
        option-value="id"
        :loading="loading"
    >
        <template v-slot:no-option>
            <q-item>
                <q-item-section
                    class="tw-text-red-600"
                    v-text="$t('errors.no_results')"
                />
            </q-item>
        </template>
    </q-select>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";

const emit = defineEmits(["update:modelValue"]);
const model = ref(null);
const loading = ref(true);
const items = ref(null);

onMounted(() => {
    load();
});

watch(
    model,
    (value) => {
        emit("update:modelValue", value);
    },
    {
        immediate: true,
    }
);

const load = async (props) => {
    loading.value = true;

    let params = {
        sortBy: "name",
        paginate: "no",
    };
    const { data } = await axios
        .get("/api/group", {
            params: params,
        })
        .catch(function (error) {});

    items.value = data.data;

    loading.value = false;
};
</script>
