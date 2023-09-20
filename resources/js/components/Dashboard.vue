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
    <div class="row d-flex justify-content-center">
        <!-- Column -->
        <div class="col-md-2 col-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                    <i class="fas fa-shopping-cart bg-warning"></i>
                </div>
                <div class="box bg-warning text-center">
                    <h3 class="font-light text-white fontSize">Today's Order</h3>
                    <h4 class="text-white">{{ todayOrder }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-2 col-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                    <i class="fas fa-shopping-cart bg-danger"></i>
                </div>
                <div class="box bg-danger text-center">
                    <h3 class="font-light text-white fontSize">Monthly Order</h3>
                    <h4 class="text-white">{{ monthOrder }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-2 col-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                    <i class="fas fa-shopping-cart bg-info"></i>
                </div>
                <div class="box bg-info text-center">
                    <h3 class="font-light text-white fontSize">Yearly Order</h3>
                    <h4 class="text-white">{{ yearOrder }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-2 col-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                    <i class="fas fa-shopping-cart bg-warning"></i>
                </div>
                <div class="box bg-warning text-center">
                    <h3 class="font-light text-white fontSize"> Today's Sale </h3>
                    <h4 class="text-white"> {{ totdaySale }} </h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-2 col-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                    <i class="fas fa-shopping-cart bg-danger"></i>
                </div>
                <div class="box bg-danger text-center">
                    <h3 class="font-light text-white fontSize"> Monthly Sale </h3>
                    <h4 class="text-white">{{ monthlySale }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-2 col-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-0">
                    <i class="fas fa-shopping-cart bg-info"></i>
                </div>
                <div class="box bg-info text-center">
                    <h3 class="font-light text-white fontSize"> Yearly Sale </h3>
                    <h4 class="text-white"> {{ yearlySale }} </h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            todayOrder: 0,
            monthOrder: 0,
            yearOrder: 0,
            totdaySale: 0,
            monthlySale: 0,
            yearlySale: 0,
        }
    },

    created() {
        this.getProfit();
    },

    methods: {
        getProfit() {
            axios.get("/admin/get-profit")
                .then(res => {
                    //other
                    this.totdaySale = res.data.today_sale_record[0].sales_amount
                    this.monthlySale = res.data.month_sale_record[0].sales_amount
                    this.yearlySale = res.data.year_sale_record[0].sales_amount

                    this.totdayOrder = res.data.today_order.length
                    this.monthOrder = res.data.month_order.length
                    this.yearOrder = res.data.year_order.length
                })
        }
    },
};
</script>