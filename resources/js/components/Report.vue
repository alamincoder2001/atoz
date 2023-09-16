<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <v-select :options="customers" label="name" v-model="selectedCustomer"></v-select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="date" v-model="dateFrom" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <input type="date" v-model="dateTo" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <button type="button" @click="getCommission" class="btn btn-primary btn-sm shadow-none">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table v-if="commissions.length > 0" class="table table-bordered m-0">
                        <thead style="background: #59d9ff;">
                            <tr>
                                <th class="text-white" style="font-weight:bold;width:5%;">Sl</th>
                                <th class="text-white" style="font-weight:bold;">Customer Name</th>
                                <th class="text-white" style="font-weight:bold;width:25%;">Commission(.5% per 5 lakhs)</th>
                                <th class="text-white text-end" style="font-weight:bold;width:15%;">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in commissions">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.customer_name }}</td>
                                <td>{{ item.paid/500000 > 1 ? Number((item.paid/500000).toString()[0]) * .5:'Not Shown' }} %</td>
                                <td class="text-end">{{ item.paid }}</td>
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
import moment from 'moment';

export default {

    data() {
        return {
            dateFrom: moment().format("YYYY-MM-DD"),
            dateTo: moment().format("YYYY-MM-DD"),
            customers: [],
            selectedCustomer: {
                id: '',
                name: "Select Customer"
            },
            commissions: []          
        }
    },

    created(){
        this.getCustomer();
    },

    methods: {
        getCustomer(){
            axios.get(location.origin+"/admin/customer/fetch")
                .then(res => {
                    this.customers = res.data.filter(c => c.customer_type == 'Wholesale')
                    this.customers.unshift({id:0, name:'Select Customer'})
                })
        },

        getCommission(){
            let formdata = {
                dateFrom: this.dateFrom,
                dateTo: this.dateTo
            }
            axios.post(location.origin+"/admin/order/commission", formdata)
                .then(res => {
                    this.commissions = res.data
                })
        }
    },
};
</script>

<style>
    #vs1__combobox{
        padding: 0;
    }
</style>