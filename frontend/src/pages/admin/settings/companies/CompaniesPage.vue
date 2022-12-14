<template>
    <div class="tw-p-5">
        <q-table
            v-model:selected="selected"
            :title="$t(route.meta.title)"
            :rows="rows"
            :columns="columns"
            row-key="id"
            @row-dblclick="onRowClick"
            v-model:pagination="pagination"
            :loading="loading"
            :filter="filter"
            @request="onRequest"
            class="my-sticky-header-table"
            :title-class="'tw-text-4xl tw-text-primary text-weight-bolder'"
            color="black"
            card-class="tw-p-4"
        >
            <template v-slot:header="props">
                <q-tr :props="props" class="tw-bg-primary">
                    <q-th
                        v-for="col in props.cols"
                        :key="col.name"
                        :props="props"
                    >
                        <span
                            class="tw-font-bold tw-text-sm text-white"
                            v-text="$t(col.label)"
                        />
                    </q-th>
                </q-tr>
            </template>

            <template v-slot:top-right>
                <div class="tw-pr-10">
                    <q-btn
                        outline
                        color="primary"
                        class="text-capitalize"
                        :label="$t('buttons.add')"
                        ripple
                        style="width: 100px"
                        @click="(show = true), (datas = [])"
                    />
                </div>

                <q-input
                    debounce="500"
                    v-model="filter"
                    :label="$t('inputs.search')"
                    hide-hint
                    clearable
                    autogrow
                    class="border-b-1 border-gray-200"
                >
                    <template v-slot:prepend>
                        <q-icon size="1.2em" color="primary" name="search" />
                    </template>
                </q-input>
            </template>

            <template v-slot:no-data="{ icon, message, filter }">
                <div class="tw-w-full row flex-center tw-py-10">
                    <q-icon
                        v-if="!loading"
                        size="3em"
                        name="warning"
                        class="tw-text-negative"
                    />
                    <q-icon v-else size="3em" name="find_in_page" />
                    <span
                        class="tw-text-xl tw-pl-"
                        v-text="message"
                        :class="{ 'tw-text-negative': !loading }"
                    />
                </div>
            </template>
        </q-table>
        <FormCompanyComponent
            v-if="show"
            @update:show="(newValue) => (show = newValue)"
            @clean="selected = []"
            :datas="selected"
        />
    </div>
</template>
<script setup>
import FormCompanyComponent from "./components/FormCompanyComponent.vue";
import { reactive, ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const rows = ref([]);
const filter = ref("");
const loading = ref(false);
const selected = ref([]);
const show = ref(false);
const route = useRoute();

const columns = [
    {
        name: "groups.name",
        label: "tables.group",
        align: "left",
        field: "group",
        sortable: true,
    },
    {
        name: "companies.business_name",
        label: "tables.business_name",
        required: true,
        align: "left",
        field: "business_name",
        sortable: true,
    },
    {
        name: "companies.rfc",
        label: "tables.rfc",
        align: "left",
        field: "rfc",
        sortable: true,
    },
    {
        name: "companies.webpage",
        label: "tables.webpage",
        align: "left",
        field: "webpage",
        sortable: true,
    },
    {
        name: "companies.observations",
        label: "tables.observations",
        align: "left",
        field: "observations",
        sortable: false,
    },
];
const pagination = ref({
    sortBy: "companies.id",
    descending: false,
    page: 1,
    rowsPerPage: 15,
    rowsNumber: 0,
});

onMounted(async () => {
    // get initial data from server (1st page)
    onRequest({
        pagination: pagination.value,
        filter: undefined,
    });
});

const onRequest = async (props) => {
    loading.value = true;
    const { page, rowsPerPage, sortBy, descending } = props.pagination;

    let params = {
        search: filter.value,
        sortBy: sortBy,
        sortType: sortBy ? (descending ? "desc" : "asc") : "asc",
        page: page,
        per_page: rowsPerPage,
    };
    const { data } = await axios
        .get("/api/company", {
            params: params,
        })
        .catch(function (error) {});

    rows.value = data.data.data;
    pagination.value.rowsNumber = data.data.total;
    pagination.value.page = data.data.current_page;
    pagination.value.rowsPerPage = rowsPerPage;
    pagination.value.sortBy = sortBy;
    pagination.value.descending = descending;

    loading.value = false;
};

function onRowClick(evt, row) {
    console.log(
        "???? ~ file: CompaniesPage.vue ~ line 184 ~ onRowClick ~ row",
        row
    );
    selected.value.push(row);
    show.value = true;
}
</script>
