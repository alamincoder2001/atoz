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
                    <form @submit.prevent="saveOrUpdatePayment">
                        <div class="row">

                            <!-- <div class="col-md-5"> -->
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
                                        <label>Worker<span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group mb-2">
                                            <v-select :options="workers" v-model="selectedWorker" label="worker_name"
                                                @input="getWorkerDue"></v-select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Due<span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group mb-2">
                                            <input type="text" v-model="form.workerDue" class="form-control" readonly>
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
                            <a href="" @click.prevent="print" style="color: #3e5569;" v-if="workerPayments.length > 0">
                                <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                                Print
                            </a>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5"></div>

                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <h4 class="page-title" style="float: right;color: #3e5569;">Worker Payment List</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="printThis">
                    <table v-if="workerPayments.length > 0" class="table table-bordered m-0 record-table">
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
                                    Worker
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Received By
                                </th>
                                <th class="text-white text-end" style="font-weight: bold">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in workerPayments" :key="item.id">
                                <td>{{ ++index }}</td>
                                <td>{{ item.transaction_id }} </td>
                                <td>{{ item.payment_type }} </td>
                                <td>{{ item.payment_date }} </td>
                                <td>{{ item.amount }}</td>
                                <td>{{ item.worker.name }} </td>
                                <td>{{ item.receive_by.name }} </td>

                                <td class="text-end">
                                    <a href="javascript:void(0)" @click="paymentReceive(item.id)" class="btn shadow-none"
                                        title="Worker Payment Collection Report">
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
                    payment_type: "",
                    amount: "0.00",
                    workerDue: '0.00',
                    payment_date: moment().format('YYYY-MM-DD'),
                    note: "",
                    worker_id: '',
                    last_payment: '0.00',
                }),

                workerPayments: [],
                workers: [],
                selectedWorker: "select worker",
            }
        },

        created() {
            this.getWorkerPayments();
            this.getWorkers();
        },

        methods: {

            getWorkers() {
                axios.get("/admin/get-workers-withDueAmount")
                    .then(res => {
                        this.workers = res.data.workers;
                    })
            },

            getWorkerDue() {
                if (this.selectedWorker != null) {
                    this.form.workerDue = this.selectedWorker.dueAmount;
                } else {
                    this.form.workerDue = 0;
                }
            },

            getWorkerPayments() {
                axios.post("/admin/get-worker-payment")
                    .then(res => {
                        this.workerPayments = res.data.paymentCollections;
                    })
            },

            saveOrUpdatePayment() {

                if (this.selectedWorker == null || this.selectedWorker == '' || this.selectedWorker == undefined) {
                    $.notify("Select Worker", "error")
                    return
                }

                if (this.form.payment_type == null || this.form.payment_date == '' || this.form.payment_date == undefined) {
                    $.notify("Select Payment Type", "error")
                    return
                }

                this.form.worker_id = this.selectedWorker.id;

                let url = "/admin/worker/store/payment-collection";
                if (this.form.id != '') {
                    url = "/admin/worker/update/payment-collection";
                }
                this.form.post(url).then(res => {
                    if (res.data.error) {
                        $.notify(res.data.error, "error");
                    }
                    if (res.data.success) {
                        this.clearData();
                        $.notify(res.data.success, "success");
                        this.getWorkers();
                        this.getWorkerPayments();
                        setTimeout(() => {
                            if (confirm("Do you want to view payment receive!")) {
                                window.open('/admin/worker/payment-receive/' + res.data.id, '_blank');
                            }
                        }, 500);
                    }
                });
            },

            paymentReceive(id) {
                window.open('/admin/worker/payment-receive/' + id, '_blank');
            },

            deleteRow(id) {
                if (confirm("Are you sure want to delete this!")) {
                    axios.post("/admin/worker/delete/payment-collection", { id: id }).then((res) => {
                        if (res.data.error) {
                            $.notify(res.data, "error");
                        } else {
                            $.notify(res.data.success, "success");
                        }
                        this.getWorkers();
                        this.getWorkerPayments();
                    });
                }
            },

            clearData() {
                this.form.id = "";
                this.form.payment_type = "";
                this.form.amount = "";
                this.form.note = 0;
                this.form.workerDue = 0;
                this.selectedWorker = null;
                this.last_payment = '';
                this.worker_id = '';
            },

            async print() {
                let reportContent = `
                    <div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed #ce5cf659; border-bottom: 1px dashed #ce5cf659; padding:3px; color: #212529;">
                                    Worker Payment Collection List
                                </h3>
							</div>
                        </div>
						${document.querySelector('#printThis').innerHTML}
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
                <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
                <link rel="stylesheet" href="{{ asset('frontend/assets/css/boxicons.min.css') }}">
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
                        i { color: #7b3edb !important; }
                        .myaccount-content {
                            background-color: #fff;
                            font-size: 14px;
                            border: 1px solid #ce5cf659;
                            padding: 20px;
                            min-height: 175px;
                        }
					</style>
				`;
                reportWindow.document.body.innerHTML += reportContent;

                let rows = reportWindow.document.querySelectorAll('.record-table tr');
                rows.forEach(row => {
                    row.lastChild.remove();
                })

                reportWindow.focus();
                reportWindow.print();
                setTimeout(() => {
                    reportWindow.close();
                }, 1000);
            }


        },
    }
</script>
