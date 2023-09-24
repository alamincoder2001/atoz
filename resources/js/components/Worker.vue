<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveWorker">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="worker_code" class="col-md-3">Code<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="worker_code" v-model="form.worker_code"
                                                    class="form-control" autocomplete="off" readonly>
                                                <span class="error-name error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-md-3">Name<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="name" v-model="form.name" class="form-control"
                                                    autocomplete="off" placeholder="Name">
                                                <span class="error-name error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="mobile" class="col-md-3">Mobile<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="mobile" v-model="form.mobile" class="form-control"
                                                    placeholder="Mobile" autocomplete="off">
                                                <span class="error-mobile error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="father_name" class="col-md-3">Father<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="father_name" v-model="form.father_name"
                                                    class="form-control" placeholder="Father Name" autocomplete="off">
                                                <span class="error-father_name error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="mother_name" class="col-md-3">Mother<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="mother_name" v-model="form.mother_name"
                                                    class="form-control" placeholder="Mother Name" autocomplete="off">
                                                <span class="error-mother_name error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="commission" class="col-md-3 pe-md-0">Commission<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="number" id="commission" v-model="form.commission"
                                                    class="form-control" placeholder="%" autocomplete="off">
                                                <span class="error-commission error text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="district_id" class="col-md-3">District<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <v-select :options="districts" v-model="selectedDistrict" label="name"
                                                    @input="onChangeDistrict"></v-select>
                                                <span class="error-district_id error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="thana_id" class="col-md-3">Thana<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <v-select :options="thanas" v-model="selectedThana" label="name"
                                                    @input="onChangeThana"></v-select>
                                                <span class="error-password error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="manager_id" class="col-md-3">Manager<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <v-select :options="managers" v-model="selectedManager"
                                                    label="name"></v-select>
                                                <span class="error-manager_id error text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="address" class="col-md-3">Address<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <textarea id="address" v-model="form.address" class="form-control"
                                                    placeholder="Address" autocomplete="off"></textarea>
                                                <span class="error-address error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="reference" class="col-md-3">Reference<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <textarea id="reference" v-model="form.reference" class="form-control"
                                                    placeholder="Reference" autocomplete="off"></textarea>
                                                <span class="error-reference error text-danger"></span>
                                            </div>
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
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <div class="form-group ImageBackground">
                                    <p class="text-danger" style="text-align: center;font-size: 11px;margin: 0px;">150px X
                                        150px</p>
                                    <img :src="imageSrc" class="imageShow" />
                                    <label for="image">Photo</label>
                                    <input type="file" id="image" class="form-control shadow-none" @change="imageUrl" />
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
                manager_id: "",
                district_id: "",
                thana_id: "",
                address: "",
                reference: "",
                image: "",
            }),
            imageSrc: "/noImage.jpg",
            workers: [],

            districts: [],
            selectedDistrict: null,
            thanas: [],
            selectedThana: null,
            managers: [],
            selectedManager: null,
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
        }
    },

    created() {
        this.getWorker();
        this.getDistrict();

        this.adminId = this.$attrs.admin_id
        this.role = this.$attrs.role
        this.district_id = this.$attrs.district_id
        this.thana_id = this.$attrs.thana_id
    },

    methods: {
        onChangeThana() {
            this.selectedManager = null
            this.getAreaManager();
        },
        getAreaManager() {
            axios.get("/admin/get-manager")
                .then(res => {
                    this.managers = res.data.data.filter(manager => manager.thana_id == this.selectedThana.id);
                })
        },
        getDistrict() {
            axios.get("/admin/district/fetch")
                .then(res => {
                    if (this.role == 'manager') {
                        this.districts = res.data.data.filter(d => d.id == this.district_id)
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
                    }
                })
        },
        getWorker() {
            axios.get("/admin/get-worker")
                .then(res => {
                    this.form.worker_code = res.data.worker_code
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
                alert("Thana Select")
                return
            }
            this.form.manager_id = this.selectedManager.id;
            this.form.district_id = this.selectedDistrict.id;
            this.form.thana_id = this.selectedThana.id;
            let url = "/admin/worker";
            if (this.form.id != '') {
                url = "/admin/update/worker";
            }
            this.form.post(url).then(res => {
                if (res.data.status == "error") {
                    this.showError(res.data.msg);
                    return
                }
                $.notify(res.data.msg, "success");

                if (res.data.status) {
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
            this.form.id = val.id;
            this.form.worker_code = val.worker_code;
            this.form.name = val.name;
            this.form.father_name = val.father_name;
            this.form.mother_name = val.mother_name;
            this.form.mobile = val.mobile;
            this.form.commission = val.commission;
            this.form.manager_id = val.manager_id;
            this.form.district_id = val.district_id;
            this.form.thana_id = val.thana_id;
            this.form.address = val.address;
            this.form.reference = val.reference;
            this.imageSrc = val.image != null ? '/' + val.image : "/noImage.jpg";

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

            this.getAreaManager();
        },

        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post("/admin/worker/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getWorker();
                });
            }
        },

        imageUrl(event) {
            if (event.target.files[0]) {
                let img = new Image()
                img.src = window.URL.createObjectURL(event.target.files[0]);
                img.onload = () => {
                    if (img.width === 150 && img.height === 150) {
                        this.imageSrc = window.URL.createObjectURL(event.target.files[0]);
                        this.form.image = event.target.files[0];
                    } else {
                        alert(`This image ${img.width}px X ${img.height}px but require image 150px X 150px`);
                    }
                }
            }
        },

        clearData() {
            this.form.id = "";
            this.form.worker_code = "";
            this.form.name = "";
            this.form.father_name = "";
            this.form.mother_name = "";
            this.form.mobile = "";
            this.form.commission = 0;
            this.form.district_id = "";
            this.form.thana_id = "";
            this.form.address = "";
            this.form.reference = "";
            this.imageSrc = "/noImage.jpg",
                delete (this.form.image)

            this.selectedDistrict = null;
            this.thanas = [];
            this.selectedThana = null;
            this.selectedManager = null;
        }
    },
}
</script>
