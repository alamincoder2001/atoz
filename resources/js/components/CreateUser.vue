<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveUser">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
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
                                            <label for="name" class="col-md-3">User Name<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="username" v-model="form.username"
                                                    class="form-control" placeholder="User Name" autocomplete="off">
                                                <span class="error-username error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-md-3">Email<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="email" id="email" v-model="form.email" class="form-control"
                                                    placeholder="Email" autocomplete="off">
                                                <span class="error-email error text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-md-3">Role<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <select id="role" v-model="form.role" class="form-select shadow-none">
                                                    <option value="">Select Role</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                                <span class="error-role error text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-md-3">Password<span
                                                    class="text-danger fw-bold">*</span></label>
                                            <div class="col-md-9">
                                                <input type="password" id="password" v-model="form.password"
                                                    class="form-control" placeholder="Password" autocomplete="off">
                                                <span class="error-password error text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row text-end">
                                            <label for="name" class="col-md-3"></label>
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
                        <span v-if="props.row.role != 'Superadmin'">
                            <a v-if="props.row.role != 'admin'" title="User Access" class="text-danger"
                                :href="`${linkHref + '/admin/user/permission/' + props.row.id}`">
                                <i class="fas fa-users text-warning"></i>
                            </a>
                            <a href="" @click.prevent="editRow(props.row)">
                                <i class="fas fa-edit text-info"></i>
                            </a>
                            <a v-if="props.row.role != 'admin'" @click.prevent="deleteRow(props.row.id)">
                                <i class="fas fa-trash text-danger"></i>
                            </a>
                        </span>
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
            ],
            linkHref: location.origin,
            form: new Form({
                id: "",
                name: "",
                username: "",
                email: "",
                role: "",
                password: "",
            }),
            imageSrc: "/noImage.jpg",
            users: [],

            columns: [
                { label: "Image", field: "img", html: true, },
                { label: 'Name', field: 'name' },
                { label: 'User Name', field: 'username' },
                { label: 'Email', field: 'email' },
                { label: 'Role', field: 'role', html: true },
                { label: "Action", field: "after" },
            ],
            // rows: [],
            // page: 1,
            // per_page: 10,
        }
    },

    created() {
        this.getUser();
        this.userId = this.$attrs.admin_id;
    },

    methods: {
        getUser() {
            axios.get("/admin/get-user")
                .then(res => {
                    this.users = res.data.data.map(c => {
                        c.img = c.image == null ? '<img src="/noImage.jpg" width="40px">' : '<img src="/' + c.image + '" width="40px">'
                        c.role
                        return c;
                    })
                })

        },

        saveUser() {
            let url = "/admin/user";
            if (this.form.id != '') {
                url = "/admin/update/user";
            }
            this.form.post(url).then(res => {
                if (res.data.status == "error") {
                    this.showError(res.data.msg);
                    return
                }
                $.notify(res.data.msg, "success");

                if (res.data.status) {
                    this.clearData();
                    this.getUser();
                }
            });
        },

        showError(error) {
            if (error.name) {
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
            if (error.role) {
                $('#role').addClass('is-invalid');
            } else {
                $('#role').removeClass('is-invalid');
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
            this.form.role = val.role;
            this.imageSrc = val.image != null ? '/' + val.image : "/noImage.jpg"
        },

        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post("/admin/user/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getUser();
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
            this.form.name = "";
            this.form.username = "";
            this.form.email = "";
            this.form.role = "";
            this.form.password = "";
            this.imageSrc = "/noImage.jpg",
                delete (this.form.image)
        }
    },
}
</script>
