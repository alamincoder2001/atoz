<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form @submit.prevent="getOrder">
                        <div class="row">
                            <div class="col-6 col-md-2 mb-1">
                                <div class="form-group m-0">
                                    <select class="form-select shadow-none" v-model="searchBy" @change="onChangeSearch">
                                        <option value="" v-if="role != 'manager'">All</option>
                                        <option v-if="role != 'manager'" value="thana">Area Wise</option>
                                        <option value="worker">Worker Wise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-1" v-if="searchBy == 'worker'"
                                :class="searchBy == 'worker' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="workers" :options="workers" v-model="selectedWorker" label="name"
                                        placeholder="Select Worker"></v-select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-1" v-if="searchBy == 'thana'"
                                :class="searchBy == 'thana' ? '' : 'd-none'">
                                <div class="form-group m-0">
                                    <v-select id="thanas" :options="thanas" v-model="selectedThana" label="name"
                                        placeholder="Select Upazila"></v-select>
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

                    <a href="" @click.prevent="print" style="color: #3e5569; float: right !important;" v-if="orders.length > 0">
                        <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                            Print
                    </a>
                </div>
                <div class="card-body pt-0" v-if="orders.length > 0" id="reportContent">
                    <table class="table table-bordered m-0 record-table">
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
                                                @click="statusChange(item.id, 'proccess')" type="button" title="Working Status Pending"
                                                style="padding: 5px;" class="btn btn-xs btn-warning shadow-none text-white">
                                                <i class="fas fa-check-square"></i>
                                            </button>
                                            <button v-if="item.status == 'proccess'" @click="showModal(item.id)"
                                                type="button" style="padding: 5px;" title="Working Status Proccess"
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
            workers: [],
            selectedWorker: null,
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
        if (this.role == 'manager') {
            this.searchBy = 'worker';
            this.getWorker();
        }
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
        getWorker() {
            axios.get("/admin/get-worker").then((res) => {
                this.workers = res.data.workers;
            });
        },
        getThana() {
            axios.get("/admin/thana/fetch").then((res) => {
                this.thanas = res.data.data;
            });
        },
        onChangeSearch() {
            this.selectedWorker = null;
            this.selectedThana = null;
            if (this.searchBy == 'thana') {
            } else if (this.searchBy == 'worker') {
                this.getWorker();
            } else {

            }
        },
        getOrder() {
            this.filter.thanaId = this.selectedThana == null ? null : this.selectedThana.id
            this.filter.workerId = this.selectedWorker == null ? null : this.selectedWorker.id

            axios.post("/admin/get-orderDetails", this.filter).then((res) => {
                this.orders = res.data.msg;
            });
        },

        statusChange(id = null, status = null) {
            if (confirm("Are you sure! want to change work status?")) {
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

        async print() {
				let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Assign Service Worker List
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
