<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <v-select :options="managers" id="manager" label="name" v-model="selectedManager"
                                    @input="onChangeManager" placeholder="Area Manager Select"></v-select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="month" v-model="month" :max="max" class="form-control" />
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
                                    Customer Name
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Commission ({{
                                        selectedManager.commission
                                    }})%
                                </th>
                                <th class="text-white text-end" style="font-weight: bold">
                                    Order Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in commissions">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.customer_name }}</td>
                                <td class="text-center">
                                    {{
                                        selectedManager == null
                                        ? 0
                                        : parseFloat(
                                            (parseFloat(item.subtotal) *
                                                selectedManager.commission) /
                                            100
                                        ).toFixed(2)
                                    }}
                                    ৳
                                </td>
                                <td class="text-end">{{ item.subtotal }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end" style="font-weight: bold">
                                    Total
                                </th>
                                <th class="text-center" style="font-weight: bold">
                                    {{
                                        selectedManager == null
                                        ? 0
                                        : parseFloat(
                                            (commissions.reduce(
                                                (acc, pre) => {
                                                    return (
                                                        acc +
                                                        parseFloat(
                                                            pre.subtotal
                                                        )
                                                    );
                                                },
                                                0
                                            ) *
                                                selectedManager.commission) /
                                            100
                                        ).toFixed(2)
                                    }}
                                    ৳
                                </th>
                                <th class="text-end" style="font-weight: bold">
                                    {{
                                        commissions
                                            .reduce((acc, pre) => {
                                                return (
                                                    acc +
                                                    parseFloat(pre.subtotal)
                                                );
                                            }, 0)
                                            .toFixed(2)
                                    }}
                                </th>
                            </tr>
                            <tr v-if="parseFloat(totalCommission) > 0">
                                <td colspan="4" class="text-end">
                                    <button type="button" @click="modalShow"
                                        class="text-white btn btn-success shadow-none btn-sm">
                                        Payment Commission
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div v-else class="text-center">Not Found Data</div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                            Commission Payment
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="totalCommission">Total Commission</label>
                                    <input type="number" disabled min="0" step="0.01" class="form-control"
                                        id="totalCommission" name="totalCommission" v-model="totalCommission" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" @click="paymentCommission" class="btn btn-success text-white">
                            Payment
                        </button>
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
            max: moment().format("YYYY-MM"),
            month: moment().format("YYYY-MM"),
            managers: [],
            selectedManager: null,
            commissions: [],
            totalCommission: 0,
        };
    },

    created() {
        this.getCustomer();
    },

    methods: {
        onChangeManager() {
            this.commissions = [];
        },
        getCustomer() {
            axios.get("/admin/get-manager").then((res) => {
                this.managers = res.data.data;
            });
        },

        getCommission() {
            if (this.selectedManager == null) {
                alert("Area Manager Select");
                document.querySelector("#manager [type='search']").focus();
                return;
            }
            let formdata = {
                month: this.month,
                managerThana:
                    this.selectedManager != null
                        ? this.selectedManager.thana_id
                        : "",
            };
            axios.post("/admin/order/commission", formdata).then((res) => {
                this.commissions = res.data;
                this.totalCommission = parseFloat(
                    (this.commissions.reduce((acc, pre) => {
                        return acc + parseFloat(pre.subtotal);
                    }, 0) *
                        this.selectedManager.commission) /
                    100
                ).toFixed(2);
            });
        },

        modalShow() {
            $("#staticBackdrop").modal("show");
        },

        paymentCommission() {
            let formdata = {
                month: this.month,
                manager_id: this.selectedManager.id,
                amount: this.totalCommission,
            };
            axios.post("/admin/pay-commission", formdata).then((res) => {
                if (res.data.status) {
                    $.notify(res.data.msg, "success");
                    $("#staticBackdrop").modal("hide");
                } else {
                    console.log(res.data.msg);
                }
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
