<template>
    <div class="row">
        <div class="col-12">
            <h3>{{ title }} : {{ invoiceData.invoice }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="invoiceData.orderDetails.length > 0" v-for="(item, index) in invoiceData.orderDetails" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>
                            <input type="text" v-model="item.name" class="form-control shadow-none">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="1" v-model="item.quantity" @input="calculateTotal(index, item)" class="form-control shadow-none">
                        </td>
                        <td>
                            <input type="text" v-model="item.unit_price" class="form-control shadow-none">
                        </td>
                        <td>
                            <input type="text" v-model="item.total" class="form-control shadow-none">
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm shadow-none" @click="deleteProduct(index)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <button @click="Update" class="btn btn-primary btn-sm shadow-none">Update Order</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        invoiceData: {
            item: Object
        },
    },
    data() {
        return {
            rowdata: this.invoiceData.orderDetails
        }
    },
    methods: {
        calculateTotal(sl, data){
            this.invoiceData.orderDetails[sl].total = (data.quantity * parseFloat(data.unit_price)).toFixed(2);
            this.invoiceData.subtotal = this.invoiceData.orderDetails.reduce((acc, pre) => {return acc + +pre.total}, 0).toFixed(2)
            this.invoiceData.total = (parseFloat(this.invoiceData.subtotal) + parseFloat(this.invoiceData.shipping_charge)).toFixed(2);
        },

        Update(){
            axios.post(location.origin+"/admin/order/update", this.invoiceData)
                .then(res => {
                    $.notify(res.data, 'success')
                    $("#EditOrder").modal('hide')
                })
        },

        deleteProduct(sl){
            this.invoiceData.orderDetails.splice(sl, 1)
        },
    }
};
</script>