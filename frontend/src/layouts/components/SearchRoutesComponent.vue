<template>
    <div class="q-mx-sm flex">
        <q-btn flat round color="white" @click="click">
            <q-icon size="lg" name="search" />
        </q-btn>
        <q-slide-transition>
            <div v-if="show">
                <q-select
                    v-model="model"
                    ref="headerSearchSelect"
                    use-input
                    input-debounce="0"
                    :options="options"
                    color="white"
                    dense
                    label="search"
                    label-color="white"
                    hide-bottom-space
                    :clearable="true"
                    @blur="show = false"
                    @filter="filterFn"
                    emit-value
                    :input-style="{ color: '#fff' }"
                    :menu-offset="[0, 8]"
                >
                    <template v-slot:no-option>
                        <q-item>
                            <q-item-section class="text-grey">
                                No results
                            </q-item-section>
                        </q-item>
                    </template>

                    <template v-slot:option="scope">
                        <q-item
                            v-bind="scope.itemProps"
                            class="row items-center"
                        >
                            <q-icon size="xs" :name="scope.opt.icon" />
                            <q-item-section
                                class="q-pl-md"
                                v-text="scope.opt.label.join(' > ')"
                            />
                        </q-item>
                    </template>
                </q-select>
            </div>
        </q-slide-transition>
    </div>
</template>
<script setup>
import { reactive, ref, onMounted, computed, watch } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

const store = useStore();
const router = useRouter();
const model = ref(null);
const show = ref(false);
const options = ref();
const headerSearchSelect = ref(null);
const items = reactive({});

const routes = computed(() => {
    return store.getters.permission_routes;
});

onMounted(async () => {
    items.routes = generateRoutes(routes.value);
});

watch(model, (val) => {
    if (val != null) {
        router.push(val);
        model.value = null;
        show.value = false;
    }
});

const filterFn = (val, update, abort) => {
    if (val.length < 2) {
        abort();
        return;
    }
    update(() => {
        const needle = val.toLowerCase();
        options.value = items.routes.filter(
            (v) => v.value.toLowerCase().indexOf(needle) > -1
        );
    });
};

const click = () => {
    show.value = !show.value;
    if (show.value) {
        setTimeout(() => {
            headerSearchSelect.value && headerSearchSelect.value.focus();
        }, 300);
    }
};

const generateRoutes = (routes, basePath = null, prefixTitle = []) => {
    let res = [];
    for (const router of routes) {
        // skip hidden router
        if (router.hidden) {
            continue;
        }

        const data = {
            // value: router.path,
            value: basePath ? basePath + "/" + router.path : router.path,
            label: [...prefixTitle],
            icon: router.meta.icon,
        };

        if (router.meta && router.meta.title && !router.noSearch) {
            if (router.redirect !== "noRedirect") {
                // only push the routes with title
                // special case: need to exclude parent router without redirect
                data.label = [...data.label, router.meta.title];

                if (router.redirect !== "noRedirect") {
                    // only push the routes with title
                    // special case: need to exclude parent router without redirect
                    res.push(data);
                }
            }
        }

        // recursive child routes

        if (router.children) {
            const tempRoutes = generateRoutes(
                router.children,
                data.value,
                data.label
            );
            if (tempRoutes.length >= 1) {
                res = [...res, ...tempRoutes];
            }
        }
    }
    return res;
};
</script>
<style lang="scss" scoped>
.input_style {
    padding-top: 10px !important;
}

.inputStyle {
    color: white;
}
</style>
