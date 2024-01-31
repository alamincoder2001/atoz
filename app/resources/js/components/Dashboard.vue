<style>
.fontSize {
    font-size: 16px;
}

.card-header i {
    padding: 12px;
    /* border-top-left-radius: 25px;
    border-bottom-right-radius: 25px; */
    font-size: 25px;
    color: #fff;
    border-radius: 50%;
}
</style>
<template>
    <div>
        <div class="row d-flex justify-content-center">

            <div class="col-12">
                <div class="row mb-1">
                    <div class="col-7 col-md-7"></div>
                    <div class="col-2 col-md-2">
                        <div class="form-group m-0">
                            <input type="date" class="form-control" v-model="filter.dateFrom" />
                        </div>
                    </div>
                    <div class="col-2 col-md-2 ">
                        <div class="form-group m-0">
                            <input type="date" class="form-control" v-model="filter.dateTo" />
                        </div>
                    </div>
                    <div class="col-1 col-md-1">
                        <button type="button" @click="getProfit" class="btn btn-primary btn-sm shadow-none">
                            Submit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-dollar-sign bg-secondary" style="padding: 12px 17px;"></i>
                    </div>
                    <div class="box bg-secondary text-center">
                        <a href="/admin/order-assign" title="View pending order list">
                            <h3 class="font-light text-white fontSize">Bill Amount</h3>
                            <h4 class="text-white">{{ orderDetail.reduce((acc, pre) => {
                                return acc +
                                        parseFloat(pre.bill_amount)
                                },
                                    0).toFixed(2) }}
                                </h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-dollar-sign bg-primary" style="padding: 12px 17px;"></i>
                    </div>
                    <div class="box bg-primary text-center">
                        <a href="/admin/order-delivery" title="View complete order list">
                            <h3 class="font-light text-white fontSize">Paid Amount</h3>
                            <h4 class="text-white">
                                {{ orderDetail.reduce((acc, pre) => {
                                return acc +  parseFloat(pre.paid_amount) },  0).toFixed(2) }}
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-dollar-sign bg-danger" style="padding: 12px 17px;"></i>
                    </div>
                    <div class="box bg-danger text-center">
                        <a href="javascript:void(0)">
                            <h3 class="font-light text-white fontSize">Due Amount</h3>
                            <h4 class="text-white">{{ orderDetail.reduce((acc, pre) => {
                                return acc + parseFloat(pre.due)
                            }, 0).toFixed(2) }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-dollar-sign bg-info" style="padding: 12px 17px;"></i>
                    </div>
                    <div class="box bg-info text-center">
                        <a href="/admin/order/report" title="View Commission Report">
                            <h3 class="font-light text-white fontSize">Commission</h3>
                            <h4 class="text-white">{{ orderDetail.reduce((acc, pre) => {
                                return acc + parseFloat(pre.commission_amount)
                            }, 0).toFixed(2) }}</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-shopping-cart bg-dark"></i>
                    </div>
                    <div class="box bg-dark text-center">
                        <a href="/admin/order" title="View Orders">
                            <h3 class="font-light text-white fontSize">Processing Order</h3>
                            <h4 class="text-white">{{ todayOrder }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-shopping-cart bg-warning"></i>
                    </div>
                    <div class="box bg-warning text-center">
                        <a href="/admin/order-assign" title="View Pending Orders">
                            <h3 class="font-light text-white fontSize">Pending Order</h3>
                            <h4 class="text-white">{{ pendingOrder }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-shopping-cart bg-success"></i>
                    </div>
                    <div class="box bg-success text-center">
                        <a href="/admin/order-delivery" title="View Completed Orders">
                            <h3 class="font-light text-white fontSize">Completed Order</h3>
                            <h4 class="text-white">{{ completedOrder }}</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- Column -->
            <div class="col-md-3 col-6" v-if="role != 'manager'">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-users bg-primary"></i>
                    </div>
                    <div class="box bg-primary text-center">
                        <a href="/admin/manager" title="View Area Managers">
                            <h3 class="font-light text-white fontSize"> Area Manager </h3>
                            <h4 class="text-white"> {{ manager }} </h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-users bg-info"></i>
                    </div>
                    <div class="box bg-info text-center">
                        <a href="/admin/worker" title="View Workers">
                            <h3 class="font-light text-white fontSize"> Worker </h3>
                            <h4 class="text-white">{{ worker }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-users bg-secondary"></i>
                    </div>
                    <div class="box bg-secondary text-center">
                        <a href="/admin/customer" title="View Customers">
                            <h3 class="font-light text-white fontSize"> Customer </h3>
                            <h4 class="text-white"> {{ customer }} </h4>
                        </a>
                    </div>
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
            props: [
                'admin_id',
                'role',
            ],
            filter: {
                dateFrom: moment().format('YYYY-MM-DD'),
                dateTo: moment().format('YYYY-MM-DD'),
            },
            orderDetail: [],
            todayOrder: 0,
            pendingOrder: 0,
            completedOrder: 0,
            commission: 0,
            worker: 0,
            manager: 0,
            customer: 0,

            adminId: "",
            role: "",
        }
    },

    created() {
        this.getProfit();
        this.adminId = this.$attrs.admin_id
        this.role = this.$attrs.role
    },

    methods: {
        getProfit() {
            let formdata = {
                dateFrom: this.filter.dateFrom,
                dateTo: this.filter.dateTo,
            };
            axios.post("/admin/get-profit", formdata).then(res => {
                //other
                this.worker = res.data.worker.length
                this.manager = res.data.manager.length
                this.customer = res.data.customer.length

                this.todayOrder = res.data.today_order.length
                this.pendingOrder = res.data.pending_order.length
                this.completedOrder = res.data.completed.length
                this.orderDetail = res.data.order_detail
                this.commission = res.data.commission
            })
        }
    },
};
</script>
