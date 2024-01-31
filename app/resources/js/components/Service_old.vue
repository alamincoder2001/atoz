<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveService">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="service_code" class="col-5 col-lg-4 d-flex align-items-center">Service
                                        Code:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="service_code" name="service_code" readonly
                                            class="form-control shadow-none" v-model="service.service_code"
                                            autocomplete="off" />
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
                                    <label for="name" class="col-5 col-lg-4 d-flex align-items-center">Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" id="name" name="name" class="form-control shadow-none"
                                            v-model="service.name" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <ckeditor :editor="editor" v-model="service.description"></ckeditor>
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
                                            Save Service
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 d-flex justify-content-center align-items-center">
                                <div class="form-group ImageBackground text-center">
                                    <p class="text-danger" style="text-align: center;font-size: 11px;margin: 0px;">350px X
                                        250px</p>
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
            <vue-good-table :columns="columns" :rows="services" :fixed-header="true" :pagination-options="{
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
                    field: "service_code",
                },
                {
                    label: "Service Name",
                    field: "name",
                },
                {
                    label: "Category",
                    field: "category_name",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            services: [],
            service: {
                id: "",
                name: "",
                description: "",
                image: ""
            },
            categories: [],
            selectedCategory: null,

            imageSrc: "/noImage.jpg",
        };
    },

    created() {
        this.getCategory();
        this.getService();
    },

    methods: {
        getCategory() {
            axios.get("/admin/category/fetch").then((res) => {
                this.categories = res.data.data;
            });
        },
        getService() {
            axios.get("/admin/service/fetch").then((res) => {
                this.services = res.data.data;
                this.service.service_code = res.data.service_code;
            });
        },

        saveService(event) {
            if (this.service.name == "") {
                alert("Name Field is Empty");
                return;
            }

            let formdata = new FormData(event.target)
            formdata.append("image", this.service.image)
            formdata.append("id", this.service.id)
            formdata.append("category_id", this.selectedCategory != null ? this.selectedCategory.id : "")
            formdata.append("description", this.service.description != null ? this.service.description : "")
            axios
                .post("/admin/service", formdata)
                .then((res) => {
                    if (res.data.status) {
                        $.notify(res.data.msg, "success");
                        this.clearData();
                        this.getService();
                    }else{
                        console.log(res.data.msg)
                    }
                });
        },

        editRow(val) {
            this.service = {
                id: val.id,
                service_code: val.service_code,
                name: val.name,
                description: val.description
            };
            this.selectedCategory = {
                id: val.category_id,
                name: val.category_name,
            }

            this.imageSrc = val.image != null ? "/" + val.image : "/noImage.jpg"
        },
        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post("/admin/service/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getService();
                });
            }
        },

        imageUrl(event) {
            if (event.target.files[0] && event.target.files[0].size < 256000) {
                let img = new Image()
                img.src = window.URL.createObjectURL(event.target.files[0]);
                img.onload = () => {
                    if (img.width === 350 && img.height === 250) {
                        this.imageSrc = window.URL.createObjectURL(event.target.files[0]);
                        this.service.image = event.target.files[0];
                    } else {
                        alert(`This image ${img.width}px X ${img.height}px but require image 350px X 250px`);
                    }
                }
            }else{
                alert(`This file size too big ${parseFloat(event.target.files[0].size / 1024).toFixed(2)}kb. require size 250kb`)
            }
        },

        clearData() {
            this.service = {
                id: "",
                name: "",
                description: "",
                image: "",
            };
            this.selectedCategory = null
            this.getService()
            this.imageSrc = "/noImage.jpg"
        },
    },
};
</script>

<style>
#category [role="combobox"] {
    padding: 0 !important;
}
</style>
