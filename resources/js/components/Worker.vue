<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveWorker">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px solid #cdc9c9;">
                                        <div class="form-group mb-1">
                                            <label for="worker_code" class="pe-0">Worker Code<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="worker_code" v-model="form.worker_code"
                                                class="form-control" autocomplete="off" readonly>
                                            <span class="error-name error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="name" class="pe-0">Name<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="name" v-model="form.name" class="form-control"
                                                autocomplete="off" placeholder="Name">
                                            <span class="error-name error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="mobile" class="pe-0">Mobile<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="mobile" v-model="form.mobile" class="form-control"
                                                placeholder="Mobile" autocomplete="off">
                                            <span class="error-mobile error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="father_name" class="pe-0">Father Name<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="father_name" v-model="form.father_name"
                                                class="form-control" placeholder="Father Name" autocomplete="off">
                                            <span class="error-father_name error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="mother_name" class="pe-0">Mother Name<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="mother_name" v-model="form.mother_name"
                                                class="form-control" placeholder="Mother Name" autocomplete="off">
                                            <span class="error-mother_name error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1" v-show="ManagerOrAdmin">
                                            <label for="commission" class="pe-0 pe-md-0">Commission<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="input-group d-flex align-items-center">
                                                <input type="number" step="0.01" min="0" id="commission"
                                                    v-model="form.commission" class="form-control" placeholder="%"
                                                    autocomplete="off">
                                                <span style="background: #8b006d;padding: 4px;color: white;">%</span>
                                            </div>
                                            <span class="error-commission error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="category_id" class="pe-0">Category<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <v-select :options="categories" v-model="selectedCategory" multiple
                                                label="name"></v-select>
                                            <span class="error-category_id error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="present_address" class="pe-0">Present Address<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="present_address" v-model="form.present_address"
                                                class="form-control" placeholder="Present Address" autocomplete="off">
                                            <span class="error-present_address error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group mb-1">
                                            <label for="permanent_address" class="pe-0">Permanent Address<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="permanent_address" v-model="form.permanent_address"
                                                class="form-control" placeholder="Permanent Address" autocomplete="off">
                                            <span class="error-permanent_address error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="description" class="pe-0">Description</label>
                                            <input type="text" id="description" v-model="form.description"
                                                class="form-control" placeholder="Description" autocomplete="off">
                                            <span class="error-description error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="district_id" class="pe-0">District<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <v-select :options="districts" v-model="selectedDistrict" label="name"
                                                @input="onChangeDistrict"></v-select>
                                            <span class="error-district_id error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="thana_id" class="pe-0">Thana<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <v-select :options="thanas" v-model="selectedThana" label="name"
                                                @input="onChangeThana"></v-select>
                                            <span class="error-password error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="area_id" class="pe-0">Area<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <v-select :options="areas" v-model="selectedArea" label="name"
                                                @input="onChangeArea"></v-select>
                                            <span class="error-area_id error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="manager_id" class="pe-0">Manager<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <v-select :options="managers" v-model="selectedManager" label="name"></v-select>
                                            <span class="error-manager_id error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="nid" class="pe-0">NID<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="text" id="nid" v-model="form.nid" class="form-control"
                                                placeholder="NID" autocomplete="off">
                                            <span class="error-nid error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="reference" class="pe-0">Reference</label>
                                            <textarea id="reference" v-model="form.reference" class="form-control"
                                                placeholder="Reference" autocomplete="off"></textarea>
                                            <span class="error-reference error text-danger"></span>
                                        </div>

                                        <div class="form-group row text-end">
                                            <label for="" class="col-md-3"></label>
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-success text-light shadow-none">
                                                    <i class="fa fa-floppy-o pe-1" aria-hidden="true"></i>
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <div class="form-group ImageBackground">
                                    <p class="text-danger" style="text-align: center;font-size: 11px;margin: 0px;">150px X
                                        150px</p>
                                    <img :src="imageSrc" class="imageShow" />
                                    <label for="image">Photo</label>
                                    <input type="file" id="image" class="form-control shadow-none" @change="imageUrl" />
                                </div>
                            </div> -->

                            <div class="col-md-3" style="border-left: 1px solid #cdcdcd;">
                                <div class="form-group">
                                    <label class="form-label">
                                        Photo
                                    </label>
                                    <input type="file" accept="image/*" class="form-control" @change="imageUrl">
                                </div>
                                <div class="form-group">
                                    <label>Preview Photo</label>
                                    <img :src="imageSrc" id="m_photo" class="imageShow" style="max-height: 60px;" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        NID Front
                                        <sup class="text-danger" title="must be fillable">*</sup>
                                        <small class="text-danger" style="font-size: 11px">150px x 150px</small>
                                    </label>
                                    <input type="file" name="nid_front_img" accept="image/*" class="form-control"
                                        @change="nidFrontUrl">
                                </div>
                                <div class="form-group">
                                    <label>Preview NID Front</label>
                                    <img :src="nidFrontSrc" class="img-fluid" alt="nid_front" style="max-height: 60px;">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        NID Back
                                        <sup class="text-danger" title="must be fillable">*</sup>
                                        <small class="text-danger" style="font-size: 11px">150px x 150px</small>
                                    </label>
                                    <!-- <input type="file" accept="image/*" class="form-control" @change="nidBackUrl" onchange="document.getElementById('nidBack').src = window.URL.createObjectURL(this.files[0])" > -->
                                    <input type="file" name="nid_back_img" accept="image/*" class="form-control"
                                        @change="nidBackUrl">
                                </div>
                                <div class="form-group">
                                    <label>Preview NID Back</label>
                                    <img :src="nidBackSrc" id="nidBack" class="img-fluid" alt="nid_back"
                                        style="max-height: 60px;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- list of category -->
        <div class="col-md-12" style="overflow-x: auto">
            <vue-good-table :columns="columns" :rows="workers" :fixed-header="false" :pagination-options="{
                enabled: true,
                perPage: 10,
            }" :search-options="{ enabled: true }" :line-numbers="true" styleClass="vgt-table striped bordered"
                max-height="550px">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'img'">
                    </span>
                </template>
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'after'">
                        <a href="" @click.prevent="editRow(props.row)">
                            <i class="fas fa-edit text-info"></i>
                        </a>

                        <a href="" @click.prevent="deleteRow(props.row.id)">
                            <i class="fas fa-trash text-danger"></i>
                        </a>

                        <a v-if="role == 'Superadmin' || role == 'admin'" href="" @click.prevent="statusRow(props.row.id)">
                            <span v-if="props.row.status == 'p'">
                                <i class="fas fa-arrow-up text-success" title="Worker Status Active. Click To Change"></i>
                            </span>
                            <span v-else>
                                <i class="fas fa-arrow-down text-warning"
                                    title="Worker Status Deactive. Click To Change"></i>
                            </span>
                        </a>
                    </span>
                </template>
            </vue-good-table>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            props: [
                'admin_id',
                'role',
                'district_id',
                'thana_id',
            ],
            linkHref: location.origin,
            form: new Form({
                id: "",
                worker_code: "",
                name: "",
                mobile: "",
                father_name: "",
                mother_name: "",
                commission: 0,
                nid: "",
                category_id: [],
                manager_id: "",
                district_id: "",
                thana_id: "",
                area_id: "",
                present_address: "",
                permanent_address: "",
                description: "",
                reference: "",
                image: "",
            }),
            imageSrc: "/noImage.jpg",
            nidFrontSrc: "/noImage.jpg",
            nidBackSrc: "/noImage.jpg",
            workers: [],

            districts: [],
            selectedDistrict: null,
            thanas: [],
            selectedThana: null,
            areas: [],
            selectedArea: null,
            managers: [],
            selectedManager: null,
            categories: [],
            selectedCategory: [],
            columns: [
                { label: "Image", field: "img", html: true, },
                { label: 'Name', field: 'name' },
                { label: 'Mobile', field: 'mobile' },
                { label: 'Father', field: 'father_name' },
                { label: 'Mother', field: 'mother_name' },
                { label: "Action", field: "after" },
            ],
            // rows: [],
            // page: 1,
            // per_page: 10,

            adminId: "",
            role: "",
            district_id: "",
            thana_id: "",
            ManagerOrAdmin: true,
        }
    },

    created() {
        this.getWorker();
        this.getDistrict();
        this.getCategory();

        this.adminId = this.$attrs.admin_id
        this.role = this.$attrs.role
        this.district_id = this.$attrs.district_id
        this.thana_id = this.$attrs.thana_id
    },

    methods: {
        getAreaManager() {
            axios.get("/admin/get-manager")
                .then(res => {
                    this.managers = res.data.manager.filter(item => item.thana_id == this.selectedThana.id);
                })
        },

        getCategory() {
            axios.get("/admin/category/fetch").then((res) => {
                this.categories = res.data.data;
            });
        },

        getDistrict() {
            axios.get("/admin/district/fetch")
                .then(res => {
                    if (this.role == 'manager') {
                        this.districts = res.data.data.filter(d => d.id == this.district_id)
                        this.selectedDistrict = {
                            id: this.districts[0].id,
                            name: this.districts[0].name,
                        }
                        this.getThana();
                    } else {
                        this.districts = res.data.data
                    }
                })
        },

        onChangeDistrict() {
            if (this.role != 'manager') {
                if (this.selectedDistrict != null) {
                    this.selectedThana = null;
                    this.getThana();
                }
            } else {
                this.selectedThana = null;
                this.getThana();
            }
        },

        getThana() {
            axios.get("/admin/thana/fetch")
                .then(res => {
                    if (this.role != 'manager') {
                        this.thanas = res.data.data.filter(th => {
                            return th.district_id == this.selectedDistrict.id
                        })
                    } else {
                        this.thanas = res.data.data.filter(th => th.id == this.thana_id)
                        this.selectedThana = {
                            id: this.thanas[0].id,
                            name: this.thanas[0].name,
                        }
                        this.getAreaManager();
                    }
                })
        },
        onChangeThana() {
            if (this.role != 'manager') {
                if (this.selectedThana != null) {
                    this.selectedArea = null;
                    this.getAreas();
                }
            } else {
                this.selectedArea = null;
                this.getAreas();
            }
        },
        getAreas() {
            axios.get("/admin/area/fetch")
                .then(res => {
                    if (this.role != 'manager') {
                        this.areas = res.data.data.filter(th => {
                            return th.upazila_id == this.selectedThana.id
                        })
                    } else {
                        this.areas = res.data.data.filter(th => th.id == this.thana_id)
                        this.selectedThana = {
                            id: this.areas[0].id,
                            name: this.areas[0].name,
                        }
                    }
                })
        },

        onChangeArea() {
            this.selectedManager = null
            this.getAreaManager();
        },

        getWorker() {
            axios.get("/admin/get-worker")
                .then(res => {
                    this.form.worker_code = res.data.worker_code;
                    this.workers = res.data.workers.map(c => {
                        c.img = c.image == null ? '<img src="/noImage.jpg" width="40px">' : '<img src="/' + c.image + '" width="40px">'
                        return c;
                    })
                })
        },

        saveWorker() {
            if (this.selectedDistrict == null) {
                alert("District Select")
                return
            }
            if (this.selectedThana == null) {
                alert("Thana Select")
                return
            }
            if (this.selectedManager == null) {
                alert("Manager Select")
                return
            }
            if (this.selectedCategory == null) {
                alert("Category Select")
                return
            }
            this.form.manager_id = this.selectedManager.id;
            this.form.district_id = this.selectedDistrict.id;
            this.form.thana_id = this.selectedThana.id;
            this.form.area_id = this.selectedArea.id;

            let cate_id = [];
            this.selectedCategory.map(function (value, key) {
                cate_id.push(value.id);
            });

            this.form.category_id = cate_id;
            let url = "/admin/worker";
            if (this.form.id != '') {
                url = "/admin/update/worker";
            }
            this.form.post(url).then(res => {
                if (res.data.status == "error") {
                    $.notify(res.data.msg, "error");
                    this.showError(res.data.msg);
                    return
                }
                if (res.data.status == "success") {
                    $.notify(res.data.msg, "success");
                    this.clearData();
                    this.getWorker();
                }
            });
        },

        showError(error) {
            if (error.name) {
                $('#name').addClass('is-invalid');
            } else {
                $('#name').removeClass('is-invalid');
            }
            if (error.father_name) {
                $('#father_name').addClass('is-invalid');
            } else {
                $('#father_name').removeClass('is-invalid');
            }
            if (error.mother_name) {
                $('#mother_name').addClass('is-invalid');
            } else {
                $('#mother_name').removeClass('is-invalid');
            }
            if (error.mobile) {
                $('#mobile').addClass('is-invalid');
            } else {
                $('#mobile').removeClass('is-invalid');
            }
        },

        editRow(val) {
            if (this.role == 'manager') {
                this.ManagerOrAdmin = false;
            }

            this.form.id = val.id;
            this.form.worker_code = val.worker_code;
            this.form.name = val.name;
            this.form.father_name = val.father_name;
            this.form.mother_name = val.mother_name;
            this.form.mobile = val.mobile;
            this.form.commission = val.commission;
            this.form.nid = val.nid;

            this.form.category_id = JSON.parse(val.category_id);
            let cats = [];
            val.categories.map(function (value, key) {
                cats.push(value);
            });

            this.selectedCategory = cats;

            this.form.manager_id = val.manager_id;
            this.form.district_id = val.district_id;
            this.form.thana_id = val.thana_id;
            this.form.area_id = val.area_id;
            this.form.present_address = val.present_address;
            this.form.permanent_address = val.permanent_address;
            this.form.description = val.description;
            this.form.reference = val.reference;
            this.imageSrc = val.image != null ? '/' + val.image : "/noImage.jpg";
            this.nidFrontSrc = val.nid_front_img != null ? '/' + val.nid_front_img : "/noImage.jpg"
            this.nidBackSrc = val.nid_back_img != null ? '/' + val.nid_back_img : "/noImage.jpg"

            if (val.manager_id) {
                this.selectedManager = {
                    id: val.manager_id,
                    name: val.manager.name,
                }
            } else {
                this.selectedManager = null
            }
            this.selectedDistrict = {
                id: val.district_id,
                name: val.thana.district.name,
            }
            this.getThana();
            this.selectedThana = {
                id: val.thana_id,
                name: val.thana.name
            }

            this.getAreas();
            this.selectedArea = {
                id: val.area_id,
                name: val.area.name
            }

            this.getAreaManager();
            this.selectedManager = {
                id: val.manager_id,
                name: val.manager.name
            }
        },

        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post("/admin/worker/delete", { id: id }).then((res) => {
                    $.notify(res.data.msg, "success");
                    this.getWorker();
                });
            }
        },

        statusRow(id) {
            if (confirm("Are you sure want to change status!")) {
                axios.post("/admin/worker/change_status", { id: id }).then((res) => {
                    $.notify(res.data.msg, "success");
                    this.getWorker();
                });
            }
        },

        imageUrl(event) {
            // if (event.target.files[0] && event.target.files[0].size < 256000) {
            //     let img = new Image()
            //     img.src = window.URL.createObjectURL(event.target.files[0]);
            //     img.onload = () => {
            //         if (img.width === 150 && img.height === 150) {
            this.imageSrc = window.URL.createObjectURL(event.target.files[0]);
            this.form.image = event.target.files[0];
            //         } else {
            //             alert(`This image ${img.width}px X ${img.height}px but require image 150px X 150px`);
            //         }
            //     }
            // }else{
            //     alert(`This file size too big ${parseFloat(event.target.files[0].size / 1024).toFixed(2)}kb. require size 250kb`)
            // }
        },

        nidFrontUrl(event) {
            // if (event.target.files[0] && event.target.files[0].size < 256000) {
            //     let img = new Image()
            //     img.src = window.URL.createObjectURL(event.target.files[0]);
            //     img.onload = () => {
            //         if (img.width === 150 && img.height === 95) {
            this.nidFrontSrc = window.URL.createObjectURL(event.target.files[0]);
            this.form.nid_front_img = event.target.files[0];
            //         } else {
            //             alert(`This image ${img.width}px X ${img.height}px but require image 150px X 95px`);
            //         }
            //     }
            // }else{
            //     alert(`This file size too big ${parseFloat(event.target.files[0].size / 1024).toFixed(2)}kb. require size 250kb`)
            // }
        },

        nidBackUrl(event) {
            // if (event.target.files[0] && event.target.files[0].size < 256000) {
            //     let img = new Image()
            //     img.src = window.URL.createObjectURL(event.target.files[0]);
            //     img.onload = () => {
            //         if (img.width === 150 && img.height === 95) {
            this.nidBackSrc = window.URL.createObjectURL(event.target.files[0]);
            this.form.nid_back_img = event.target.files[0];
            //         } else {
            //             alert(`This image ${img.width}px X ${img.height}px but require image 150px X 95px`);
            //         }
            //     }
            // }else{
            //     alert(`This file size too big ${parseFloat(event.target.files[0].size / 1024).toFixed(2)}kb. require size 250kb`)
            // }
        },

        clearData() {
            this.form.id = "";
            this.form.worker_code = "";
            this.form.name = "";
            this.form.father_name = "";
            this.form.mother_name = "";
            this.form.mobile = "";
            this.form.commission = 0;
            this.form.nid = "";
            this.form.district_id = "";
            this.form.thana_id = "";
            this.form.area_id = "";
            this.form.present_address = "";
            this.form.permanent_address = "";
            this.form.description = "";
            this.form.reference = "";
            this.imageSrc = "/noImage.jpg",
                delete (this.form.image)
            this.nidFrontSrc = "/noImage.jpg",
                delete (this.form.nid_front_img)
            this.nidBackSrc = "/noImage.jpg",
                delete (this.form.nid_back_img)

            this.selectedDistrict = null;
            this.thanas = [];
            this.selectedThana = null;
            this.selectedArea = null;
            this.selectedManager = null;
            this.selectedCategory = null;
        }
    },

}
</script>
