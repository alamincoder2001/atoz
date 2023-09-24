<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form @submit.prevent="getOrder">
                        <div class="row">
                            <div class="col-6 col-md-2 d-none" v-if="role != 'manager'"
                                :class="role != 'manager' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="searchBy" @change="onChangeSearch">
                                        <option value="">All</option>
                                        <option value="thana">Area Wise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3" v-if="role != 'manager'" :class="role != 'manager' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="thanas" :options="thanas" v-model="selectedThana" label="name"></v-select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2 d-none">
                                <div class="form-group m-0">
                                    <select disabled class="form-select shadow-none" v-model="recordType">
                                        <option value="without">Without Detail</option>
                                        <option value="with">With Detail</option>
                                    </select>
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
                                <th style="text-align: center;color:white;"> Date </th>
                                <th style="text-align: center;color:white;"> Customer Name </th>
                                <th style="text-align: center;color:white;">Status</th>
                                <th style="text-align: center;color:white;">Service Name</th>
                                <th style="text-align: center;color:white;">Quantity</th>
                                <th style="text-align: center;color:white;">Bill</th>
                                <th style="text-align: center;color:white;">Paid</th>
                                <th style="text-align: center;color:white;">Due</th>
                                <th style="text-align: center;color:white;">Worker Name</th>
                                <th style="text-align: center; width: 5%;color:white;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in orders">
                                <tr :style="{background: item.totaldetail == item.totalassign ? 'green': ''}" :class="item.totaldetail == item.totalassign ? 'text-white': ''">
                                    <td class="text-center" style="width: 5%"> {{ index + 1 }} </td>
                                    <td class="text-center"> {{ item.invoice }} </td>
                                    <td class="text-center"> {{ formatDate(item.date) }} </td>
                                    <td class="text-center"> {{ item.name }} </td>
                                    <td class="text-center text-capitalize"> {{ item.status }} </td>
                                    <td class="text-center">{{ item.orderDetails[0].name }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].quantity }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].bill_amount }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].paid_amount }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].due }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].worker_name }}</td>
                                    <td>
                                        <button v-if="item.status == 'pending'" @click="modalShow(item.orderDetails[0], item.thanaId)" type="button" class="btn btn-danger btn-sm shadow-none fas fa-user"></button>
                                    </td>
                                </tr>
                                <tr :style="{background: item.totaldetail == item.totalassign ? 'green': ''}" :class="item.totaldetail == item.totalassign ? 'text-white': ''" v-for="(service, sl) in item.orderDetails.slice(1)">
                                    <td colspan="5" :rowspan="item.orderDetails.length - 1" v-if="sl == 0"></td>
                                    <td class="text-center">{{ service.name }}</td>
                                    <td class="text-center">{{ service.quantity }}</td>
                                    <td class="text-center">{{ service.bill_amount }}</td>
                                    <td class="text-center">{{ service.paid_amount }}</td>
                                    <td class="text-center">{{ service.due }}</td>
                                    <td class="text-center">{{ service.worker_name }}</td>
                                    <td>
                                        <button v-if="item.status == 'pending'" @click="modalShow(service, item.thanaId)" type="button" class="btn btn-danger btn-sm shadow-none fas fa-user"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="12">
                                        <div class="devider"></div>
                                    </td>
                                </tr>
                                <!-- <tr style="font-weight:bold;">
                                    <td colspan="6" style="font-weight:normal;"><strong>Note: </strong>{{ item.note }}</td>
                                    <td style="text-align:center;">Total Quantity<br>{{ item.orderDetails.reduce((prev,
                                        curr) => { return prev + parseFloat(curr.quantity) }, 0) }}</td>
                                    <td style="text-align:left;">
                                        Total: 0<br>
                                        Paid: 0<br>
                                    </td>
                                </tr> -->
                            </template>
                        </tbody>
                    </table>
                    <table class="table table-bordered m-0" v-else style="display:none"
                        :style="{ display: recordType == 'without' ? '' : 'none' }">
                        <thead style="background: #59d9ff">
                            <tr>
                                <th style="text-align: center; width: 8%;color:white;">
                                    Sl
                                </th>
                                <th style="text-align: center; width: 10%;color:white;">
                                    #Invoice
                                </th>
                                <th style="text-align: center; width: 10%;color:white;">
                                    Date
                                </th>
                                <th style="text-align: center;color:white;"> Customer Details </th>
                                <th style="text-align: center;color:white;"> Amount Details </th>
                                <th style="text-align: center;color:white;">Order Status</th>
                                <th style="text-align: center; width: 12%;color:white;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in orders">
                                <tr>
                                    <td class="text-center" style="width: 5%"> {{ index + 1 }} </td>
                                    <td class="text-center"> {{ item.invoice }} </td>
                                    <td class="text-center"> {{ formatDate(item.date) }} </td>
                                    <td>
                                        <span>Customer Name: {{ item.name }}</span><br />
                                        <span>Mobile: {{ item.mobile }}</span><br />
                                        <span>Address: {{ item.shipping_address }}</span>
                                    </td>
                                    <td>
                                        <span>SubTotal: {{ item.subtotal }}</span><br />
                                        <span>Total: {{ item.total }}</span><br />
                                        <span>Shipping Cost: {{ item.shipping_charge }}</span>
                                    </td>
                                    <td class="text-center text-capitalize"> {{ item.status }} </td>
                                    <td style="width: 15%">
                                        <div class="input-group gap-2 justify-content-end">
                                            <a :href="`${'/admin/order/invoice/' + item.invoice}`" target="_blank"
                                                title="Order Invoice" style="background: none"
                                                class="shadow-none outline-none border-0">
                                                <i class="fas fa-file text-info"></i>
                                            </a>
                                            <button title="Order Cancel"
                                                v-if="item.status != 'cancel' && item.status != 'delivery'"
                                                @click="InvoiceDelete(item.id)" type="button" style="background: none"
                                                class="shadow-none outline-none border-0">
                                                <i class="fas fa-trash text-danger"></i>
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


        <!-- modal for assign order -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Service Assign On Worker</h5>
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
                            <v-select id="workers" :options="workers" v-model="selectedWorker" label="name"></v-select>
                        </div>
                        <div class="form-group mt-3">
                            <button @click="assignWork" type="button" class="btn btn-info shadow-none w-100">Submit</button>
                        </div>
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
            recordType: 'with',
            filter: {
                dateFrom: "",
                dateTo: "",
            },
            orders: [],
            thanas: [],
            selectedThana: null,
            workers: [],
            selectedWorker: null,

            adminId: "",
            role: "",

            modalData: {},
        };
    },

    created() {
        this.getThana();
        this.getOrder();
        this.adminId = this.$attrs.admin_id
        this.role = this.$attrs.role
    },

    methods: {
        getThana() {
            axios.get("/admin/thana/fetch").then((res) => {
                this.thanas = res.data.data;
            });
        },
        getWorker(thana_id){
            axios.get("/admin/get-worker").then((res) => {
                this.workers = res.data.workers.filter(w => w.thana_id == thana_id);
            });
        },
        onChangeSearch() {
            this.selectedThana = null;
        },
        getOrder() {
            this.filter.thanaId = this.selectedThana == null ? null : this.selectedThana.id

            axios.post("/admin/order/fetch", this.filter).then((res) => {
                this.orders = res.data.orders.filter(order => order.status != 'cancel');
            });
        },

        modalShow(service, thana_id){
            $('#staticBackdrop').modal('show');
            this.getWorker(thana_id);
            this.modalData = service;
            this.selectedWorker = null;
            if (service.worker_id) {
                this.selectedWorker = {
                    id: service.worker_id,
                    name: service.worker_name
                }
            }
        },

        assignWork(){
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

        InvoiceDelete(id) {
            if (confirm("Are you sure want to delete")) {
                axios.post("/admin/order/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getOrder();
                });
            }
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

.devider::before{
    content: "";
    border: 1px dashed #59d9ff;
    position: absolute;
    left: 23px;
    width: 450px;
    height: 8px;
}
.devider::after{
    content: "";
    border: 1px dashed #59d9ff;
    position: absolute;
    right: 23px;
    width: 450px;
    height: 8px;
}
</style>
