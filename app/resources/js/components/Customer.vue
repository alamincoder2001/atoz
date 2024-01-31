<template>
    <div>
        <div class="col-12 col-lg-12" style="overflow-x: auto">
            <vue-good-table :columns="columns" :rows="customers" :fixed-header="true" :pagination-options="{
                enabled: true,
                perPage: 15,
            }" :search-options="{ enabled: true }" :line-numbers="true" styleClass="vgt-table" max-height="550px">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'before'">
                        <button v-if="props.row.customer_type == 'Wholesale'" class="btn btn-sm text-white shadow-none"
                            :class="props.row.status == 'p' ? 'btn-warning' : 'btn-success'" @click="editRow(props.row)">
                            {{ props.row.status == 'p' ? 'Pending' : 'Approved' }}
                        </button>
                        <button class="btn btn-sm btn-outline-success shadow-none" @click="Show(props.row)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger shadow-none" @click="deleteRow(props.row.id)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </span>
                </template>
            </vue-good-table>
        </div>

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body" style="padding: 45px;">
                        <showCustomer :customer-row="customerData"></showCustomer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import showCustomer from "../components/showCustomer.vue"
export default {
    components: { 'showCustomer': showCustomer },
    data() {
        return {
            link: location.origin + "/admin/customer/show/",
            columns: [
                {
                    label: "Customer Code",
                    field: "customer_code",
                },
                {
                    label: "Name",
                    field: "name",
                },
                {
                    label: "Mobile",
                    field: "mobile",
                },
                {
                    label: "Email",
                    field: "email",
                },
                {
                    label: "Customer Type",
                    field: "customer_type",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            customers: [],
            customerData: {},
        };
    },

    created() {
        this.getCustomer();
    },

    methods: {
        getCustomer() {
            axios.get(location.origin + "/admin/customer/fetch")
                .then(res => {
                    this.customers = res.data
                })
        },

        editRow(rowData) {
            rowData.setStatus = rowData.status == 'p' ? 'a' : 'p'
            if (confirm("Are you sure want to approved this")) {
                axios.post(location.origin + "/admin/customer/status", rowData)
                    .then(res => {
                        $.notify(res.data, "success");
                        this.getCustomer();
                    })
            }
        },

        Show(row) {
            this.customerData = row
            $("#staticBackdrop").modal("show");
        },

        deleteRow(rowId) {
            if (confirm("Are you sure want to delete this")) {
                axios.get(location.origin + "/admin/customer/delete/" + rowId)
                    .then(res => {
                        $.notify(res.data, "success");
                        this.getCustomer();
                    })
            }
        },
    },
};
</script>
