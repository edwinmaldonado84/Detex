<template>
    <q-select
        v-model="model"
        :options="options"
        :label="$t('inputs.company')"
        option-label="name"
        option-value="id"
        :loading="loading"
        :disable="props.dependent && props.groupId == 0"
        @filter="filterFn"
        input-debounce="100"
        use-input
    >
        <template v-slot:before>
            <q-icon name="business" />
        </template>
        <template v-slot:no-option>
            <q-item>
                <q-item-section
                    class="tw-text-red-600"
                    v-text="$t('errors.no_result')"
                />
            </q-item>
        </template>
    </q-select>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";

const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    dependent: {
        type: Boolean,
        default: false,
    },
    groupId: {
        type: Number,
        default: 0,
    },
});

const model = ref(null);
const loading = ref(false);
const items = ref(null);
const options = ref();

onMounted(() => {
    load();
});

watch(
    props,
    (value) => {
        model.value = null;
        if (value.groupId) {
            load();
        }
    },
    {
        deep: true,
        immediate: true,
    }
);

watch(
    model,
    (value) => {
        emit("update:modelValue", value);
    },
    {
        immediate: true,
    }
);

const load = async () => {
    loading.value = true;

    let params = {
        sortBy: "name",
        groupId: props.groupId,
        paginate: "no",
    };
    const { data } = await axios
        .get("/api/company", {
            params: params,
        })
        .catch(function (error) {});

    items.value = data.data;

    loading.value = false;
};

const filterFn = (val, update, abort) => {
    update(() => {
        const needle = val.toLowerCase();
        options.value = items.value.filter((item) => {
            return item.name.toLowerCase().includes(needle);
        });
    });
};
</script>
