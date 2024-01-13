<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveUser">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="name" class="">Name<span class="text-danger fw-bold">*</span></label>
                                                <input type="text" id="name" v-model="form.name" class="form-control"
                                                    autocomplete="off" placeholder="Name">
                                                <span class="error-name error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="username" class="">User Name<span
                                                    class="text-danger fw-bold">*</span></label>
                                                <input type="text" id="username" v-model="form.username"
                                                    class="form-control" placeholder="User Name" autocomplete="off">
                                                <span class="error-username error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="email" class="col-md-3">Email<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="email" id="email" v-model="form.email" class="form-control"
                                                placeholder="Email" autocomplete="off">
                                            <span class="error-email error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="father_name" class="pe-0">Father<span
                                                    class="text-danger fw-bold">*</span></label>
                                                <input type="text" id="father_name" v-model="form.father_name"
                                                    class="form-control" placeholder="Father Name" autocomplete="off">
                                            <span class="error-father_name error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="mother_name" class="pe-0">Mother<span
                                                    class="text-danger fw-bold">*</span></label>
                                                    <input type="text" id="mother_name" v-model="form.mother_name"
                                                        class="form-control" placeholder="Mother Name" autocomplete="off">
                                            <span class="error-mother_name error text-danger"></span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="present_address" class="pe-0">Present Address<span class="text-danger fw-bold">*</span></label>
                                                <input type="text" id="present_address" v-model="form.present_address"
                                                    class="form-control" placeholder="Present Address" autocomplete="off">
                                            <span class="error-present_address error text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="permanent_address" class="pe-0">Permanent Address<span class="text-danger fw-bold">*</span></label>
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
                                            <label for="commission" class="col-md-3 pe-0">Commission<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="input-group d-flex align-items-center">
                                                <input type="number" step="0.01" min="0" id="commission" v-model="form.commission"
                                                    class="form-control" placeholder="%" autocomplete="off">
                                                <span style="background: #8b006d;padding: 4px;color: white;">%</span>
                                            </div>
                                            <span class="error-commission error text-danger"></span>
                                        </div>

                                        <div class="form-group mb-1">
                                            <label for="district_id" class="">District<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <v-select :options="districts" v-model="selectedDistrict" label="name"
                                                @input="onChangeDistrict"></v-select>
                                            <span class="error-district_id error text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="thana_id" class="">Thana<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <v-select :options="thanas" v-model="selectedThana" label="name"></v-select>
                                            <span class="error-thana_id error text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="">Password<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <input type="password" id="password" v-model="form.password"
                                                class="form-control" placeholder="Password" autocomplete="off">
                                            <span class="error-password error text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row text-end">
                                        <label for="save" class="col-md-3"></label>
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-success text-light shadow-none">
                                                <i class="fa fa-floppy-o pe-1" aria-hidden="true"></i>
                                                Save
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3" style="border-left: 1px solid #cdcdcd;">
                                <div class="form-group">
                                    <label class="form-label">
                                        Photo
                                    </label>
                                    <input type="file" accept="image/*" class="form-control" @change="imageUrl" >
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
                                        <input type="file" name="nid_front_img" accept="image/*" class="form-control" @change="nidFrontUrl" >
                                </div>
                                <div class="form-group">
                                    <label>Preview NID Front</label>
                                    <img :src="nidFrontSrc" class="img-fluid" alt="nid_front" style="max-height: 60px;" >
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        NID Back
                                        <sup class="text-danger" title="must be fillable">*</sup>
                                        <small class="text-danger" style="font-size: 11px">150px x 150px</small>
                                    </label>
                                        <!-- <input type="file" accept="image/*" class="form-control" @change="nidBackUrl" onchange="document.getElementById('nidBack').src = window.URL.createObjectURL(this.files[0])" > -->
                                        <input type="file" name="nid_back_img" accept="image/*" class="form-control" @change="nidBackUrl" >
                                </div>
                                <div class="form-group">
                                    <label>Preview NID Back</label>
                                    <img :src="nidBackSrc" id="nidBack" class="img-fluid" alt="nid_back" style="max-height: 60px;">
                                </div>

                                <!-- <div class="form-group ImageBackground">
                                    <p class="text-danger" style="text-align: center;font-size: 11px;margin: 0px;">150px X 150px</p>
                                    <img :src="imageSrc" class="imageShow" />
                                    <label for="image">Photo</label>
                                    <input type="file" class="form-control shadow-none" @change="imageUrl" />
                                </div> -->

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- list of category -->
        <div class="col-md-12" style="overflow-x: auto">
            <vue-good-table :columns="columns" :rows="users" :fixed-header="false" :pagination-options="{
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
            linkHref: location.origin,
            form: new Form({
                id: "",
                name: "",
                username: "",
                email: "",
                role: "manager",
                password: "",
                district_id: "",
                thana_id: "",
                father_name: "",
                mother_name: "",
                present_address: "",
                permanent_address: "",
                description: "",
                commission: 0,
            }),
            imageSrc: "/noImage.jpg",
            nidFrontSrc: "/noImage.jpg",
            nidBackSrc: "/noImage.jpg",
            users: [],

            districts: [],
            selectedDistrict: null,
            thanas: [],
            selectedThana: null,

            columns: [
                { label: "Image", field: "img", html: true, },
                { label: 'Name', field: 'name' },
                { label: 'User Name', field: 'username' },
                { label: 'Email', field: 'email' },
                { label: "Action", field: "after" },
            ],
            // rows: [],
            // page: 1,
            // per_page: 10,
        }
    },

    created() {
        this.getUser();
        this.getDistrict();
    },

    methods: {
        getDistrict() {
            axios.get("/admin/district/fetch")
                .then(res => {
                    this.districts = res.data.data
                })
        },
        onChangeDistrict() {
            if (this.selectedDistrict != null) {
                this.thanas = [];
                this.selectedThana = null;
                this.getThana();
            }
        },
        getThana() {
            axios.get("/admin/thana/fetch")
                .then(res => {
                    this.thanas = res.data.data.filter(th => {
                        return th.district_id == this.selectedDistrict.id
                    })
                })
        },
        getUser() {
            axios.get("/admin/get-manager")
            .then(res => {
                this.users = res.data.manager.map(c => {
                    c.img = c.image == null ? '<img src="/noImage.jpg" width="40px">' : '<img src="/' + c.image + '" width="40px">'
                    return c;
                })
            })
        },

        saveUser() {
            if (this.selectedDistrict == null) {
                alert("District Select")
                return
            }
            if (this.selectedThana == null) {
                alert("Thana Select")
                return
            }
            this.form.district_id = this.selectedDistrict.id;
            this.form.thana_id = this.selectedThana.id;

            let url = "/admin/manager";
            if (this.form.id != '') {
                url = "/admin/update/manager";
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
                    this.getUser();
                }
            });
        },

        showError(error) {
            if (error.name) {
                $.notify(error.name, "error");
                $('#name').addClass('is-invalid');
            } else {
                $('#name').removeClass('is-invalid');
            }
            if (error.username) {
                $('#username').addClass('is-invalid');
            } else {
                $('#username').removeClass('is-invalid');
            }
            if (error.email) {
                $('#email').addClass('is-invalid');
            } else {
                $('#email').removeClass('is-invalid');
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
            if (error.present_address) {
                $('#present_address').addClass('is-invalid');
            } else {
                $('#present_address').removeClass('is-invalid');
            }
            if (error.permanent_address) {
                $('#permanent_address').addClass('is-invalid');
            } else {
                $('#permanent_address').removeClass('is-invalid');
            }
            if (error.password) {
                $('#password').addClass('is-invalid');
            } else {
                $('#password').removeClass('is-invalid');
            }
        },

        editRow(val) {
            this.form.id = val.id;
            this.form.name = val.name;
            this.form.username = val.username;
            this.form.email = val.email;
            this.form.father_name = val.father_name;
            this.form.mother_name = val.mother_name;
            this.form.role = val.role;
            this.form.district_id = val.district_id;
            this.form.thana_id = val.thana_id;
            this.form.present_address = val.present_address;
            this.form.permanent_address = val.permanent_address;
            this.form.description = val.description;
            this.form.commission = val.commission;
            this.imageSrc = val.image != null ? '/' + val.image : "/noImage.jpg"
            this.nidFrontSrc = val.nid_front_img != null ? '/' + val.nid_front_img : "/noImage.jpg"
            this.nidBackSrc = val.nid_back_img != null ? '/' + val.nid_back_img : "/noImage.jpg"

            this.selectedDistrict = {
                id: val.district_id,
                name: val.thana.district.name,
            }
            this.getThana();
            this.selectedThana = {
                id: val.thana_id,
                name: val.thana.name
            }
        },

        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post("/admin/manager/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getUser();
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
            this.form.name = "";
            this.form.username = "";
            this.form.email = "";
            this.form.role = "manager";
            this.form.password = "";
            this.form.district_id = "";
            this.form.thana_id = "";
            this.form.father_name = "";
            this.form.mother_name = "";
            this.form.present_address = "";
            this.form.permanent_address = "";
            this.form.description = "";
            this.form.commission = 0;
            this.imageSrc = "/noImage.jpg",
                delete (this.form.image)
            this.nidFrontSrc = "/noImage.jpg",
                delete (this.form.nid_front_img)
            this.nidBackSrc = "/noImage.jpg",
                delete (this.form.nid_back_img)

            this.selectedDistrict = null;
            this.thanas = [];
            this.selectedThana = null;
        }
    },
}
</script>
