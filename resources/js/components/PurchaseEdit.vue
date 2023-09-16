<template>
    <div class="container-fluid px-4 mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-bottom:10px !important;">
                    <div class="card-header">
                        <div class="row">
                            <label for="invoice" class="col-4 col-lg-1 d-flex align-items-center m-0">Invoice:</label>
                            <div class="col-8 col-lg-2">
                                <input type="text" v-model="purchase.invoice" readonly class="form-control shadow-none">
                            </div>

                            <label for="category" class="col-4 col-lg-2 d-flex align-items-center m-0">Category:</label>
                            <div class="col-8 col-lg-3">
                                <v-select label="name" id="category" name="category_id" :options="categories"
                                    v-model="selectedCategory" @input="CategoryChange"></v-select>
                            </div>

                            <label for="invoice" class="col-4 col-lg-1 d-flex align-items-center m-0">Brand:</label>
                            <div class="col-8 col-lg-3">
                                <v-select label="name" @input="BrandChange" id="brand" name="brand_id" :options="brands"
                                    v-model="selectedBrand">
                                </v-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="card" style="margin-bottom:10px !important;">
                    <div class="card-header">
                        <h4 style="margin:0;">Supplier && Product Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="row mt-2">
                                    <label for="supplier_id"
                                        class="col-5 col-lg-4 d-flex align-items-center">Supplier:</label>
                                    <div class="col-7 col-lg-8">
                                        <div class="input-group">
                                            <v-select label="display_name" id="supplier" name="supplier_id"
                                                :options="suppliers" v-model="selectedSupplier"
                                                @input="onChangeSupplier"></v-select>
                                            <a href="/admin/supplier" target="_blank"
                                                class="btn btn-success shadow-none"
                                                style="width:14.5%;padding: 4px 8px;display: flex;justify-content: center;align-items: center;"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2"
                                    :style="{ display: selectedSupplier.supplier_type != 'G' ? 'none' : '' }">
                                    <label for="name" class="col-5 col-lg-4 d-flex align-items-center">Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="name" name="name" class="form-control shadow-none"
                                            v-model="selectedSupplier.name" autocomplete="off"
                                            :readonly="selectedSupplier.supplier_type != 'G' ? true : false" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="mobile" class="col-5 col-lg-4 d-flex align-items-center">Mobile:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="mobile" name="mobile" class="form-control shadow-none"
                                            v-model="selectedSupplier.mobile" autocomplete="off"
                                            :readonly="selectedSupplier.supplier_type != 'G' ? true : false" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="address"
                                        class="col-5 col-lg-4 d-flex align-items-center">Address:</label>
                                    <div class="col-7 col-lg-8">
                                        <textarea id="address" name="address" class="form-control shadow-none"
                                            v-model="selectedSupplier.address" autocomplete="off"
                                            :readonly="selectedSupplier.supplier_type != 'G' ? true : false"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row mt-2">
                                    <label for="product_id"
                                        class="col-5 col-lg-4 d-flex align-items-center">Product:</label>
                                    <div class="col-7 col-lg-8">
                                        <div class="input-group">
                                            <v-select label="display_name" id="product" name="product_id"
                                                :options="products" v-model="selectedProduct" @input="onChangeProduct">
                                            </v-select>
                                            <a href="/admin/product" target="_blank" class="btn btn-success shadow-none"
                                                style="width:14.5%;padding: 4px 8px;display: flex;justify-content: center;align-items: center;"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="purchase_rate"
                                        class="col-5 col-lg-4 d-flex align-items-center">Pur.Rate:</label>
                                    <div class="col-7 col-lg-3 pe-lg-0">
                                        <input type="text" id="purchase_rate" name="purchase_rate"
                                            class="form-control shadow-none" @input="cartQtyPurchaseChange"
                                            v-model="selectedProduct.purchase_rate" autocomplete="off" />
                                    </div>
                                    <label for="quantity" class="col-5 col-lg-1 d-flex align-items-center">Qty:</label>
                                    <div class="col-7 col-lg-4">
                                        <input type="number" id="quantity" name="quantity"
                                            v-model="selectedProduct.quantity" @input="cartQtyPurchaseChange"
                                            class="form-control shadow-none" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="selling_rate" class="col-5 col-lg-4 d-flex align-items-center">Sale
                                        Rate:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="number" id="selling_rate" name="selling_rate"
                                            class="form-control shadow-none" v-model="selectedProduct.selling_rate"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="total_amount" class="col-5 col-lg-4 d-flex align-items-center">Total
                                        Amount:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="number" id="total_amount" name="total_amount"
                                            v-model="selectedProduct.total_amount" class="form-control shadow-none"
                                            autocomplete="off" readonly />
                                    </div>
                                </div>
                                <div class="form-group text-end mt-2">
                                    <button class="btn btn-primary shadow-none" @click="AddToCart">AddToCart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-0" style="margin-bottom:10px !important;">
                    <div class="card-body p-lg-0" style="overflow-x:auto;">
                        <table class="table table-bordered">
                            <thead style="background: gray;color: white;">
                                <tr>
                                    <th class="text-center">Sl</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Purchase Rate</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in carts" :key="index">
                                    <td class="text-center">{{ index + 1 }}</td>
                                    <td class="text-center">{{ item.name }}</td>
                                    <td class="text-center">{{ item.purchase_rate }}</td>
                                    <td class="text-center">{{ item.quantity }}</td>
                                    <td class="text-center">{{ item.total_amount }}</td>
                                    <td class="text-center">
                                        <button @click="removeCart(item)"
                                            class="btn shadow-none btn-sm btn-danger border-0"
                                            style="border-radius: 0;">remove</button>
                                    </td>
                                </tr>
                                <tr v-if="carts.length != 0">
                                    <td colspan="4" class="text-center">
                                        <div class="form-group row">
                                            <label for="note" class="col-5">Note:</label>
                                            <div class="col-7">
                                                <textarea name="note" id="note" v-model="purchase.note"
                                                    class="form-control shadow-none"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center" colspan="2" style="font-weight: bold;"><span>Total:
                                        </span>{{
                                            carts.reduce((acc,
                                                c) => { return +acc + +c.total_amount }, 0).toFixed(2)
                                        }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card" style="margin-bottom:10px !important;">
                    <div class="card-header">
                        <h4 style="margin:0;">Amount Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form @submit.prevent="savePurchase">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="date" id="date" v-model="purchase.date"
                                            class="form-control shadow-none" />
                                    </div>
                                    <div class="form-group">
                                        <label for="subtotal">SubTotal:</label>
                                        <input type="number" id="subtotal" name="subtotal" v-model="purchase.subtotal"
                                            class="form-control shadow-none" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vat">Vat:</label>
                                        <div class="row">
                                            <div class="col-6 col-lg-7">
                                                <div class="input-group">
                                                    <input type="number" min="0" style="height:30px;" id="vat"
                                                        name="vat" @input="TotalAmount" v-model="purchase.vat"
                                                        class="form-control shadow-none"><span
                                                        style="height:30px;line-height:1;"
                                                        class="btn btn-warning">%</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-5">
                                                <input type="text" id="vat_amount" name="vat_amount"
                                                    v-model="purchase.vat_amount" class="form-control shadow-none"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount">Discount:</label>
                                        <div class="row">
                                            <div class="col-6 col-lg-7">
                                                <div class="input-group">
                                                    <input type="number" min="0" style="height:30px;" id="discount"
                                                        @input="TotalAmount" name="discount" v-model="purchase.discount"
                                                        class="form-control shadow-none"><span
                                                        style="height:30px;line-height:1;"
                                                        class="btn btn-warning">%</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-5">
                                                <input type="text" id="discount_amount" name="discount_amount"
                                                    v-model="purchase.discount_amount" class="form-control shadow-none"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="transport_cost">Labour Cost/Transport Cost:</label>
                                        <input type="number" min="0" id="transport_cost" name="transport_cost"
                                            @input="TotalAmount" v-model="purchase.transport_cost"
                                            class="form-control shadow-none">
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total:</label>
                                        <input type="number" id="total" name="total" v-model="purchase.total"
                                            class="form-control shadow-none" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paid">Paid:</label>
                                        <input type="number" min="0" step="0.01" id="paid" name="paid"
                                            @input="TotalAmount" v-model="purchase.paid"
                                            class="form-control shadow-none"
                                            :readonly="selectedSupplier.supplier_type == 'G' ? true : false">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="due">Due:</label>
                                                <input type="text" id="due" name="due" v-model="purchase.due"
                                                    class="form-control shadow-none"
                                                    :style="{ color: purchase.due < 0 ? 'red' : 'black' }" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="previous_due">Pre.Due:</label>
                                                <input type="text" id="previous_due" :value="purchase.previous_due"
                                                    :style="{ color: purchase.previous_due != 0 ? 'red' : 'black' }"
                                                    class="form-control shadow-none" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-5">
                                            <button type="button"
                                                class="btn btn-secondary shadow-none w-100">Reset</button>
                                        </div>
                                        <div class="col-7">
                                            <button type="submit"
                                                class="btn btn-success shadow-none w-100">Purchase</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
var moment = require('moment');
export default {
    template: '#purchase-edit',
    props: ['invoiceNumber'],

    data() {
        return {
            invoice: this.invoiceNumber,
            categories: [],
            selectedCategory: {
                id: "",
                name: "Select Category"
            },
            brands: [],
            selectedBrand: {
                id: "",
                name: "Select Brand"
            },
            suppliers: [],
            selectedSupplier: {
                id: "",
                display_name: "Select Suplier",
                name: "",
                mobile: "",
                address: "",
                supplier_type: "",
                previous_due: 0,
            },
            products: [],
            products1: [],
            selectedProduct: {
                id: '',
                product_code: '',
                display_name: 'Select Product',
                name: '',
                quantity: '',
                purchase_rate: '',
                selling_rate: 0.00,
                total_amount: ''
            },
            carts: [],
            purchase: {
                id: "",
                date: moment(new Date()).format("YYYY-MM-DD"),
                subtotal: 0,
                total: 0,
                paid: 0,
                vat: 0,
                vat_amount: 0,
                discount: 0,
                previous_due: 0,
                discount_amount: 0,
                transport_cost: 0,
                due: 0,
                invoice: "",
                note: "",
            },
        }
    },
    created() {
        this.getPurchase();
        this.getCategory();
        this.getBrand();
        this.getSupplier();
        this.getProduct();
    },
    methods: {
        getCategory() {
            axios.get("/admin/category/fetch").then((res) => {
                this.categories = res.data.data;
                this.categories.unshift({ id: 0, name: "Select Category" })
            });
        },
        getBrand() {
            axios.get("/admin/brand/fetch").then((res) => {
                this.brands = res.data.data;
                this.brands.unshift({ id: 0, name: "Select Brand" })
            });
        },
        getSupplier() {
            axios.get("/admin/supplier/fetch").then((res) => {
                this.suppliers = res.data.data.filter(s => s.supplier_type != "G");
                this.suppliers.unshift({ id: 0, display_name: "General Supplier", supplier_type: "G" })
            });
        },
        getProduct() {
            axios.get("/admin/product/fetch").then((res) => {
                this.products = res.data.data;
                this.products1 = res.data.data;
                this.products.unshift({ id: 0, display_name: "Select Product" })
            });
        },
        getPurchase() {
            let data = { invoice: this.invoice }
            axios.post("/admin/purchase/fetch", data).then((res) => {
                this.purchase = res.data.purchases[0]
                this.carts = res.data.purchases[0].purchaseDetails
                if (res.data.purchases[0].account_id) {
                    this.selectedAccount = {
                        id: res.data.purchases[0].account_id,
                        display_name: res.data.purchases[0].bank_display_name
                    }
                }
                if (res.data.purchases[0].supplier_type == "G") {
                    this.selectedSupplier = {
                        id: res.data.purchases[0].supplier_id,
                        name: res.data.purchases[0].name,
                        display_name: "General Supplier",
                        mobile: res.data.purchases[0].mobile,
                        address: res.data.purchases[0].address,
                        supplier_type: res.data.purchases[0].supplier_type
                    }
                } else {
                    this.selectedSupplier = {
                        id: res.data.purchases[0].supplier_id,
                        name: res.data.purchases[0].name,
                        display_name: res.data.purchases[0].display_name,
                        mobile: res.data.purchases[0].mobile,
                        address: res.data.purchases[0].address,
                        supplier_type: res.data.purchases[0].supplier_type
                    }
                }
            });
        },
        onChangeSupplier() {
            if (this.selectedSupplier == null) {
                this.selectedSupplier = {
                    id: "",
                    name: "",
                    display_name: "",
                    mobile: "",
                    address: "",
                    supplier_type: "",
                    previous_due: 0,
                }
                return
            }
            if (this.selectedSupplier.id == "") {
                this.purchase.previous_due = 0
                this.TotalAmount();
                return
            }
        },
        onChangeProduct() {
            if (this.selectedProduct == null) {
                this.selectedProduct = {
                    id: "",
                    display_name: "",
                    name: "",
                    quantity: "",
                    purchase_rate: "",
                    selling_rate: "",
                }
                return
            }
        },
        cartQtyPurchaseChange() {
            this.selectedProduct.total_amount = (this.selectedProduct.quantity * this.selectedProduct.purchase_rate).toFixed(2)
        },
        AddToCart() {
            if (this.selectedProduct.id != "") {
                let cartInd = this.carts.findIndex(p => p.product_id == this.selectedProduct.id);
                if (cartInd > -1) {
                    this.carts.splice(cartInd, 1)
                }
                if (this.selectedProduct.id == "") {
                    alert("Must be select product")
                    document.querySelector("#product [type='search']").focus()
                    return
                }
                if (this.selectedProduct.quantity == undefined) {
                    alert("Quantity increment must")
                    document.querySelector("#quantity").focus()
                    return
                }
                this.product = {
                    product_id: this.selectedProduct.id,
                    name: this.selectedProduct.name,
                    purchase_rate: this.selectedProduct.purchase_rate,
                    selling_rate: this.selectedProduct.selling_rate,
                    quantity: this.selectedProduct.quantity,
                    total_amount: this.selectedProduct.total_amount,
                }
                this.carts.push(this.product)
                this.selectedProduct = {
                    id: "",
                    display_name: "",
                    name: "",
                    purchase_rate: "",
                    selling_rate: "",
                }
                this.TotalAmount()
            } else {
                alert("Product Select First")
                document.querySelector("#product [type='search']").focus()
            }
        },
        TotalAmount() {
            this.purchase.subtotal = this.carts.reduce((acc, pre) => { return (+parseFloat(acc) + +parseFloat(pre.total_amount)).toFixed(2) }, 0)
            this.purchase.due = this.purchase.subtotal
            this.purchase.total = this.purchase.subtotal
            //vat calculate
            this.purchase.vat_amount = ((parseFloat(this.purchase.subtotal) * this.purchase.vat) / 100).toFixed(2)
            this.purchase.total = (parseFloat(this.purchase.total) + parseFloat(this.purchase.vat_amount)).toFixed(2)
            //discount calculate
            this.purchase.discount_amount = ((parseFloat(this.purchase.subtotal) * this.purchase.discount) / 100).toFixed(2)
            this.purchase.total = (parseFloat(this.purchase.total) - parseFloat(this.purchase.discount_amount)).toFixed(2)
            //transport_cost calculate
            this.purchase.total = (+parseFloat(this.purchase.total) + +this.purchase.transport_cost).toFixed(2)
            //total paid claculate
            this.purchase.due = (parseFloat(this.purchase.total) - parseFloat(this.purchase.paid)).toFixed(2)
            if (this.selectedSupplier.supplier_type == "G") {
                this.purchase.paid = this.purchase.total
                this.purchase.due = 0
            }
        },
        removeCart(item) {
            var index = this.carts.indexOf(item);
            this.carts.splice(index, 1);
            this.TotalAmount()
        },
        savePurchase(event) {
            if (this.selectedSupplier.name == "") {
                alert("Select Supplier")
                document.querySelector("#supplier [type='search']").focus()
                return
            }
            if (this.carts.length == 0) {
                alert("Cart is Empty")
                document.querySelector("#product [type='search']").focus()
                return
            }
            let data = {
                purchase: this.purchase,
                carts: this.carts,
                supplier: this.selectedSupplier
            }
            axios.post("/admin/purchase", data)
                .then(res => {
                    $.notify(res.data.msg, "success");
                    if (confirm("Are you sure want print")) {
                        
                    }else{
                        location.href = "/admin/purchaseList"
                    }
                    this.clearData()
                    this.getPurchase()
                    this.carts = [];
                })
        },
        clearData() {
            this.purchase = {
                id: "",
                date: moment(new Date()).format("YYYY-MM-DD"),
                subtotal: 0,
                total: 0,
                paid: 0,
                vat: 0,
                vat_amount: 0,
                discount: 0,
                previous_due: 0,
                discount_amount: 0,
                transport_cost: 0,
                due: 0,
                invoice: "",
                note: "",
            }
            this.selectedSupplier = {
                id: "",
                name: "",
            }
        },
        CategoryChange() {
            if (this.selectedCategory.id == 0) {
                this.products = this.products1
                return
            }
            this.products = this.products1.filter(p => p.category_id == this.selectedCategory.id);
        },
        BrandChange() {
            if (this.selectedBrand.id == 0) {
                this.products = this.products1
                return
            }
            this.products = this.products1.filter(p => p.brand_id == this.selectedBrand.id);
        },
    },
};
</script>


<style>
#category [role="combobox"] {
    padding: 0 !important;
}

#brand {
    width: 100% !important;
}

#brand [role="combobox"] {
    padding: 0 !important;
}

#supplier {
    width: 85.5% !important;
}

#supplier [role="combobox"] {
    padding: 0 !important;
}

#product {
    width: 85.5% !important;
}

#product [role="combobox"] {
    padding: 0 !important;
}

.vs__selected-options {
    overflow: hidden;
}

.vs__selected {
    position: absolute;
    top: 0px;
    left: 3px;
}

#supplier [role='listbox'] {
    width: 300px !important;
}

#product [role='listbox'] {
    width: 300px !important;
}

@media screen and (min-device-width: 360px) and (max-device-width: 768px) {
    #supplier {
        width: 80% !important;
    }

    #product {
        width: 80% !important;
    }
}
</style>