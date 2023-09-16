<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveBank">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="bank_name" class="col-5 col-lg-4 d-flex align-items-center">Bank
                                        Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="bank_name" v-model="bank.bank_name"
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="account_name" class="col-5 col-lg-4 d-flex align-items-center">Account
                                        Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="account_name" v-model="bank.account_name"
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="account_number" class="col-5 col-lg-4 d-flex align-items-center">Account
                                        Number:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="account_number" v-model="bank.account_number"
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="branch_name" class="col-5 col-lg-4 d-flex align-items-center">Branch
                                        Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="branch_name" v-model="bank.branch_name"
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="status" class="col-5 col-lg-4 d-flex align-items-center">Account
                                        Number:</label>
                                    <div class="col-7 col-lg-8">
                                        <select id="status" v-model="bank.status" class="form-select shadow-none">
                                            <option value="a">Active</option>
                                            <option value="d">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="previous_due" class="col-5 col-lg-4 d-flex align-items-center"></label>
                                    <div class="col-7 col-lg-8 text-end">
                                        <button type="button" @click="clearData"
                                            class="btn btn-sm btn-outline-secondary shadow-none">
                                            Reset
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-outline-success shadow-none">
                                            Save Bank
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12" style="overflow-x: auto">
            <vue-good-table :columns="columns" :rows="banks" :fixed-header="true" :pagination-options="{
                enabled: true,
                perPage: 15,
            }" :search-options="{ enabled: true }" :line-numbers="true" styleClass="vgt-table" max-height="550px">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'before'">
                        <button class="btn btn-sm btn-outline-primary px-3 shadow-none" @click="editRow(props.row)">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-outline-danger shadow-none" @click="deleteRow(props.row.id)">
                            Delete
                        </button>
                    </span>
                </template>
            </vue-good-table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            columns: [
                {
                    label: "Bank Name",
                    field: "bank_name",
                },
                {
                    label: "Account Name",
                    field: "account_name",
                },
                {
                    label: "Account Number",
                    field: "account_number",
                },
                {
                    label: "Branch Name",
                    field: "branch_name",
                },
                {
                    label: "Status",
                    field: "status_text",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            bank: {
                id: "",
                bank_name: "",
                account_name: "",
                account_number: "",
                branch_name: "",
                status: "a",
            },
            banks: [],
        };
    },

    created() {
        this.getBank();
    },

    methods: {
        getBank() {
            axios.get(location.origin + "/admin/bank/fetch").then((res) => {
                this.banks = res.data.data;
            });
        },

        saveBank() {
            axios.post(location.origin + "/admin/bank", this.bank)
                .then(res => {
                    $.notify(res.data, "success");
                    this.getBank();
                    this.clearData();
                });
        },

        editRow(val) {
            this.bank = val
        },

        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post(location.origin + "/admin/bank/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getBank();
                });
            }
        },

        clearData() {
            this.bank = {
                id: "",
                bank_name: "",
                account_name: "",
                account_number: "",
                branch_name: "",
                status: "a",
            }
        },
    },
};
</script>
