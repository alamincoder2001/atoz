<template>
    <div class="row">
        <div class="col-12">
            <h5 class="modal-title text-center text-uppercase p-1"
                style="border-bottom: 2px dashed #cbcbcb;border-top: 2px dashed #cbcbcb;">{{ title }}</h5>
        </div>
        <div class="col-12 mt-3 text-end">
            <p class="m-0" style="border-bottom: 1px solid #ccc;">
                <span style="text-transform: uppercase;font-style: italic;">Invoice no: </span>{{ modalData.invoice }} <br />
                <span style="text-transform: uppercase;font-style: italic;">Date: </span> {{ dateFormat(modalData.date) }}
            </p>
        </div>
        <div class="col-6 mb-2">
            <p class="m-0">
                <span style="font-weight:700;border-bottom: 1px dashed darkgray;">Billing Address</span> <br />
                <span style="font-weight:700;">Customer Name: </span>{{ modalData.name }} <br />
                <span style="font-weight:700;">Mobile: </span>{{ modalData.mobile }} <br />
                <span style="font-weight:700;">Address: </span>{{ modalData.address }} , {{modalData.customer_thana_name}}, {{ modalData.customer_district_name }} 
            </p>
        </div>
        <div class="col-6 mb-2 text-end">
            <p class="m-0">
                <span style="font-weight:700;border-bottom: 1px dashed darkgray;">Shipping Address</span> <br />
                <span style="font-weight:700;">Mobile: </span>{{ modalData.shipping_mobile }} <br />
                <span style="font-weight:700;">Address: </span>{{ modalData.shipping_address }} , {{ modalData.shipping_thana_name }} , {{ modalData.shipping_district_name }}
            </p>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-sm">
                <thead style="background: #2f8cff">
                    <tr>
                        <th class="text-white">Sl</th>
                        <th class="text-white text-center">
                            Description
                        </th>
                        <th class="text-white text-center">
                            Quantity
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in modalData.orderDetails">
                        <td>{{ ++index }}</td>
                        <td>{{ item.name }}</td>
                        <td class="text-center">
                            {{ item.quantity }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-7"></div>
        <div class="col-5">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 47%;">SubTotal</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.subtotal }}</td>
                </tr>
                <tr>
                    <td style="width: 47%;">Paid</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.total }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom: 1px dashed gray;"></td>
                </tr>
                <tr>
                    <td style="width: 47%;">Due</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.due }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script >
import moment from 'moment';

export default {
    props: {
        title: String,
        invoiceData: String,
    },
    data() {
        return {
            id: this.invoiceData,
            modalData: {},
            image: null,
        }
    },
    created() {
        this.getOrder();
    },
    methods: {
        getOrder(){
            axios.post("/admin/order/fetch", {id:this.id})
                .then(res => {
                    this.modalData = res.data.orders[0]
                })
        },
        dateFormat(data){
            return moment(data).format("DD-MM-YYYY");
        }
    }
};
</script>