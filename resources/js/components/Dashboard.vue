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
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-shopping-cart bg-dark"></i>
                    </div>
                    <div class="box bg-dark text-center">
                        <h3 class="font-light text-white fontSize">Today's Order</h3>
                        <h4 class="text-white">{{ todayOrder }}</h4>
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
                        <h3 class="font-light text-white fontSize">Pending Order</h3>
                        <h4 class="text-white">{{ pendingOrder }}</h4>
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
                        <h3 class="font-light text-white fontSize">Completed Order</h3>
                        <h4 class="text-white">{{ completedOrder }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- Column -->
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center py-2 px-0">
                        <i class="fas fa-dollar-sign bg-secondary" style="padding: 12px 17px;"></i>
                    </div>
                    <div class="box bg-secondary text-center">
                        <h3 class="font-light text-white fontSize">Bill Amount</h3>
                        <h4 class="text-white">{{ orderDetail.reduce((acc, pre) => {
                            return acc +
                                parseFloat(pre.bill_amount)
                        },
                            0).toFixed(2) }}</h4>
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
                        <h3 class="font-light text-white fontSize">Paid Amount</h3>
                        <h4 class="text-white">{{ orderDetail.reduce((acc, pre) => {
                            return acc +
                                parseFloat(pre.paid_amount)
                        },
                            0).toFixed(2) }}</h4>
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
                        <h3 class="font-light text-white fontSize">Due Amount</h3>
                        <h4 class="text-white">{{ orderDetail.reduce((acc, pre) => {
                            return acc +
                                parseFloat(pre.due)
                        },
                            0).toFixed(2) }}</h4>
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
                        <h3 class="font-light text-white fontSize"> Area Manager </h3>
                        <h4 class="text-white"> {{ manager }} </h4>
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
                        <h3 class="font-light text-white fontSize"> Worker </h3>
                        <h4 class="text-white">{{ worker }}</h4>
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
                        <h3 class="font-light text-white fontSize"> Customer </h3>
                        <h4 class="text-white"> {{ customer }} </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            props: [
                'admin_id',
                'role',
            ],
            orderDetail: [],
            todayOrder: 0,
            pendingOrder: 0,
            completedOrder: 0,
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
            axios.get("/admin/get-profit")
                .then(res => {
                    //other
                    this.worker = res.data.worker.length
                    this.manager = res.data.manager.length
                    this.customer = res.data.customer.length

                    this.todayOrder = res.data.today_order.length
                    this.pendingOrder = res.data.pending_order.length
                    this.completedOrder = res.data.completed.length
                    this.orderDetail = res.data.order_detail
                })
        }
    },
};
</script>