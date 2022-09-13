<template>
    <div class="q-px-md">
        <q-table
            v-model:selected="selected"
            title="Companies"
            :rows="rows"
            :columns="columns"
            row-key="id"
            v-model:pagination="pagination"
            :loading="loading"
            :filter="filter"
            @request="onRequest"
            binary-state-sort
            class="my-sticky-header-table"
            :title-class="'text-h3 text-primary text-weight-bolder'"
            color="black"
            selection="single"
            :card-style="{ padding: '20px' }"
        >
            <template v-slot:top-right>
                <div class="q-pr-lg">
                    <q-btn
                        outline
                        color="primary"
                        class="text-capitalize"
                        label="New"
                        ripple
                        style="width: 100px"
                    />
                </div>
                <q-input
                    debounce="500"
                    dense
                    v-model="filter"
                    label="Search"
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

            <template v-slot:header="props">
                <q-tr :props="props">
                    <q-th
                        v-for="col in props.cols"
                        :key="col.name"
                        :props="props"
                    >
                        <span
                            class="text-white text-subtitle1 text-weight-bolder"
                            v-text="col.label"
                        />
                    </q-th>
                </q-tr>
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

            <template v-slot:body="props">
                <q-tr
                    :props="props"
                    @click.native="props.selected = !props.selected"
                >
                    <q-td
                        v-for="col in props.cols"
                        :key="col.name"
                        :props="props"
                    >
                        {{ col.value }}
                    </q-td>
                </q-tr>
            </template>
        </q-table>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const rows = ref([]);
const filter = ref("");
const loading = ref(false);
const selected = ref([]);

const columns = [
    {
        name: "name",
        label: "Name",
        required: true,
        align: "left",
        field: "name",
        sortable: true,
    },
    {
        name: "Rfc",
        label: "Rfc",
        align: "left",
        field: "rfc",
        sortable: true,
    },
    {
        name: "Phone",
        label: "Phone",
        align: "center",
        field: "phone",
        sortable: true,
    },
    { name: "Address", label: "Address", align: "left", field: "address" },
    { name: "Owner", label: "Owner", align: "left", field: "owner" },
];
const pagination = ref({
    sortBy: "desc",
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
        // sortBy: sortBy,
        // sortDesc: sortDesc,
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
    pagination.value.rowsPerPage = pagination.value.rowsPerPage;

    // pagination.value.sortBy = sortBy;
    // pagination.value.descending = descending;

    loading.value = false;
};

const selectEvent = (evt, row, index) => {
    console.log("event");
};
</script>
<style lang="sass">
.my-sticky-header-table
    max-height: 88vh
    .q-tr.selected
        background-color: $accent
        .q-td
            color: white !important
            font-weight: 800
    .q-tr
        cursor: pointer
        /* height or max-height is important */
    .q-table__top,
    .q-table__bottom,
    thead tr:first-child th
    /* bg color is important for th; just specify one */
    // background-color: $primary
    thead tr th
        position: sticky
        z-index: 1
        background-color: $primary
    thead tr:first-child th
        top: 0
    .q-table__linear-progress
        height: 4px
</style>
