<template>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="saveSlider">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="image">Image <small>(1920px X 994px)</small> </label>
                                    <input type="file" id="image" class="form-control shadow-none" @change="imageUrl" />
                                </div>
                            </div>
                            <div class="col-md-5 d-flex">
                                <button type="submit" class="btn btn-sm btn-outline-success shadow-none" style="height: 31px;margin-top: 10%;">
                                    Save Slider
                                </button>
                                &nbsp;
                                <button type="button" @click="clearData"
                                    class="btn btn-sm btn-outline-danger shadow-none" style="height: 31px; margin-top: 10%;;">
                                    Reset
                                </button>
                            </div>

                            <img :src="imageSrc" class="imageShow mt-2" style="height: 70px;width: 250px;" />

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6" style="overflow-x: auto">
            <vue-good-table :columns="columns" :rows="sliders" :fixed-header="true" :pagination-options="{
                enabled: false,
                perPage: 15,
            }" :search-options="{ enabled: false }" :line-numbers="false" styleClass="vgt-table" max-height="550px">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.label =='Title'">
                        {{ props.row.title }}
                    </span>
                    <span v-if="props.column.label =='Image'">
                        <img :src="baseUrl+'/'+props.row.image" alt="image" style="height: 30px;">
                    </span>
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
                // {
                //     label: "Title",
                //     field: "title",
                // },

                {
                    label: 'Image',
                    field: 'image',
                    html: true
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
                description: "",
                image: ""
            },
            imageSrc: "/noImage.jpg",
            baseUrl :window.location.origin
        };
    },

    created() {
        this.getSlider();
    },

    methods: {
        getSlider() {
            axios.get("/admin/slider/fetch").then((res) => {
                this.sliders = res.data.data.filter(slide => slide.description = slide.description);
                // this.sliders = res.data;
            });
        },

        saveSlider(event) {
            // if (this.slider.name == "") {
            //     alert("Name Field is Empty");
            //     return;
            // }

            let formdata = new FormData(event.target)
            formdata.append("image", this.slider.image)
            formdata.append("id", this.slider.id)
            // formdata.append("description", this.slider.description != null ? this.slider.description : "")
            axios
                .post("/admin/slider", formdata)
                .then((res) => {

                    if(res.data == 'error')
                    {
                        $.notify(res.data.error.title[0], "error");
                    }else{
                        $.notify(res.data, "success");
                    }

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
            if (event.target.files[0] && event.target.files[0].size < 256000) {
                let img = new Image()
                img.src = window.URL.createObjectURL(event.target.files[0]);
                img.onload = () => {
                    if (img.width === 1920 && img.height === 994) {
                        this.imageSrc = window.URL.createObjectURL(event.target.files[0]);
                        this.slider.image = event.target.files[0];
                    } else {
                        alert(`This image ${img.width}px X ${img.height}px but require image 955px X 300px`);
                    }
                }
            }else{
                alert(`This file size too big ${parseFloat(event.target.files[0].size / 1024).toFixed(2)}kb. require size 250kb`)
            }
        },

        clearData() {
            this.slider = {
                id: "",
                title: "",
                using_by: "retail",
                description: ""
            };
            // $("#image").val('');
            this.getSlider()
            this.imageSrc = "/noImage.jpg"
        },
    },
};
</script>
