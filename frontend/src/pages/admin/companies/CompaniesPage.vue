<template>
    <div class="q-pa-md">
        <q-table
            title="Treats"
            :rows="rows"
            :columns="columns"
            row-key="id"
            v-model:pagination="pagination"
            :loading="loading"
            :filter="filter"
            @request="onRequest"
            binary-state-sort
        >
            <template v-slot:top-right>
                <q-input
                    dense
                    debounce="500"
                    v-model="filter"
                    label="Search"
                    hide-hint
                    clearable
                    autogrow
                    style="width: 400px"
                >
                    <template v-slot:prepend>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
        </q-table>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const rows = ref([]);
const filter = ref("");
const loading = ref(false);

const columns = [
    {
        name: "name",
        label: "Company",
        required: true,
        align: "left",
        field: "name",
        sortable: true,
    },
    {
        name: "Rfc",
        label: "Rfc",
        align: "center",
        field: "rfc",
        sortable: true,
    },
    { name: "Phone", label: "Phone", field: "phone", sortable: true },
    { name: "Address", label: "Address", field: "address" },
    { name: "Owner", label: "Owner", field: "owner" },
];
const pagination = ref({
    sortBy: "desc",
    descending: false,
    page: 1,
    rowsPerPage: 15,
    rowsNumber: 0,
});

const onRequest = async (props) => {
    loading.value = true;
    const { page, rowsPerPage, sortBy, descending } = props.pagination;
    let params = {
        name: filter.value,
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

onMounted(async () => {
    // get initial data from server (1st page)
    onRequest({
        pagination: pagination.value,
        filter: undefined,
    });
});
</script>
