<template>
    <div class="row">
        <div class="col-12">
            <h5 class="modal-title text-center text-uppercase p-1"
                style="border-bottom: 2px dashed #cbcbcb;border-top: 2px dashed #cbcbcb;">{{ title }}</h5>
        </div>
        <div class="col-6 mb-2">
            <p class="m-0">
                <span style="font-weight:700;border-bottom: 1px dashed darkgray;">Address</span> <br />
                <span style="font-weight:700;">Customer Name: </span>{{ modalData.name }} <br />
                <span style="font-weight:700;">Mobile: </span>{{ modalData.mobile }} <br />
                <span style="font-weight:700;">Address: </span>{{ modalData.address }} , {{ modalData.customer_thana_name
                }},
                {{ modalData.customer_district_name }}
            </p>
        </div>
        <div class="col-6 mb-2 text-end">
            <p class="m-0">
                <span style="font-weight:700;border-bottom: 1px dashed darkgray;">Billing Address</span> <br />
                <span style="font-weight:700;">Mobile: </span>{{ modalData.shipping_mobile }} <br />
                <span style="font-weight:700;">Address: </span>{{ modalData.shipping_address }} , {{
                    modalData.shipping_thana_name }} , {{ modalData.shipping_district_name }}
            </p>
            <p class="m-0" style="border-top: 1px solid #a1a1a1;">
                <span style="font-weight: 900; text-transform: uppercase;font-style: italic;">Invoice no: </span>{{
                    modalData.invoice }} <br />
                <span style="font-weight: 900; text-transform: uppercase;font-style: italic;">Date: </span> {{
                    dateFormat(modalData.date) }}
            </p>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th class="text-center">
                            Description
                        </th>
                        <th class="text-center">
                            Quantity
                        </th>
                        <th class="text-end">
                            Bill
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
                        <td class="text-end">
                            {{ item.bill_amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-7"></div>
        <div class="col-5">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 47%;font-style: italic;font-weight: 900;">SubTotal</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.subtotal }}</td>
                </tr>
                <tr>
                    <td style="width: 47%;font-style: italic;font-weight: 900;">Discount</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.discount == undefined ? parseFloat(0).toFixed(2) : modalData.discount }}</td>
                </tr>
                <tr>
                    <td style="width: 47%;font-style: italic;font-weight: 900;">Transport Cost</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.shipping_charge }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom: 1px dashed gray;"></td>
                </tr>
                <tr>
                    <td style="width: 47%;font-style: italic;font-weight: 900;">Total</td>
                    <td>:</td>
                    <td class="text-end">{{ parseFloat(parseFloat(modalData.subtotal) + parseFloat(modalData.shipping_charge)).toFixed(2) }}</td>
                </tr>
                <tr>
                    <td style="width: 47%;font-style: italic;font-weight: 900;">Paid</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.total }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom: 1px dashed gray;"></td>
                </tr>
                <tr>
                    <td style="width: 47%;font-style: italic;font-weight: 900;">Due</td>
                    <td>:</td>
                    <td class="text-end">{{ modalData.due }}</td>
                </tr>
            </table>
        </div>
        <div class="col-12">
            <strong>In Word: </strong>{{ convertNumberToWords(modalData.total) }}<br>
            <strong>Note: </strong> {{ modalData.note }}
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
        getOrder() {
            axios.post("/admin/order/fetch", { id: this.id })
                .then(res => {
                    this.modalData = res.data.orders[0]
                })
        },
        dateFormat(data) {
            return moment(data).format("DD-MM-YYYY");
        },

        convertNumberToWords(amountToWord) {
            var words = new Array();
            words[0] = '';
            words[1] = 'One';
            words[2] = 'Two';
            words[3] = 'Three';
            words[4] = 'Four';
            words[5] = 'Five';
            words[6] = 'Six';
            words[7] = 'Seven';
            words[8] = 'Eight';
            words[9] = 'Nine';
            words[10] = 'Ten';
            words[11] = 'Eleven';
            words[12] = 'Twelve';
            words[13] = 'Thirteen';
            words[14] = 'Fourteen';
            words[15] = 'Fifteen';
            words[16] = 'Sixteen';
            words[17] = 'Seventeen';
            words[18] = 'Eighteen';
            words[19] = 'Nineteen';
            words[20] = 'Twenty';
            words[30] = 'Thirty';
            words[40] = 'Forty';
            words[50] = 'Fifty';
            words[60] = 'Sixty';
            words[70] = 'Seventy';
            words[80] = 'Eighty';
            words[90] = 'Ninety';
            let amount = amountToWord == null ? '0.00' : amountToWord.toString();
            var atemp = amount.split(".");
            var number = atemp[0].split(",").join("");
            var n_length = number.length;
            var words_string = "";
            if (n_length <= 9) {
                var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                var received_n_array = new Array();
                for (var i = 0; i < n_length; i++) {
                    received_n_array[i] = number.substr(i, 1);
                }
                for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                    n_array[i] = received_n_array[j];
                }
                for (var i = 0, j = 1; i < 9; i++, j++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        if (n_array[i] == 1) {
                            n_array[j] = 10 + parseInt(n_array[j]);
                            n_array[i] = 0;
                        }
                    }
                }
                let value = "";
                for (var i = 0; i < 9; i++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        value = n_array[i] * 10;
                    } else {
                        value = n_array[i];
                    }
                    if (value != 0) {
                        words_string += words[value] + " ";
                    }
                    if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Crores ";
                    }
                    if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Lakhs ";
                    }
                    if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Thousand ";
                    }
                    if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                        words_string += "Hundred and ";
                    } else if (i == 6 && value != 0) {
                        words_string += "Hundred ";
                    }
                }
                words_string = words_string.split("  ").join(" ");
            }
            return words_string + ' only';
        }
    }
};
</script>

<style scoped>
.table thead tr {
    border-color: black;
}

.table thead tr th {
    padding: 0 3px;
    border-color: black;
    color: black;
    font-weight: 900;
}

.table tbody tr {
    border-color: black;
}

.table tbody tr td {
    padding: 0 3px;
    border-color: black;
    color: black;
}
</style>