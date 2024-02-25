<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.vs__selected-options {
    flex-wrap: nowrap;
    overflow: hidden;
}

.vs--single .vs__selected {
    position: absolute;
    font-size: 12px;
    font-weight: 900;
    color: #878787;
}

.vs__search {
    border: 0 !important;
    border-left: none;
    box-shadow: none;
    line-height: normal !important;
}
</style>

<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveCommission">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Payment Type<span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group mb-2">
                                            <select class="form-select shadow-none" v-model="form.payment_type">
                                                <option value="">---select---</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Bank">Bank</option>
                                                <option value="bKash">bKash</option>
                                                <option value="Nagad">Nagad</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Manager<span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group mb-2">
                                            <v-select :options="managers" v-model="selectedManager" label="display_name"
                                                @input="onChangeManager"></v-select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Payable Amount<span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group mb-2">
                                            <input type="text" v-model="form.managerDue" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="pe-0">Payment Date<span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" v-model="form.payment_date" class="form-control mb-2">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="pe-0">Amount<span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" step="0.01" min="0" v-model="form.amount" class="form-control mb-2">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Note</label>
                                    </div>
                                    <div class="col-md-8 mb-2">
                                        <input type="text" v-model="form.note" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group row text-end">
                                    <label for="save" class="col-md-3"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-success text-light shadow-none">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- list of category -->
        <div class="col-md-12" style="overflow-x: auto">

            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <a href="" @click.prevent="print" style="color: #3e5569;" v-if="managerPayments.length > 0">
                                <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                                Print
                            </a>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5"></div>

                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <h4 class="page-title" style="float: right;color: #3e5569;">Manager Payment List</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="printThis">
                    <table v-if="managerPayments.length > 0" class="table table-bordered m-0 record-table">
                        <thead style="background: gray">
                            <tr>
                                <th class="text-white" style="font-weight: bold; width: 5%">
                                    Sl
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Tran.Id
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Payment Type
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Payment Date
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Amount
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Manager
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Given By
                                </th>
                                <th class="text-white text-end" style="font-weight: bold">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in managerPayments" :key="item.id">
                                <td>{{ ++index }}</td>
                                <td>{{ item.transaction_id }} </td>
                                <td>{{ item.payment_type }} </td>
                                <td>{{ item.payment_date }} </td>
                                <td>{{ item.amount }}</td>
                                <td>{{ item.manager?.name }} </td>
                                <td>{{ item.receive_by?.name }} </td>

                                <td class="text-end">
                                    <a href="javascript:void(0)" @click="commissionReceive(item.id)" class="btn shadow-none"
                                        title="manager Commission Report">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <a href="javascript:void(0)" @click.prevent="deleteRow(item.id)">
                                        <i class="fas fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center">Not Found Data</div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import moment from "moment";
export default
    {
        data() {
            return {
                linkHref: location.origin,
                form: new Form({
                    id: "",
                    payment_type: "Cash",
                    amount: 0,
                    managerDue: 0,
                    payment_date: moment().format('YYYY-MM-DD'),
                    note: "",
                    manager_id: '',
                    last_payment: 0,
                }),

                managerPayments: [],
                managers: [],
                selectedManager: null,
            }
        },

        created() {
            this.getManagers();
            this.getCommissionPayment();
        },

        methods: {

            getManagers() {
                axios.get("/admin/get-manager")
                    .then(res => {
                        this.managers = res.data.manager.map(item => {
                            item.commission = parseFloat(item.commission);
                            item.display_name = `${item.name} - ${item.phone} - (${item.commission}%)`;
                            return item;
                        })
                    })
            },
            getCommissionPayment() {
                axios.post("/admin/get-manager-payment")
                    .then(res => {
                        this.managerPayments = res.data.paymentCollections
                    })
            },

            onChangeManager() {
                if (this.selectedManager != null) {
                    this.form.managerDue = this.selectedManager.dueAmount;
                }else{
                    this.form.managerDue = 0;
                }
            },

            saveCommission() {
                if (this.selectedManager == null || this.selectedManager == '' || this.selectedManager == undefined) {
                    alert("Select Manager")
                    return
                }

                if (this.form.payment_type == null || this.form.payment_date == '' || this.form.payment_date == undefined) {
                    alert("Select Payment Type")
                    return
                }

                this.form.manager_id = this.selectedManager.id;

                let url = "/admin/manager/commission-store";
                if (this.form.id != '') {
                    url = "/admin/manager/update/commission-store";
                }
                this.form.post(url).then(res => {

                    if (res.data.error) {
                        $.notify(res.data.error, "error");
                    }
                    if (res.data.success) {
                        $.notify(res.data.success, "success");
                        this.getManagers();
                        this.getCommissionPayment();
                        this.clearData();
                    }
                });
            },

            commissionReceive(id) {
                window.open('/admin/manager/payment-invoice/' + id, '_blank');
            },

            deleteRow(id) {
                if (confirm("Are you sure want to delete this!")) {
                    axios.post("/admin/manager/delete/payment", { id: id }).then((res) => {
                        if (res.data.error) {
                            $.notify(res.data, "error");
                        } else {
                            $.notify(res.data.success, "success");
                        }
                        this.getManagers();
                        this.getCommissionPayment();
                        this.clearData();
                    });
                }
            },

            clearData() {
                this.form.id = "";
                this.form.payment_type = 'Cash';
                this.form.amount = 0;
                this.form.note = 0;
                this.form.managerDue = 0;
                this.selectedManager = null;
                this.form.last_payment = 0;
                this.form.manager_id = '';
                
            },


        },
    }
</script>
