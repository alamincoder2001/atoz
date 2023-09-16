<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveBlog">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="title"
                                        class="col-5 col-lg-4 d-flex align-items-center">Title:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" name="title" v-model="blog.title" id="title" class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="date"
                                        class="col-5 col-lg-4 d-flex align-items-center">Publish Date:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="date" name="date" id="date" v-model="blog.date" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <ckeditor :editor="editor" v-model="blog.description"></ckeditor>
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
                                            Save Blog
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 d-flex justify-content-center align-items-center">
                                <div class="form-group ImageBackground">
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
            <vue-good-table :columns="columns" :rows="blogs" :fixed-header="true" :pagination-options="{
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
import moment from 'moment';
export default {
    data() {
        return {
            editor: ClassicEditor,
            columns: [
                {
                    label: "Blog Title",
                    field: "title",
                },
                {
                    label: "Publish Date",
                    field: "date",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            blogs: [],
            blog: {
                id: "",
                title: "",
                date: moment().format("YYYY-MM-DD"),
                description: "",
                image: ""
            },
            imageSrc: location.origin + "/noImage.jpg",
        };
    },

    created() {
        this.getBlog();
    },

    methods: {
        getBlog() {
            axios.get(location.origin + "/admin/blog/fetch").then((res) => {
                this.blogs = res.data.data;
            });
        },

        saveBlog(event) {
            if (this.blog.name == "") {
                alert("Name Field is Empty");
                return;
            }

            let formdata = new FormData(event.target)
            formdata.append("image", this.blog.image)
            formdata.append("id", this.blog.id)           
            formdata.append("description", this.blog.description != null ? this.blog.description : "")
            axios
                .post(location.origin + "/admin/blog", formdata)
                .then((res) => {
                    $.notify(res.data, "success");
                    this.clearData();
                    this.getBlog();
                });
        },

        editRow(val) {
            this.blog = {
                id: val.id,
                title: val.title,
                date: val.date,
                description:val.description
            };            
            this.imageSrc = val.image != null ? location.origin + "/" + val.image : location.origin + "/noImage.jpg"
        },
        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post(location.origin + "/admin/blog/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getBlog();
                });
            }
        },

        imageUrl(event) {
            if (event.target.files[0]) {
                let img = new Image()
                img.src = window.URL.createObjectURL(event.target.files[0]);
                img.onload = () => {
                    if (img.width === 1024 && img.height === 400) {
                        this.imageSrc = window.URL.createObjectURL(event.target.files[0]);
                        this.blog.image = event.target.files[0];
                    } else {
                        alert(`This image ${img.width} X ${img.width} but require image 1024 X 400`);
                    }
                }
            }
        },

        clearData() {
            this.blog = {
                id: "",
                title: "",
                date: moment().format("YYYY-MM-DD"),
                description: "",
            };
            this.getBlog()
            this.imageSrc = location.origin + "/noImage.jpg"
        },
    },
};
</script>