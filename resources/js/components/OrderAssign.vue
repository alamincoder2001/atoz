<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form @submit.prevent="getOrder">
                        <div class="row">
                            <div class="col-6 col-md-3" v-if="role != 'manager'" :class="role != 'manager' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="thanas" :options="thanas" v-model="selectedThana" label="name"></v-select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="form-group m-0">
                                    <input type="date" class="form-control" v-model="filter.dateFrom" />
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="form-group m-0">
                                    <input type="date" class="form-control" v-model="filter.dateTo" />
                                </div>
                            </div>
                            <div class="col-6 col-md-1">
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-info btn-sm shadow-none px-3">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body" style="overflow-x: auto;" :style="{ display: orders.length > 0 ? '' : 'none' }">
                    <table class="table table-bordered m-0" v-if="recordType == 'with'" style="display:none"
                        :style="{ display: recordType == 'with' ? '' : 'none' }">
                        <thead style="background: #59d9ff">
                            <tr>
                                <th style="text-align: center; width: 8%;color:white;"> Sl </th>
                                <th style="text-align: center; width: 10%;color:white;"> #Invoice </th>
                                <th style="text-align: center;color:white;width: 10%;"> Date </th>
                                <th style="text-align: center;color:white;"> Customer </th>
                                <th style="text-align: center;color:white;">Status</th>
                                <th style="text-align: center;color:white;">Service</th>
                                <th style="text-align: center;color:white;">Quantity</th>
                                <th style="text-align: center;color:white;">Bill</th>
                                <th style="text-align: center;color:white;">Discount</th>
                                <th style="text-align: center;color:white;">Paid</th>
                                <th style="text-align: center;color:white;">Due</th>
                                <th style="text-align: center;color:white;">Worker</th>
                                <th style="text-align: center;color:white;">Status</th>
                                <th style="text-align: center; width: 8%;color:white;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in orders">
                                <tr>
                                    <td class="text-center" style="width: 5%"> {{ index + 1 }} </td>
                                    <td class="text-center"> {{ item.invoice }} </td>
                                    <td class="text-center"> {{ formatDate(item.date) }} </td>
                                    <td class="text-center"> {{ item.name }} </td>
                                    <td class="text-center text-capitalize" v-html="statusText(item.status)"></td>
                                    <td class="text-center">{{ item.orderDetails[0].name }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].quantity }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].bill_amount }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].discount }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].paid_amount }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].due }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].worker_name }}</td>
                                    <td class="text-center" v-html="statusText(item.orderDetails[0].status)"></td>
                                    <td style="display: flex;gap: 2px;">
                                        <button v-if="item.orderDetails[0].status != 'complete'"
                                            @click="modalShow(item.orderDetails[0], item.thanaId)" type="button"
                                            class="btn btn-danger btn-sm shadow-none fas fa-user"></button>
                                        <br>
                                        <button v-show="ManagerOrAdmin" title="Add Due Amount"
                                            v-if="item.orderDetails[0].status != 'complete'"
                                            @click="addDueModalShow(item.orderDetails[0].id, 'due')" type="button"
                                            class="btn btn-success btn-sm shadow-none">
                                            Due
                                        </button>
                                        <button v-show="ManagerOrAdmin" title="Add Discount Amount"
                                            v-if="item.orderDetails[0].status != 'complete'"
                                            @click="addDueModalShow(item.orderDetails[0].id, 'discount')" type="button"
                                            class="btn btn-success btn-sm shadow-none">
                                            Discount
                                        </button>
                                    </td>
                                </tr>
                                <tr v-for="(service, sl) in item.orderDetails.slice(1)">
                                    <td colspan="5" :rowspan="item.orderDetails.length - 1" v-if="sl == 0"></td>
                                    <td class="text-center">{{ service.name }}</td>
                                    <td class="text-center">{{ service.quantity }}</td>
                                    <td class="text-center">{{ service.bill_amount }}</td>
                                    <td class="text-center">{{ service.discount }}</td>
                                    <td class="text-center">{{ service.paid_amount }}</td>
                                    <td class="text-center">{{ service.due }}</td>
                                    <td class="text-center">{{ service.worker_name }}</td>
                                    <td class="text-center" v-html="statusText(service.status)"></td>
                                    <td style="display: flex;gap: 2px;">
                                        <button v-if="service.status != 'complete'"
                                            @click="modalShow(service, item.thanaId)" type="button"
                                            class="btn btn-danger btn-sm shadow-none fas fa-user"></button>
                                        <br>
                                        <button v-show="ManagerOrAdmin" href="javascript:void(0)" title="Add Due Amount"
                                            v-if="service.status != 'complete'"
                                            @click="addDueModalShow(service.id, 'due')"
                                            class="btn btn-success btn-sm shadow-none">
                                            Due
                                        </button>
                                        <button v-show="ManagerOrAdmin" href="javascript:void(0)" title="Add Discount Amount"
                                            v-if="service.status != 'complete'"
                                            @click="addDueModalShow(service.id, 'discount')"
                                            class="btn btn-success btn-sm shadow-none">
                                            Discount
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="13">
                                        <div class="devider"></div>
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


        <!-- modal for assign order -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="staticBackdropLabel">Service Assign On Worker</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- {{ modalData }} -->
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Service Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ modalData.name }}</td>
                                    <td>{{ modalData.quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group mt-3">
                            <label for="workers">Worker</label>
                            <v-select id="workers" :options="workers" v-model="selectedWorker"
                                label="display_name"></v-select>
                        </div>
                        <div class="form-group mt-3">
                            <button @click="assignWork" type="button" class="btn btn-info shadow-none w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- servie due add -->
        <div class="modal fade" id="serviceDue" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="serviceDueLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="serviceDueLabel">Service {{ txt }} Add</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 row">
                        <div class="form-group col-8">
                            <label for="workers">{{ txt }} Amount</label>
                            <input type="number" class="form-control" v-model="Amount">
                            <input type="hidden" v-model="od_id">
                            <input type="hidden" v-model="txt">
                        </div>
                        <div class="form-group col-4">
                            <button @click="addAmount" type="button"
                                class="btn btn-info shadow-none w-100 mt-3">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- servie due add -->

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
            recordType: 'with',
            filter: {
                dateFrom: "",
                dateTo: "",
            },
            orders: [],
            thanas: [],
            Amount: '0.00',
            selectedThana: null,
            workers: [],
            selectedWorker: null,
            workerSelected: {
                display_name: 'select worker'
            },
            od_id: '',

            adminId: "",
            role: "",
            modalData: {},
            ManagerOrAdmin: true,
            txt: "",
        };
    },

    created() {
        this.getThana();
        this.getOrder();
        this.adminId = this.$attrs.admin_id
        this.role = this.$attrs.role
    },

    methods: {

        statusText(status) {
            let texT = "";
            if (status == 'pending') {
                texT = "<span class='badge bg-danger'>Pending</span>"
            }
            if (status == 'bill') {
                texT = "<span class='badge bg-warning'>On Going</span>"
            }
            if (status == 'complete') {
                texT = "<span class='badge bg-success'>Completed</span>"
            }
            return texT;
        },

        getThana() {
            axios.get("/admin/thana/fetch").then((res) => {
                this.thanas = res.data.data;
            });
        },

        async getWorker(thana) {
            await axios.get("/admin/worker-assign-order").then((res) => {
                this.workers = res.data.workers.filter(w => w.thana_id == thana).map(item => {
                    item.display_name = item.mobile + '-' + item.name;
                    return item;
                })
            });
        },

        onChangeSearch() {
            this.selectedThana = null;
        },

        getOrder() {
            this.filter.thanaId = this.selectedThana == null ? null : this.selectedThana.id

            axios.post("/admin/order/fetch", this.filter).then((res) => {
                this.orders = res.data.orders.filter(order => order.status != 'cancel' && order.status != 'complete');
            });
        },

        modalShow(service, thana_id) {
            $('#staticBackdrop').modal('show');
            this.getWorker(thana_id);
            this.modalData = service;
            this.selectedWorker = null;
            if (service.worker_id) {
                this.selectedWorker = {
                    id: service.worker_id,
                    name: service.worker_name,
                    display_name: `${service.mobile}-${service.worker_name}`
                }
            }
        },

        addDueModalShow(od_id, type) {
            this.od_id = od_id;
            this.txt = type == 'due' ? "Due" : "Discount";
            this.Amount = 0;
            $('#serviceDue').modal('show');
        },

        addAmount() {
            let filter = {
                orderDetailId: this.od_id,
                amount: this.Amount,
                type: this.txt
            }
            axios.post("/admin/order/add-due", filter).then((res) => {
                $.notify(res.data.success, "success");
                this.getOrder();
                $('#serviceDue').modal('hide');
            });
        },

        assignWork() {
            let filter = {
                id: this.modalData.id,
                worker_id: this.selectedWorker == null ? null : this.selectedWorker.id
            }
            axios.post("/admin/order/assign-worker", filter).then((res) => {
                $.notify(res.data, "success");
                this.getOrder();
                this.selectedWorker = null;
                $('#staticBackdrop').modal('hide');
            });
        },

        formatDate(date) {
            return moment(date).format("DD-MM-YYYY");
        },
    },
};
</script>

<style>
#thanas [role="combobox"] {
    padding: 0 !important;
}

.devider {
    width: 15px;
    height: 10px;
    border: 1px solid #59d9ff;
    margin: 0 auto;
    border-top-left-radius: 50px;
    border-bottom-right-radius: 50px;
}

.devider::before {
    content: "";
    border: 1px dashed #59d9ff;
    position: absolute;
    left: 23px;
    width: 450px;
    height: 8px;
}

.devider::after {
    content: "";
    border: 1px dashed #59d9ff;
    position: absolute;
    right: 23px;
    width: 450px;
    height: 8px;
}
</style>
