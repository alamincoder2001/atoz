<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveSlider">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="title"
                                        class="col-5 col-lg-4 d-flex align-items-center">Title:</label>
                                    <div class="col-7 col-lg-8">
                                        <input type="text" name="title" v-model="slider.title" id="title" class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="date"
                                        class="col-5 col-lg-4 d-flex align-items-center">For Customer:</label>
                                    <div class="col-7 col-lg-8">
                                        <select name="using_by" class="form-select shadow-none" v-model="slider.using_by">
                                            <option value="retail">Retail Customer</option>
                                            <option value="wholesale">Wholesale Customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <ckeditor :editor="editor" v-model="slider.description"></ckeditor>
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
                                            Save Slider
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
            <vue-good-table :columns="columns" :rows="sliders" :fixed-header="true" :pagination-options="{
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
                    label: "Slider Title",
                    field: "title",
                },
                {
                    label: "For Customer",
                    field: "using_by",
                },
                {
                    label: "Description",
                    field: "description",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            sliders: [],
            slider: {
                id         : "",
                title      : "",
                using_by   : "retail",
                description: "",
                image      : ""
            },
            imageSrc: location.origin + "/noImage.jpg",
        };
    },

    created() {
        this.getSlider();
    },

    methods: {
        getSlider() {
            axios.get(location.origin + "/admin/slider/fetch").then((res) => {
                this.sliders = res.data.data.filter(slide => slide.description = slide.description.replace(/(<([^>]+)>)/gi, ""));
            });
        },

        saveSlider(event) {
            if (this.slider.name == "") {
                alert("Name Field is Empty");
                return;
            }

            let formdata = new FormData(event.target)
            formdata.append("image", this.slider.image)
            formdata.append("id", this.slider.id)           
            formdata.append("description", this.slider.description != null ? this.slider.description : "")
            axios
                .post(location.origin + "/admin/slider", formdata)
                .then((res) => {
                    $.notify(res.data, "success");
                    this.clearData();
                    this.getSlider();
                });
        },

        editRow(val) {
            this.slider = {
                id         : val.id,
                title      : val.title,
                using_by   : val.using_by,
                description: val.description
            };            
            this.imageSrc = val.image != null ? location.origin + "/" + val.image : location.origin + "/noImage.jpg"
        },
        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post(location.origin + "/admin/slider/delete", { id: id }).then((res) => {
                    $.notify(res.data, "success");
                    this.getSlider();
                });
            }
        },

        imageUrl(event) {
            if (event.target.files[0]) {
                let img = new Image()
                img.src = window.URL.createObjectURL(event.target.files[0]);
                img.onload = () => {
                    if (img.width === 955 && img.height === 300) {
                        this.imageSrc = window.URL.createObjectURL(event.target.files[0]);
                        this.slider.image = event.target.files[0];
                    } else {
                        alert(`This image ${img.width}px X ${img.width}px but require image 955px X 300px`);
                    }
                }
            }
        },

        clearData() {
            this.slider = {
                id: "",
                title: "",
                using_by   : "retail",
                description: "",
            };
            this.getSlider()
            this.imageSrc = location.origin + "/noImage.jpg"
        },
    },
};
</script>