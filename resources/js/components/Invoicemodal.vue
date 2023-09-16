<template>
    <div class="row">
        <div class="col-12">
            <h5 class="modal-title text-center text-uppercase p-1"
                style="border-bottom: 2px dashed #cbcbcb;border-top: 2px dashed #cbcbcb;">{{ title }}</h5>
        </div>
        <div class="col-12 mt-3 text-end">
            <p class="m-0" style="border-bottom: 1px solid #ccc;">
                <span style="text-transform: uppercase;font-style: italic;">Invoice no: </span>{{ invoiceData.invoice }} <br />
                <span style="text-transform: uppercase;font-style: italic;">Date: </span> {{ dateFormat(invoiceData.date) }}
            </p>
        </div>
        <div class="col-6 mb-2">
            <p class="m-0">
                <span style="font-weight:700;border-bottom: 1px dashed darkgray;">Billing Address</span> <br />
                <span style="font-weight:700;">Customer Name: </span>{{ invoiceData.name }} <br />
                <span style="font-weight:700;">Mobile: </span>{{ invoiceData.mobile }} <br />
                <span style="font-weight:700;">Address: </span>{{ invoiceData.address }} , {{invoiceData.customer_thana_name}}, {{ invoiceData.customer_district_name }} 
            </p>
        </div>
        <div class="col-6 mb-2 text-end">
            <p class="m-0">
                <span style="font-weight:700;border-bottom: 1px dashed darkgray;">Shipping Address</span> <br />
                <span style="font-weight:700;">Mobile: </span>{{ invoiceData.shipping_mobile }} <br />
                <span style="font-weight:700;">Address: </span>{{ invoiceData.shipping_address }} , {{ invoiceData.shipping_thana_name }} , {{ invoiceData.shipping_district_name }}
            </p>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-sm">
                <thead style="background: #2f8cff">
                    <tr>
                        <th class="text-white text-center">Sl</th>
                        <th class="text-white text-center">
                            Description
                        </th>
                        <th class="text-white text-center">
                            Quantity
                        </th>
                        <th class="text-white text-center">
                            Unit Price
                        </th>
                        <th class="text-white text-center">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in invoiceData.orderDetails">
                        <td>{{ ++index }}</td>
                        <td>{{ item.name }}</td>
                        <td class="text-center">
                            {{ item.quantity }}
                        </td>
                        <td class="text-center">
                            {{ item.unit_price }}
                        </td>
                        <td class="text-end">{{ item.total }}</td>
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
                    <td class="text-end">{{ invoiceData.subtotal }}</td>
                </tr>
                <tr>
                    <td style="width: 47%;">Shipping Charge</td>
                    <td>:</td>
                    <td class="text-end">{{ invoiceData.shipping_charge }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom: 1px dashed gray;"></td>
                </tr>
                <tr>
                    <td style="width: 47%;">Total</td>
                    <td>:</td>
                    <td class="text-end">{{ invoiceData.total }}</td>
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
        invoiceData: {
            item: Object
        },
    },
    methods: {
        dateFormat(data){
            return moment(data).format("DD-MM-YYYY");
        }
    }
};
</script>