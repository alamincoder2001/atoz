<template>
    <div class="container">
        <div class="main-body">
            <h3 class="text-center m-0">{{ customerRow.customer_type }} Customer Details</h3>
            <hr style="margin:0px 0px 10px 0;">
            <div class="row gutters-sm">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img :src="`${customerRow.image != null ? link+customerRow.image:'https://bootdey.com/img/Content/avatar/avatar7.png'}`" :alt="customerRow.name"
                                    class="rounded-circle" style="width: 150px;height:130px;">
                                <div class="mt-3">
                                    <h4>{{ customerRow.name }}</h4>
                                    <p class="text-secondary mb-1">{{customerRow.customer_code}}</p>
                                    <p class="text-muted font-size-sm">{{ customerRow.thana_name }}, {{ customerRow.district_name }}</p>
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
                                    {{customerRow.name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{customerRow.username}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{customerRow.email}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{customerRow.mobile}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{customerRow.address}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info shadow-none"
                                        href="#">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin: 10px 0px 0px 0;">
            <div v-if="customerRow.customer_type == 'Wholesale'" class="row gutters-sm">
                <div class="col-lg-4">
                    <div class="card">
                            <a :href="customerRow.nid_card != null ? link+customerRow.nid_card: link+'noImage.jpg'">
                                <img class="card-img-top" style="height: 130px;" :src="customerRow.nid_card != null ? link+customerRow.nid_card: link+'noImage.jpg'" />
                            </a>
                        <div class="card-body">
                            <p class="m-0">Nid Card</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                            <a :href="customerRow.trade_license != null ? link+customerRow.trade_license: link+'noImage.jpg'">
                                <img class="card-img-top" style="height: 130px;" :src="customerRow.trade_license != null ? link+customerRow.trade_license: link+'noImage.jpg'" />
                            </a>
                        <div class="card-body">
                            <p class="m-0">Trade License</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <a :href="customerRow.visiting_card != null ? link+customerRow.visiting_card: link+'noImage.jpg'">
                            <img class="card-img-top" style="height: 130px;" :src="customerRow.visiting_card != null ? link+customerRow.visiting_card: link+'noImage.jpg'" />
                        </a>
                        <div class="card-body">
                            <p class="m-0">Visiting Card</p>
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
        customerRow: Object
    },
    data() {
        return {
            link: location.origin + "/"
        }
    },
    methods: {
        clickMethod() {
            alert("hello");
        },
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
}</style>