<template>
    <div class="q-pa-md">
        <q-table
            v-model:selected="selected"
            title="Groups"
            :rows="rows"
            :columns="columns"
            row-key="name"
            @row-dblclick="onRowClick"
            v-model:pagination="pagination"
            :loading="loading"
            :filter="filter"
            @request="onRequest"
            class="my-sticky-header-table"
            :title-class="'text-h3 text-primary text-weight-bolder'"
            color="black"
            :card-style="{ padding: '20px' }"
            table-header-class="bg-primary text-white text-h4"
            card-style="{ padding: '20px' }"
        >
            <template v-slot:header="props">
                <q-tr :props="props" class="bg-primary text-white text-h4">
                    <q-th
                        v-for="col in props.cols"
                        :key="col.name"
                        :props="props"
                        v-text="$t(col.label)"
                    />
                </q-tr>
            </template>

            <template v-slot:top-right>
                <div class="q-pr-lg">
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
                    dense
                    v-model="filter"
                    :label="$t('inputs.search')"
                    hide-hint
                    clearable
                    autogrow
                    :input-style="{ fontSize: '1.1rem', width: '400px' }"
                    label-color="primary"
                    color="primary"
                >
                    <template v-slot:prepend>
                        <q-icon size="1.2em" color="primary" name="search" />
                    </template>
                </q-input>
            </template>

            <template v-slot:no-data="{ icon, message, filter }">
                <div class="full-width row flex-center q-gutter-sm q-py-lg">
                    <q-icon
                        v-if="!loading"
                        size="3em"
                        name="warning"
                        class="text-negative"
                    />
                    <q-icon v-else size="3em" name="find_in_page" />
                    <span
                        class="text-h5"
                        v-text="message"
                        :class="{ 'text-negative': !loading }"
                    />
                </div>
            </template>
        </q-table>
    </div>
</template>
<script setup>
import { reactive, ref, onMounted } from "vue";
import { date } from "quasar";
const rows = ref([]);
const filter = ref("");
const loading = ref(false);
const selected = ref([]);
const show = ref(false);

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
        .get("/api/group", {
            params: params,
        })
        .catch(function (error) {});

    rows.value = data.data.data;
    pagination.value.rowsNumber = data.data.total;
    pagination.value.page = data.data.current_page;
    pagination.value.rowsPerPage = pagination.value.rowsPerPage;
    pagination.value.sortBy = sortBy;
    pagination.value.descending = descending;

    // pagination.value.sortBy = sortBy;
    // pagination.value.descending = descending;

    loading.value = false;
};

function onRowClick(evt, row) {
    selected.value.push(row);
    show.value = true;
}
</script>
<style lang="sass">
.my-sticky-header-table
    max-height: 86vh
    thead tr th
        position: sticky
        z-index: 1
        font-size: 1.1rem !important
    thead tr:first-child th
        top: 0
    .q-table__linear-progress
        height: 4px
.selected
    background-color: $accent
</style>
