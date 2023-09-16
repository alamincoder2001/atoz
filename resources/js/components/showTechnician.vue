<template>
    <div class="container">
        <div class="main-body">
            <h3 class="text-center m-0">Technician Details</h3>
            <hr style="margin:0px 0px 10px 0;">
            <div class="row gutters-sm">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img :src="`${technicianRow.image != null ? link + technicianRow.image : 'https://bootdey.com/img/Content/avatar/avatar7.png'}`"
                                    :alt="technicianRow.name" class="rounded-circle" style="width: 150px;height:130px;">
                                <div class="mt-3">
                                    <h4>{{ technicianRow.name }}</h4>
                                    <p class="text-secondary mb-1">{{ technicianRow.technician_code }}</p>
                                    <p class="text-muted font-size-sm">{{ technicianRow.thana_name }}, {{
                                        technicianRow.district_name }}</p>
                                    <button class="btn btn-primary">Follow</button>
                                    <button class="btn btn-outline-primary">Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ technicianRow.name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ technicianRow.username }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ technicianRow.email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ technicianRow.mobile }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ technicianRow.address }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Rating</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <fieldset class="rating">
                                        <input id="demo-1" type="radio" name="demo" value="1" @change="Rating">
                                        <label for="demo-1">1 star</label>
                                        <input id="demo-2" type="radio" name="demo" value="2" @change="Rating">
                                        <label for="demo-2">2 stars</label>
                                        <input id="demo-3" type="radio" name="demo" value="3" @change="Rating">
                                        <label for="demo-3">3 stars</label>
                                        <input id="demo-4" type="radio" name="demo" value="4" @change="Rating">
                                        <label for="demo-4">4 stars</label>
                                        <input id="demo-5" type="radio" name="demo" value="5" @change="Rating">
                                        <label for="demo-5">5 stars</label>

                                        <div class="stars">
                                            <label for="demo-1" aria-label="1 star" title="1 star" :style="{color: technicianRow.admin_rating == 1 || technicianRow.admin_rating == 2 || technicianRow.admin_rating == 3 || technicianRow.admin_rating == 4 || technicianRow.admin_rating == 5 ? 'orange':''}"></label>
                                            <label for="demo-2" aria-label="2 stars" title="2 stars" :style="{color: technicianRow.admin_rating == 2 || technicianRow.admin_rating == 3 || technicianRow.admin_rating == 4 || technicianRow.admin_rating == 5 ? 'orange':''}"></label>
                                            <label for="demo-3" aria-label="3 stars" title="3 stars" :style="{color: technicianRow.admin_rating == 3 || technicianRow.admin_rating == 4 || technicianRow.admin_rating == 5 ? 'orange':''}"></label>
                                            <label for="demo-4" aria-label="4 stars" title="4 stars" :style="{color: technicianRow.admin_rating == 4 || technicianRow.admin_rating == 5 ? 'orange':''}"></label>
                                            <label for="demo-5" aria-label="5 stars" title="5 stars" :style="{color: technicianRow.admin_rating == 5 ? 'orange':''}"></label>
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                            <!-- <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-info shadow-none">Update</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        technicianRow: Object
    },
    data() {
        return {
            link: location.origin + "/"
        }
    },
    methods: {
        Rating(event){
            let data = {
                id: this.technicianRow.id,
                rating: event.target.value
            }
            axios.post(location.origin+"/admin/technician/rating", data)
                .then(res => {
                    $.notify(res.data, "success")
                    setTimeout(() => {
                        location.reload()
                    }, 1000);
                })
        }
    },
}
</script>

<style>
.main-body {
    padding: 15px;
}

.card {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col,
.gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}

.mb-3,
.my-3 {
    margin-bottom: 1rem !important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}

.h-100 {
    height: 100% !important;
}

.shadow-none {
    box-shadow: none !important;
}

.rating input[type="radio"]:not(:nth-of-type(0)) {
    /* hide visually */
    border: 0;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

.rating [type="radio"]:not(:nth-of-type(0))+label {
    display: none;
}

label[for]:hover {
    cursor: pointer;
}

.rating .stars label:before {
    content: "★";
}

.stars label {
    color: lightgray;
}

.stars label:hover {
    text-shadow: 0 0 1px #000;
}

.rating [type="radio"]:nth-of-type(1):checked~.stars label:nth-of-type(-n+1),
.rating [type="radio"]:nth-of-type(2):checked~.stars label:nth-of-type(-n+2),
.rating [type="radio"]:nth-of-type(3):checked~.stars label:nth-of-type(-n+3),
.rating [type="radio"]:nth-of-type(4):checked~.stars label:nth-of-type(-n+4),
.rating [type="radio"]:nth-of-type(5):checked~.stars label:nth-of-type(-n+5) {
    color: orange;
}

.rating [type="radio"]:nth-of-type(1):focus~.stars label:nth-of-type(1),
.rating [type="radio"]:nth-of-type(2):focus~.stars label:nth-of-type(2),
.rating [type="radio"]:nth-of-type(3):focus~.stars label:nth-of-type(3),
.rating [type="radio"]:nth-of-type(4):focus~.stars label:nth-of-type(4),
.rating [type="radio"]:nth-of-type(5):focus~.stars label:nth-of-type(5) {
    color: darkorange;
}
</style>