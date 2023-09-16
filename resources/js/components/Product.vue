<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveProduct">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="product_code" class="col-5 col-lg-4 d-flex align-items-center">Product
                                        Code:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="product_code" name="product_code" readonly
                                            class="form-control shadow-none" v-model="product.product_code"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="brand_id" class="col-5 col-lg-4 d-flex align-items-center">Brand:</label>
                                    <div class="col-7 col-lg-8">
                                        <v-select :options="brands" name="brand_id" id="brand" v-model="selectedBrand"
                                            label="name"></v-select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="category_id"
                                        class="col-5 col-lg-4 d-flex align-items-center">Category:</label>
                                    <div class="col-7 col-lg-8">
                                        <v-select :options="categories" name="category_id" id="category"
                                            v-model="selectedCategory" label="name"></v-select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="category_id"
                                        class="col-5 col-lg-4 d-flex align-items-center">SubCategory:</label>
                                    <div class="col-7 col-lg-8">
                                        <v-select :options="subcategories" name="subcategory_id" id="subcategory"
                                            v-model="selectedSubcategory" label="name"></v-select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="name" class="col-5 col-lg-4 d-flex align-items-center">Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="name" name="name" class="form-control shadow-none"
                                            v-model="product.name" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="unit_id" class="col-5 col-lg-4 d-flex align-items-center">Unit:</label>
                                    <div class="col-7 col-lg-8">
                                        <v-select :options="units" name="unit_id" id="unit" v-model="selectedUnit"
                                            label="name"></v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="vat" class="col-5 col-lg-4 d-flex align-items-center">Vat:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="number" min="0" step="0.01" id="vat" name="vat"
                                            class="form-control shadow-none" v-model="product.vat" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="selling_rate" class="col-5 col-lg-4 d-flex align-items-center">Sale
                                        Rate:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="number" min="0" step="0.01" id="selling_rate" name="selling_rate"
                                            class="form-control shadow-none" v-model="product.selling_rate"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="wholesale_rate" class="col-5 col-lg-4 d-flex align-items-center">Wholesale
                                        Rate:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="number" min="0" step="0.01" id="wholesale_rate" name="wholesale_rate"
                                            class="form-control shadow-none" v-model="product.wholesale_rate"
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <ckeditor :editor="editor" v-model="product.description"></ckeditor>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="previous_due" class="col-5 col-lg-4 d-flex align-items-center"></label>
                                    <div class="col-7 col-lg-8 text-end">
                                        <button type="button" @click="clearData"
                                            class="btn btn-sm btn-outline-secondary shadow-none">
                                            Reset
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-outline-success shadow-none">
                                            Save Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 d-flex justify-content-center align-items-center">
                                <div class="form-group ImageBackground text-center">
                                    <span class="text-danger">(350 X 350)</span>
                                    <img :src="imageSrc" class="imageShow" />
                                    <label for="image">Image</label>
                                    <input type="file" id="image" class="form-control shadow-none" @change="imageUrl" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12" style="overflow-x: auto">
            <vue-good-table :columns="columns" :rows="products" :fixed-header="true" :pagination-options="{
                enabled: true,
                perPage: 15,
            }" :search-options="{ enabled: true }" :line-numbers="true" styleClass="vgt-table" max-height="550px">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'before'">
                        <button class="btn btn-sm btn-outline-primary shadow-none" @click="editRow(props.row)">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-outline-danger shadow-none" @click="deleteRow(props.row.id)">
                            Delete
                        </button>
                    </span>
                </template>
            </vue-good-table>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data() {
        return {
            editor: ClassicEditor,
            columns: [
                {
                    label: "Code",
                    field: "product_code",
                },
                {
                    label: "Product Name",
                    field: "name",
                },
                {
                    label: "Brand",
                    field: "brand_name",
                },
                {
                    label: "Category",
                    field: "category_name",
                },
                {
                    label: "Vat",
                    field: "vat",
                },
                {
                    label: "Sale Rate",
                    field: "selling_rate",
                },
                {
                    label: "Wholesale Rate",
                    field: "wholesale_rate",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            products: [],
            product: {
                id: "",
                name: "",
                brand_id: "",
                subcategory_id: "",
                unit_id: "",
                vat: 0,
                re_order: 0,
                purchase_rate: 0,
                selling_rate: 0,
                wholesale_rate: 0,
                description: "",
                image: ""
            },
            brands: [],
            selectedBrand: null,
            categories: [],
            selectedCategory: null,
            subcategories: [],
            selectedSubcategory: null,
            units: [],
            selectedUnit: null,

            imageSrc: location.origin + "/noImage.jpg",
        };
    },

    created() {
        this.getBrand();
        this.getCategory();
        this.getSubcategory();
        this.getUnit();
        this.getProduct();
    },

    methods: {
        getBrand() {
            axios.get(location.origin + "/admin/brand/fetch").then((res) => {
                this.brands = res.data.data;
            });
        },
        getCategory() {
            axios.get(location.origin + "/admin/category/fetch").then((res) => {
                this.categories = res.data.data;
            });
        },
        getSubcategory() {
            axios.get(location.origin + "/admin/subcategory/fetch").then((res) => {
                this.subcategories = res.data.data;
            });
        },
        getUnit() {
            axios.get(location.origin + "/admin/unit/fetch").then((res) => {
                this.units = res.data.data;
            });
        },
        getProduct() {
            axios.get(location.origin + "/admin/product/fetch").then((res) => {
                this.products = res.data.data;
                this.product.product_code = res.data.product_code;
            });
        },

        saveProduct(event) {
            if (this.product.name == "") {
                alert("Name Field is Empty");
                return;
            }

            let formdata = new FormData(event.target)
            formdata.append("image", this.product.image)
            formdata.append("id", this.product.id)
            formdata.append("brand_id", this.selectedBrand != null ? this.selectedBrand.id : "")
            formdata.append("category_id", this.selectedCategory != null ? this.selectedCategory.id : "")
            formdata.append("subcategory_id", this.selectedSubcategory != null ? this.selectedSubcategory.id : "")
            formdata.append("unit_id", this.selectedUnit != null ? this.selectedUnit.id : "")
            formdata.append("description", this.product.description != null ? this.product.description : "")
            axios
                .post(location.origin + "/admin/product", formdata)
                .then((res) => {
                    $.notify(res.data, "success");
                    this.clearData();
                    this.getProduct();
                });
        },

        editRow(val) {
            this.product = {
                id: val.id,
                product_code: val.product_code,
                name: val.name,
                brand_id: val.brand_id,
                subcategory_id: val.subcategory_id,
                unit_id: val.unit_id,
                vat: val.vat,
                re_order: val.re_order,
                purchase_rate: val.purchase_rate,
                selling_rate: val.selling_rate,
                wholesale_rate: val.wholesale_rate,
                description: val.description
            };
            this.selectedBrand = {
                id: val.brand_id,
                name: val.brand_name,
            }
            this.selectedCategory = {
                id: val.category_id,
                name: val.category_name,
            }
            this.selectedSubcategory = {
                id: val.subcategory_id,
                name: val.subcategory_name,
            }
            this.selectedUnit = {
                id: val.unit_id,
                name: val.unit_name,
            }

            this.imageSrc = val.image != null ? location.origin + "/" + val.image : location.origin + "/noImage.jpg"
        },
        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post(location.origin + "/admin/product/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getProduct();
                });
            }
        },

        imageUrl(event) {
            if (event.target.files[0]) {
                let img = new Image()
                img.src = window.URL.createObjectURL(event.target.files[0]);
                img.onload = () => {
                    if (img.width === 350 && img.height === 350) {
                        this.imageSrc = window.URL.createObjectURL(event.target.files[0]);
                        this.product.image = event.target.files[0];
                    } else {
                        alert(`This image ${img.width}px X ${img.height}px but require image 350px X 350px`);
                    }
                }
            }
        },

        clearData() {
            this.product = {
                id: "",
                name: "",
                brand_id: "",
                subcategory_id: "",
                unit_id: "",
                vat: 0,
                re_order: 0,
                purchase_rate: 0,
                selling_rate: 0,
                wholesale_rate: 0,
                description: "",
            };
            this.selectedBrand = null
            this.selectedCategory = null
            this.selectedSubcategory = null
            this.selectedUnit = null
            this.getProduct()
            this.imageSrc = location.origin + "/noImage.jpg"
        },
    },
};
</script>

<style>
#brand [role="combobox"] {
    padding: 0 !important;
}

#category [role="combobox"] {
    padding: 0 !important;
}

#subcategory [role="combobox"] {
    padding: 0 !important;
}

#unit [role="combobox"] {
    padding: 0 !important;
}
</style>