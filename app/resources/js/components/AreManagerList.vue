<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-2">
                            <div class="form-group m-0">
                                <select class="form-select shadow-none" v-model="searchBy" @change="onChangeSearch">
                                    <option value="">All</option>
                                    <option value="manager">Manager Wise</option>
                                    <option value="worker">Worker Wise</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3" v-if="searchBy == 'manager'" :class="searchBy == 'manager' ? '' : 'd-none'">
                            <div class="form-group">
                                <v-select :options="managers" id="manager" label="name" v-model="selectedManager"
                                    placeholder="Area Manager Select"></v-select>
                            </div>
                        </div>
                        <div class="col-lg-3" v-if="searchBy == 'worker'" :class="searchBy == 'worker' ? '' : 'd-none'">
                            <div class="form-group">
                                <v-select :options="workers" id="worker" label="name" v-model="selectedWorker"
                                    placeholder="Worker Select"></v-select>
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
                        <div class="col-lg-2">
                            <button type="button" @click="getCommission" class="btn btn-primary btn-sm shadow-none">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table v-if="commissions.length > 0" class="table table-bordered m-0">
                        <thead style="background: #59d9ff">
                            <tr>
                                <th class="text-white" style="font-weight: bold; width: 5%">
                                    Sl
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Payment Date
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Area Manager / Worker
                                </th>
                                <th class="text-white text-end" style="font-weight: bold">
                                    Commission Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in commissions" :key="item.id">
                                <td>{{ ++index }}</td>
                                <td>{{ item.payment_date }}</td>
                                <td>{{ item.manager_id ? item.manager_name : item.worker_name }}</td>
                                <td class="text-end">{{ item.amount }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" style="font-weight: bold">Total</th>
                                <th class="text-end" style="font-weight: bold">{{ commissions.reduce((acc, pre) => {return (acc + parseFloat(pre.amount))}, 0).toFixed(2) }}</th>
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
            searchBy: "",
            filter: {
                dateFrom: moment().format('YYYY-MM-DD'),
                dateTo: moment().format('YYYY-MM-DD'),
            },
            workers: [],
            selectedWorker: null,
            managers: [],
            selectedManager: null,
            commissions: [],
        };
    },

    created() {
        this.getWorker();
        this.getManager();
    },

    methods: {
        onChangeManager() {
            this.commissions = [];
        },
        getWorker() {
            axios.get("/admin/get-worker").then((res) => {
                this.workers = res.data.workers;
            });
        },
        getManager() {
            axios.get("/admin/get-manager").then((res) => {
                this.managers = res.data.data;
            });
        },

        onChangeSearch() {
            this.selectedWorker = null;
            this.selectedManager = null;
        },

        getCommission() {
            // if (this.selectedManager == null) {
            //     alert("Area Manager Select");
            //     document.querySelector("#manager [type='search']").focus();
            //     return;
            // }
            let formdata = {
                dateFrom: this.filter.dateFrom,
                dateTo: this.filter.dateTo,
                workerId: this.selectedWorker != null ? this.selectedWorker.id : "",
                managerId: this.selectedManager != null ? this.selectedManager.id : "",
            };
            axios.post("/admin/commission-fetch", formdata).then((res) => {
                this.commissions = res.data;
            });
        },
    },
};
</script>

<style>
#vs1__combobox {
    padding: 0;
}
</style>
