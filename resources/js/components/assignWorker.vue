<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form @submit.prevent="getOrder">
                        <div class="row">
                            <div class="col-6 col-md-2 mb-1" v-if="role != 'manager'"
                                :class="role != 'manager' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="searchBy" @change="onChangeSearch">
                                        <option value="">All</option>
                                        <option value="thana">Area Wise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-1" v-if="searchBy == 'thana'"
                                :class="searchBy == 'thana' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="thanas" :options="thanas" v-model="selectedThana" label="name"></v-select>
                                </div>
                            </div>
                            <!-- <div class="col-6 col-md-2 mb-1">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="filter.status">
                                        <option value="">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="complete">Completed</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-6 col-md-2 mb-1">
                                <div class="form-group m-0">
                                    <input type="date" class="form-control" v-model="filter.dateFrom" />
                                </div>
                            </div>
                            <div class="col-6 col-md-2 mb-1">
                                <div class="form-group m-0">
                                    <input type="date" class="form-control" v-model="filter.dateTo" />
                                </div>
                            </div>
                            <div class="col-6 col-md-1 mb-1">
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-info btn-sm shadow-none px-3">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body" v-if="orders.length > 0">
                    <table class="table table-bordered m-0">
                        <thead style="background: #59d9ff">
                            <tr>
                                <th style="text-align: center; width: 8%;color:white;"> Sl </th>
                                <th style="text-align: center;color:white;"> Customer </th>
                                <th style="text-align: center;color:white;">Status</th>
                                <th style="text-align: center;color:white;">Service</th>
                                <th style="text-align: center;color:white;">Quantity</th>
                                <th style="text-align: center;color:white;">Bill</th>
                                <th style="text-align: center;color:white;">Paid</th>
                                <th style="text-align: center;color:white;">Due</th>
                                <th style="text-align: center;color:white;">Worker</th>
                                <th style="text-align: center; width: 10%;color:white;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in orders">
                                <tr>
                                    <td class="text-center" style="width: 5%"> {{ index + 1 }} </td>
                                    <td class="text-center"> {{ item.customer_name }} </td>
                                    <td class="text-center text-capitalize" v-html="statusText(item.status)"></td>
                                    <td class="text-center">{{ item.service_name }}</td>
                                    <td class="text-center">{{ item.quantity }}</td>
                                    <td class="text-center">{{ item.bill_amount }}</td>
                                    <td class="text-center">{{ item.paid_amount }}</td>
                                    <td class="text-center">{{ item.due }}</td>
                                    <td class="text-center">{{ item.worker_name }}</td>
                                    <td>
                                        <div class="input-group gap-2 justify-content-center">
                                            <button v-if="item.status == 'pending'"
                                                @click="statusChange(item.id, 'proccess')" type="button"
                                                style="padding: 5px;" class="btn btn-xs btn-warning shadow-none text-white">
                                                <i class="fas fa-check-square"></i>
                                            </button>
                                            <button v-if="item.status == 'proccess'" @click="showModal(item.id)"
                                                type="button" style="padding: 5px;"
                                                class="btn btn-xs btn-success shadow-none text-white"> <i
                                                    class="fas fa-spinner"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div class="card-body" :style="{ display: orders.length > 0 ? 'none' : '' }">
                    <p class="m-0 text-center">Not Found Data in Table</p>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Worker Deal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billAmount">Bill Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="billAmount"
                                        @input="calculateTotal" name="billAmount" v-model="calculate.billAmount" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paidAmount">Paid Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="paidAmount"
                                        @input="calculateTotal" name="paidAmount" v-model="calculate.paidAmount" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="dueAmount">Due Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="dueAmount"
                                        name="dueAmount" v-model="calculate.dueAmount" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" @click="statusChange" class="btn btn-success text-white">Completed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    data() {
        return {
            props: [
                'admin_id',
                'role'
            ],
            searchBy: "",
            filter: {
                status: "",
                dateFrom: "",
                dateTo: "",
            },
            calculate: {
                billAmount: 0,
                paidAmount: 0,
                dueAmount: 0,
            },
            orders: [],
            thanas: [],
            selectedThana: null,

            adminId: "",
            role: "",
        };
    },

    created() {
        this.getOrder();
        this.getThana();
        this.adminId = this.$attrs.admin_id
        this.role = this.$attrs.role
    },

    methods: {
        statusText(status) {
            let texT = "";
            if (status == 'pending') {
                texT = "<span class='badge bg-danger'>pending</span>"
            }
            if (status == 'proccess') {
                texT = "<span class='badge bg-warning'>Proccessing</span>"
            }

            return texT;
        },
        calculateTotal() {
            if (parseFloat(this.calculate.paidAmount) > parseFloat(this.calculate.billAmount)) {
                this.calculate.paidAmount = this.calculate.billAmount
                return;
            }
            this.calculate.dueAmount = parseFloat(parseFloat(this.calculate.billAmount) - parseFloat(this.calculate.paidAmount)).toFixed(2);
        },
        getThana() {
            axios.get("/admin/thana/fetch").then((res) => {
                this.thanas = res.data.data;
            });
        },
        onChangeSearch() {
            this.selectedThana = null;
        },
        getOrder() {
            this.filter.thanaId = this.selectedThana == null ? null : this.selectedThana.id

            axios.post("/admin/get-orderDetails", this.filter).then((res) => {
                this.orders = res.data.msg;
            });
        },

        statusChange(id = null, status = null) {
            if (confirm("Are you sure!")) {
                if (status == 'proccess') {
                    this.calculate.id = id;
                    this.calculate.status = status;
                }
                axios.post("/admin/worker/assignwork-status-change", this.calculate).then((res) => {
                    $.notify(res.data.msg, "success");
                    if (this.calculate.status == 'complete') {
                        $("#staticBackdrop").modal('hide');
                    }
                    this.clearData();
                    this.getOrder();
                });
            }
        },

        showModal(id) {
            $("#staticBackdrop").modal('show');
            this.calculate.id = id;
            this.calculate.status = 'complete';
        },

        formatDate(date) {
            return moment(date).format("DD-MM-YYYY");
        },

        clearData() {
            this.calculate = {
                billAmount: 0,
                paidAmount: 0,
                dueAmount: 0,
            }
        },
    },
};
</script>

<style>
#thanas [role="combobox"] {
    padding: 0 !important;
}
</style>
