<template>
    <div class="tw-p-5">
        <q-table
            v-model:selected="selected"
            :title="$t(route.meta.title)"
            :rows="rows"
            :columns="columns"
            row-key="name"
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

            <template v-slot:body-cell-phones="props">
                <q-td :props="props">
                    <div v-for="item in props.value">
                        <q-icon name="phone" color="primary" />
                        {{ item.phone }}
                    </div>
                </q-td>
            </template>

            <template v-slot:body-cell-emails="props">
                <q-td :props="props">
                    <div v-for="item in props.value">
                        <q-icon name="email" color="primary" />
                        {{ item.email }}
                    </div>
                </q-td>
            </template>

            <template v-slot:body-cell-groups="props">
                <q-td :props="props">
                    <div v-for="item in props.value">
                        <q-icon name="groups" color="primary" />
                        {{ item.name }}
                    </div>
                </q-td>
            </template>

            <template v-slot:body-cell-companies="props">
                <q-td :props="props">
                    <div v-for="item in props.value">
                        <q-icon name="business" color="primary" />
                        {{ item.business_name }}
                    </div>
                </q-td>
            </template>

            <template v-slot:body-cell-charges="props">
                <q-td :props="props">
                    <div v-for="item in props.value">
                        <q-icon name="work" color="primary" />
                        {{ item.name }}
                    </div>
                </q-td>
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
    </div>
</template>
<script setup>
import { reactive, ref, onMounted } from "vue";
import { date } from "quasar";
import { useRoute } from "vue-router";
const rows = ref([]);
const filter = ref("");
const loading = ref(false);
const selected = ref([]);
const show = ref(false);
const route = useRoute();

const columns = [
    {
        name: "name",
        label: "tables.name",
        required: true,
        align: "left",
        field: "name",
        sortable: true,
    },
    {
        name: "last_name",
        label: "tables.last_name",
        required: true,
        align: "left",
        field: "last_name",
        sortable: true,
    },
    {
        name: "phones",
        label: "tables.phones",
        required: true,
        align: "left",
        field: "phones",
        sortable: false,
    },
    {
        name: "emails",
        label: "tables.emails",
        required: true,
        align: "left",
        field: "emails",
        sortable: false,
    },
    {
        name: "groups",
        label: "tables.groups",
        required: true,
        align: "left",
        field: "groups",
        sortable: false,
    },
    {
        name: "companies",
        label: "tables.companies",
        required: true,
        align: "left",
        field: "companies",
        sortable: false,
    },
    {
        name: "charges",
        label: "tables.charges",
        required: true,
        align: "left",
        field: "charges",
        sortable: false,
    },
    {
        name: "created_at",
        label: "tables.created",
        align: "center",
        field: "created_at",
        sortable: true,
        format: (val) => date.formatDate(val, "MMMM DD, YYYY"),
    },
    {
        name: "updated_at",
        label: "tables.updated",
        align: "center",
        field: "updated_at",
        sortable: true,
        format: (val) => date.formatDate(val, "MMMM DD, YYYY"),
    },
];
const pagination = ref({
    sortBy: "id",
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
        .get("/api/contact", {
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
    selected.value.push(row);
    show.value = true;
}
</script>
