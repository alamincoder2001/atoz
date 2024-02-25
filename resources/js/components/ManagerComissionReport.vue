<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select class="form-select shadow-none" v-model="filter.searchBy">
                                    <option value="">All</option>
                                    <option value="manager">By Manager</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6 col-lg-2">
                            <div class="form-group m-0">
                                <input type="date" class="form-control" v-model="filter.dateFrom" />
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="form-group m-0">
                                <input type="date" class="form-control" v-model="filter.dateTo" />
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="button" @click="getCommissionPayment" class="btn btn-primary btn-sm shadow-none">
                                Submit
                            </button>
                        </div>
                    </div>
                    <a href="" @click.prevent="print" :style="{ display: managerPayments.length > 0 ? '' : 'none' }"
                        style="color: #3e5569;float: right !important;">
                        <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                        Print
                    </a>
                </div>
                <div class="card-body pt-0" id="reportContent">
                    <table class="table table-bordered m-0 record-table" v-if="managerPayments.length > 0">
                        <thead style="background: #59d9ff">
                            <tr>
                                <th style="text-align: center; width: 8%;color:white;"> Sl </th>
                                <th style="text-align: center; width: 15%;color:white;"> Transaction ID </th>
                                <th style="text-align: center;color:white;">Date</th>
                                <th style="text-align: center;color:white;">Area Manager</th>
                                <th style="text-align: center;color:white;">Payment Amount</th>
                                <th style="text-align: center;color:white;">Saved By</th>
                                <th style="text-align: center; width: 10%;color:white;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, sl) in managerPayments">
                                <td>{{ sl + 1 }}</td>
                                <td>{{ item.transaction_id }}</td>
                                <td>{{ item.payment_date }}</td>
                                <td>{{ item.manager?.name }}</td>
                                <td>{{ item.amount }}</td>
                                <td>{{ item.receive_by?.name }}</td>
                                <td>
                                    <a :href="`/admin/manager/payment-invoice/${item.id}`" class="me-2 shadow-none"
                                        title="Manager commission invoice">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                    <a href="javascript:void(0)" @click.prevent="deleteRow(item.id)">
                                        <i class="fas fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">
                                    Total
                                </th>
                                <th>{{ managerPayments.reduce((prev, curr) => { return prev + parseFloat(curr.amount) },
                                    0).toFixed(2) }}</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div v-else class="text-center">Not Found Data</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    data() {
        return {
            filter: {
                searchBy: '',
                dateFrom: moment().format('YYYY-MM-DD'),
                dateTo: moment().format('YYYY-MM-DD'),
            },
            managers: [],
            selectedManager: null,
            managerPayments: []
        };
    },

    created() {
        this.getManager();
    },

    methods: {
        getManager() {
            axios.get("/admin/get-manager").then((res) => {
                this.managers = res.data.manager;
            });
        },

        getCommissionPayment() {
            let formdata = {
                dateFrom: this.filter.dateFrom,
                dateTo: this.filter.dateTo,
                managerId: this.selectedManager == null ? "" : this.selectedManager.id
            };
            axios.post("/admin/get-manager-payment", formdata).then((res) => {
                this.managerPayments = res.data.paymentCollections;
            });
        },

        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post("/admin/manager/delete/payment", { id: id }).then((res) => {
                    if (res.data.error) {
                        $.notify(res.data, "error");
                    } else {
                        $.notify(res.data.success, "success");
                    }
                    this.getCommissionPayment();
                });
            }
        },

        async print() {
            let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Area Manager Commission Report
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

                        @media print
                        {
                            .no-print, .no-print *
                            {
                                display: none !important;
                            }
                        }

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

            reportWindow.focus();
            await new Promise(resolve => setTimeout(resolve, 1000));
            reportWindow.print();
            reportWindow.close();
        }
    },
};
</script>

<style>
#vs1__combobox {
    padding: 0;
}
</style>
