<template>
    <div class="row">
        <!-- Column -->
        <div class="col-md-4 col-lg-4 col-xlg-4">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h3 class="font-light text-white">Today's Order</h3>
                    <h4 class="text-white">{{ todayOrder }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-4 col-lg-4 col-xlg-4">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h3 class="font-light text-white">Monthly Order</h3>
                    <h4 class="text-white">{{ monthOrder }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-4 col-lg-4 col-xlg-4">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h3 class="font-light text-white">Yearly Order</h3>
                    <h4 class="text-white">{{ yearOrder }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-4 col-lg-4 col-xlg-4">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h3 class="font-light text-white"> Today's Sale </h3>
                    <h4 class="text-white"> {{ totdaySale }} </h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-4 col-lg-4 col-xlg-4">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h3 class="font-light text-white"> Monthly Sale </h3>
                    <h4 class="text-white">{{ monthlySale }}</h4>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-4 col-lg-4 col-xlg-4">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h3 class="font-light text-white"> Yearly Sale </h3>
                    <h4 class="text-white"> {{ yearlySale }} </h4>
                </div>
            </div>
        </div>

        <!-- <div class="col-12" v-if="searchType == 'month'">
            <h3 class="text-center">This Month Orders Completed</h3>
            <GChart type="ColumnChart" :data="monthlyData" :options="chartOptions1" />
        </div>

        <div class="col-12" v-else>
            <h3 class="text-center">This Year Orders Completed</h3>
            <GChart type="ColumnChart" :data="yearlyData" :options="chartOptions" />
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center mt-2">
                <button class="btn btn-warning shadow-none px-2" type="button" @click="searchType = 'month'">Month</button>
                <button class="btn btn-info shadow-none px-3" type="button" @click="searchType = 'year'">Year</button>
            </div>
        </div>

        <div class="col-lg-8 mt-3">
            <h3 class="text-center">Top Sold Products</h3>
            <GChart type="PieChart" :data="topData" :options="chartOptions2" />
        </div> -->
        <div class="col-lg-4 mt-3">
            <h3 class="text-center">Top Buyer List</h3>
            <table v-if="topCustomer.length > 0" class="table table-bordered" style="border-color: #bdbdbd;">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in topCustomer">
                        <td style="width:5%;">{{ index + 1 }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.total_amount }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center" v-if="topCustomer.length == 0">Not Found Data</div>
        </div>

    </div>
</template>

<script>
// import { GChart } from 'vue-google-charts/legacy'
export default {
    // components: {
    //     GChart
    // },
    data() {
        return {
            searchType: 'year',
            monthlyData: [
                ['Day', 'Sales'],
            ],
            yearlyData: [
                ['Month', 'Sales'],
            ],
            topData: [
                ['Product Name', 'Quantity'],
            ],
            chartOptions: {
                chart: {
                    title: 'Yearly Sold',
                }
            },
            chartOptions1: {
                chart: {
                    title: 'Monthly Sold',
                }
            },
            chartOptions2: {
                chart: {
                    title: 'Top Sold Product',
                }
            },
            topCustomer: [],
            todayOrder : 0,
            monthOrder : 0,
            yearOrder  : 0,
            totdaySale : 0.00,
            monthlySale: 0.00,
            yearlySale : 0.00,
        }
    },

    created(){
        this.getProfit();
    },

    methods: {
        getProfit(){
            axios.get(location.origin+"/admin/get-profit")
                .then(res => {
                    res.data.yearly_record.forEach(data => {
                        this.yearlyData.push(data)
                    })
                    res.data.monthly_record.forEach(data => {
                        this.monthlyData.push(data)
                    })
                    res.data.topSold.forEach(p => {
                        this.topData.push([p.product_name, parseFloat(p.qty)]);
                    })
                    this.topCustomer = res.data.topCustomer
                    
                    //other
                    this.totdaySale  = res.data.today_sale_record[0].sales_amount
                    this.monthlySale = res.data.month_sale_record[0].sales_amount
                    this.yearlySale  = res.data.year_sale_record[0].sales_amount

                    this.totdayOrder = res.data.today_order.length
                    this.monthOrder  = res.data.month_order.length
                    this.yearOrder   = res.data.year_order.length
                })
        }
    },
};
</script>