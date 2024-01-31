<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="savePublished">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <label for="category_id" class="col-5 col-lg-4 d-flex align-items-center">Category
                                        Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <v-select :options="categories" id="category_id" v-model="selectedCategory"
                                            label="name"></v-select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="product_id" class="col-5 col-lg-4 d-flex align-items-center">Service
                                        Name:</label>
                                    <div class="col-7 col-lg-8">
                                        <v-select :options="services" id="product_id" v-model="selectedService"
                                            label="display_name"></v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row mt-2">
                                    <span class="col-5 col-lg-4 d-flex align-items-center"></span>
                                    <div class="col-7 col-lg-8">
                                        <input type="checkbox" id="is_arrival" class="form-check-input shadow-none m-0"
                                            name="is_arrival" v-model="published.is_arrival" :checked="published.is_arrival == true
                                                " />
                                        <label for="is_arrival">Is Arrival</label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-5 col-lg-4 d-flex align-items-center"></span>
                                    <div class="col-7 col-lg-8">
                                        <input type="checkbox" id="is_feature" name="is_feature"
                                            class="form-check-input shadow-none m-0" v-model="published.is_feature"
                                            :checked="published.is_feature == true
                                                " />
                                        <label for="is_feature">Is Feature</label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-5 col-lg-4 d-flex align-items-center"></span>
                                    <div class="col-7 col-lg-8">
                                        <input type="checkbox" id="is_popular" name="is_popular"
                                            class="form-check-input shadow-none m-0" v-model="published.is_popular"
                                            :checked="published.is_popular == true
                                                " />
                                        <label for="is_popular">Is Popular</label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-5 col-lg-4 d-flex align-items-center"></span>
                                    <div class="col-7 col-lg-8">
                                        <input type="checkbox" id="is_topsold" name="is_topsold"
                                            class="form-check-input shadow-none m-0" v-model="published.is_topsold"
                                            :checked="published.is_topsold == true
                                                " />
                                        <label for="is_topsold">Is TopSold</label>
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
                        <button class="btn btn-sm btn-outline-primary px-3 shadow-none" @click="editRow(props.row)">
                            Edit
                        </button>
                    </span>
                </template>
            </vue-good-table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
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
                    label: "Is Arrival",
                    field: "is_arrival_text",
                },
                {
                    label: "Is Feature",
                    field: "is_feature_text",
                },
                {
                    label: "Is Popular",
                    field: "is_popular_text",
                },
                {
                    label: "Top Sold Service",
                    field: "is_topsold_text",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            categories: [],
            selectedCategory: null,
            services: [],
            selectedService: null,
            published: {
                service_id: "",
                is_arrival: false,
                is_feature: false,
                is_popular: false,
                is_topsold: false,
            },
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
            });
        },

        savePublished() {
            if (this.selectedService == null) {
                alert("Service select first");
                return;
            }
            this.published.service_id = this.selectedService.id

            axios.post("/admin/service/published", this.published)
                .then(res => {
                    if (res.data.status) {
                        $.notify(res.data.msg, "success");
                        this.getService();
                        this.clearData();
                    }else{
                        console.log(res.data.msg)
                    }
                });
        },

        editRow(val) {
            this.published = {
                service_id: val.id,
                is_arrival: val.is_arrival == 1 ? true : false,
                is_feature: val.is_feature == 1 ? true : false,
                is_popular: val.is_popular == 1 ? true : false,
                is_topsold: val.is_topsold == 1 ? true : false,
            };
            this.selectedService = {
                id: val.id,
                display_name: val.display_name,
            }
        },

        clearData() {
            this.published = {
                service_id: "",
                is_arrival: false,
                is_feature: false,
                is_popular: false,
                is_topsold: false,
            };
            this.selectedCategory = null
            this.selectedService = null
        },
    },
};
</script>
