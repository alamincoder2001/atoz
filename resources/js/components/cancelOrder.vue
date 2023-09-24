<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form @submit.prevent="getOrder">
                        <div class="row">
                            <div class="col-6 col-md-2" v-if="role != 'manager'"
                                :class="role != 'manager' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="searchBy" @change="onChangeSearch">
                                        <option value="">All</option>
                                        <option value="thana">Area Wise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3" v-if="searchBy == 'thana'"
                                :class="searchBy == 'thana' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="thanas" :options="thanas" v-model="selectedThana" label="name"></v-select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="recordType">
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
                <div class="card-body" :style="{ display: orders.length > 0 ? '' : 'none' }">
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
                                <th style="text-align: center;color:white;">Worker Name</th>
                                <th style="text-align: center; width: 10%;color:white;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in orders">
                                <tr>
                                    <td class="text-center" style="width: 5%"> {{ index + 1 }} </td>
                                    <td class="text-center"> {{ item.invoice }} </td>
                                    <td class="text-center"> {{ formatDate(item.date) }} </td>
                                    <td class="text-center"> {{ item.name }} </td>
                                    <td class="text-center text-capitalize" v-html="statusText( item.status)"></td>
                                    <td class="text-center">{{ item.orderDetails[0].name }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].quantity }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].worker_name }}</td>
                                    <td>
                                        <div class="input-group gap-2 justify-content-center">
                                            <a :href="`${'/admin/order/invoice/' + item.invoice}`" target="_blank"
                                                title="Order Invoice" style="background: none"
                                                class="shadow-none outline-none border-0">
                                                <i class="fas fa-file text-info"></i>
                                            </a>
                                            <button title="Order Cancel"
                                                v-if="item.status != 'cancel' && item.status != 'complete'"
                                                @click="InvoiceDelete(item.id)" type="button" style="background: none"
                                                class="shadow-none outline-none border-0">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="(service, sl) in item.orderDetails.slice(1)">
                                    <td colspan="5" :rowspan="item.orderDetails.length - 1" v-if="sl == 0"></td>
                                    <td class="text-center">{{ service.name }}</td>
                                    <td class="text-center">{{ service.quantity }}</td>
                                    <td class="text-center">{{ service.worker_name }}</td>
                                    <td></td>
                                </tr>
                                <tr style="font-weight:bold;">
                                    <td colspan="6" style="font-weight:normal;"><strong>Note: </strong>{{ item.note }}</td>
                                    <td style="text-align:center;">Total Quantity<br>{{ item.orderDetails.reduce((prev,
                                        curr) => { return prev + parseFloat(curr.quantity) }, 0) }}</td>
                                    <td colspan="2" style="text-align:right;">
                                        Total: {{ item.orderDetails.reduce((prev,
                                        curr) => { return prev + parseFloat(curr.bill_amount) }, 0).toFixed(2) }}<br>
                                        Paid: {{ item.orderDetails.reduce((prev,
                                        curr) => { return prev + parseFloat(curr.paid_amount) }, 0).toFixed(2) }}<br>
                                        Due: {{ item.orderDetails.reduce((prev,
                                        curr) => { return prev + parseFloat(curr.due) }, 0).toFixed(2) }}
                                    </td>
                                </tr>
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
                                <th style="text-align: center; width: 10%;color:white;"> Action </th>
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
                                        <span>Due: {{ item.due }}</span>
                                    </td>
                                    <td class="text-center text-capitalize" v-html="statusText( item.status)"> </td>
                                    <td>
                                        <div class="input-group gap-2 justify-content-center">
                                            <a :href="`${'/admin/order/invoice/' + item.invoice}`" target="_blank"
                                                title="Order Invoice" style="background: none"
                                                class="shadow-none outline-none border-0">
                                                <i class="fas fa-file text-info"></i>
                                            </a>
                                            <button title="Order Cancel"
                                                v-if="item.status != 'cancel' && item.status != 'complete'"
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
            recordType: 'without',
            filter: {
                dateFrom: "",
                dateTo: "",
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
        statusText(status){
            let texT = "";
            if (status == 'pending') {
                texT = "<span class='badge bg-danger'>pending</span>"
            }
            if (status == 'complete') {
                texT = "<span class='badge bg-success'>completed</span>"
            }

            return texT;
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

            axios.post("/admin/order/fetch", this.filter).then((res) => {
                this.orders = res.data.orders.filter(order => order.status == 'cancel');
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
</style>
