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
                                        <option value="manager">Manager Wise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-1" v-if="searchBy == 'manager'"
                                :class="searchBy == 'manager' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="managers" :options="managers" v-model="selectedManager" label="name"></v-select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-1" v-if="searchBy == 'thana'"
                                :class="searchBy == 'thana' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="thanas" :options="thanas" v-model="selectedThana" label="name"></v-select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2 mb-1">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="filter.status">
                                        <option value="">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="complete">Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2 mb-1">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="recordType">
                                        <option value="without">Without Detail</option>
                                        <option value="with">With Detail</option>
                                    </select>
                                </div>
                            </div>
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
                    <a href="" @click.prevent="print" :style="{ display: orders.length > 0 ? '' : 'none' }" style="color: #3e5569;">
                        <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                            Print
                    </a>
                </div>
                <div class="card-body pt-0" :style="{ display: orders.length > 0 ? '' : 'none' }" id="reportContent">
                    <table class="table table-bordered m-0 record-table" v-if="recordType == 'with'" style="display:none"
                        :style="{ display: recordType == 'with' ? '' : 'none' }">
                        <thead style="background: #59d9ff">
                            <tr>
                                <th style="text-align: center; width: 8%;color:white;"> Sl </th>
                                <th style="text-align: center; width: 10%;color:white;"> #Invoice </th>
                                <th style="text-align: center;color:white;">Date</th>
                                <th style="text-align: center;color:white;">Customer</th>
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
                                    <td class="text-center"> {{ item.invoice }} </td>
                                    <td class="text-center"> {{ formatDate(item.date) }} </td>
                                    <td class="text-center"> {{ item.name }} </td>
                                    <td class="text-center text-capitalize" v-html="statusText( item.status)"></td>
                                    <td class="text-center">{{ item.orderDetails[0].name }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].quantity }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].bill_amount }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].paid_amount }}</td>
                                    <td class="text-center">{{ item.orderDetails[0].due }}</td>
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
                                    <td class="text-center">{{ service.bill_amount }}</td>
                                    <td class="text-center">{{ service.paid_amount }}</td>
                                    <td class="text-center">{{ service.due }}</td>
                                    <td class="text-center">{{ service.worker_name }}</td>
                                    <td></td>
                                </tr>
                                <tr style="font-weight:bold;">
                                    <td colspan="6" style="font-weight:normal;">
                                        <strong>Note: </strong>{{ item.note }}</td>
                                    <td style="text-align:center;">Total Quantity<br>
                                    {{ item.orderDetails.reduce((prev,
                                        curr) => { return prev + parseFloat(curr.quantity) }, 0) }}</td>
                                    <td colspan="5" style="text-align:right;">
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


                    <table class="table table-bordered m-0 record-table" v-else style="display:none"
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
                                <th v-if="commission > 0" style="text-align: center;color:white;">Commission({{ commission }})%</th>
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
                                    <td v-if="commission > 0" style="text-align: end;"> {{ parseFloat((item.subtotal*commission)/100).toFixed(2) }} ৳</td>
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

                            <tr v-if="commission > 0">
                                <td colspan="5" style="text-align: end;">
                                  <strong>Total Commission</strong>
                                </td>
                                <td style="text-align: end;">
                                    <strong> {{ (orders.reduce((acc, pre) => { return  (acc + parseFloat(pre.subtotal)) }, 0)*commission/100).toFixed(2) }} ৳ </strong>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

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
                status: "",
                dateFrom: "",
                dateTo: "",
            },
            orders: [],
            thanas: [],
            managers: [],
            selectedThana: 'select area',
            selectedManager: 'select manager',
            commission: '',

            adminId: "",
            role: "",
        };
    },

    created() {
        this.getOrder();
        this.getThana();
        this.getManager();
        this.adminId = this.$attrs.admin_id
        this.role = this.$attrs.role
    },

    methods: {
        statusText(status){
            let texT = "";
            if (status == 'pending') {
                texT = "<span class='badge bg-danger'>pending</span>"
            }
            if (status == 'Ongoing') {
                texT = "<span class='badge bg-warning'>Ongoing</span>"
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

        getManager(){
            axios.get("/admin/get-manager").then((res) => {
                this.managers = res.data.manager;
            });
        },

        onChangeSearch() {
            this.selectedThana = null;
        },

        getOrder() {
            this.filter.thanaId = this.selectedThana == null ? null : this.selectedThana.id
            this.filter.managerId = this.selectedManager == null ? null : this.selectedManager.id

            axios.post("/admin/order/fetch", this.filter).then((res) => {
                this.orders = res.data.orders.filter(order => order.status != 'cancel');
                this.commission = res.data.commission
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

        async print() {
				let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Order List
                                </h3>
							</div>
							<div class="col-sm-12">
								${document.querySelector('#reportContent').innerHTML}
							</div>
						</div>
					</div>
				`;
				var reportWindow = window.open('', 'PRINT', `height=${screen.height}, width=${screen.width}`);
				reportWindow.document.write(`
					<table>
                        <tr>
                            <td><img src="/uploads/logo/6524546_6517fde95908b.png"></td>
                            <td>
                                <strong style="padding:0;"> A2Z Services<strong>
                                <p style="text-transform:capitalize;padding:0;margin:0;">
                                    18/4 d bagomgonj line narinda Dhaka 1100
                                </p>
                            </td>
                        </tr>
                    </table>
				`);

				reportWindow.document.head.innerHTML += `

					<style>
						.record-table{
							width: 100%;
							border-collapse: collapse;
						}
						.record-table thead{
							background-color: #0097df;
							color:white;
						}
						.record-table th, .record-table td{
							padding: 3px;
							border: 1px solid #454545;
						}
						.record-table th{
							text-align: center;
						}
					</style>
				`;
				reportWindow.document.body.innerHTML += reportContent;

				let rows = reportWindow.document.querySelectorAll('.record-table tr');
				rows.forEach(row => {
					row.lastChild.remove();
				})

				reportWindow.focus();
				await new Promise(resolve => setTimeout(resolve, 3000));
				reportWindow.print();
				reportWindow.close();
			}

    },
};
</script>

<style>
#thanas [role="combobox"] {
    padding: 0 !important;
}
</style>
