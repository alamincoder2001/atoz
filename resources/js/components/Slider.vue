<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveSlider">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row mt-2">
                                    <label for="title" class="col-4 col-md-3 d-flex align-items-center">Title:</label>
                                    <div class="col-8 col-md-9">
                                        <input type="text" name="title" v-model="slider.title" id="title"
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="description" class="col-4 col-md-3 d-flex align-items-center">Description:</label>
                                    <div class="col-8 col-md-9">
                                        <ckeditor id="description" :editor="editor" v-model="slider.description"></ckeditor>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="previous_due" class="col-4 col-md-3 d-flex align-items-center"></label>
                                    <div class="col-8 col-md-9 text-end">
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
                            <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
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
                id: "",
                title: "",
                using_by: "retail",
                description: "",
                image: ""
            },
            imageSrc: "/noImage.jpg",
        };
    },

    created() {
        this.getSlider();
    },

    methods: {
        getSlider() {
            axios.get("/admin/slider/fetch").then((res) => {
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
                .post("/admin/slider", formdata)
                .then((res) => {
                    $.notify(res.data, "success");
                    this.clearData();
                    this.getSlider();
                });
        },

        editRow(val) {
            this.slider = {
                id: val.id,
                title: val.title,
                using_by: val.using_by,
                description: val.description
            };
            this.imageSrc = val.image != null ? "/" + val.image : "/noImage.jpg"
        },
        deleteRow(id) {
            if (confirm("Are you sure want to delete this!")) {
                axios.post("/admin/slider/delete", { id: id }).then((res) => {
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
                using_by: "retail",
                description: "",
            };
            this.getSlider()
            this.imageSrc = "/noImage.jpg"
        },
    },
};
</script>