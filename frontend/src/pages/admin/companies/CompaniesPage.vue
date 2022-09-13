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
                    borderless
                    dense
                    debounce="300"
                    v-model="filter"
                    placeholder="Search"
                >
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
        </q-table>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";

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

export default {
    setup() {
        const rows = ref([]);
        const filter = ref("");
        const loading = ref(false);
        const pagination = ref({
            sortBy: "desc",
            descending: false,
            page: 1,
            rowsPerPage: 3,
            rowsNumber: 10,
        });

        async function onRequest(props) {
            const { page, rowsPerPage, sortBy, descending } = props.pagination;

            loading.value = true;

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
            console.log(
                "🚀 ~ file: CompaniesPage.vue ~ line 84 ~ loadDatas ~ data.data",
                data.data
            );
            rows.value = data.data.data;
            pagination.value.rowsNumber = data.data.total;
            pagination.value.page = data.data.current_page;
            pagination.value.rowsPerPage = pagination.value.rowsPerPage;
            /*

            pagination.value.sortBy = sortBy;
            pagination.value.descending = descending; */
            loading.value = false;
        }

        onMounted(() => {
            // get initial data from server (1st page)
            onRequest({
                pagination: pagination.value,
                filter: undefined,
            });
        });

        return {
            filter,
            loading,
            pagination,
            columns,
            rows,

            onRequest,
        };
    },
};
</script>
