<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.5s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    width: 900px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    overflow-y: auto;
    max-height: 350px;
    margin: 0px 0;
}

.modal-default-button {
    float: right;
}

/*
    * The following styles are auto-applied to elements with
    * transition="modal" when their visibility is toggled
    * by Vue.js.
    *
    * You can easily play with the modal transition by editing
    * these styles.
    */

.modal-enter-from {
    opacity: 0;
}

.modal-leave-to {
    opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

#vs1__combobox {
    padding: 0;
}
</style>



<template>
    <div class="row">
        <div class="col-lg-12">
            <Transition name="modal">
                <div v-if="show" class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-container" style="position: relative;">
                            <button class="modal-default-button"
                                style="width: 30px;border: none;position: absolute;top: 0;right: 0;"
                                v-on:click="closeRoom()">
                                <i class="fas fa-times"></i>
                            </button>
                            <div class="modal-body">
                                <slot name="body">
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h2 class="text-center m-0" style="font-style: italic;">Worker Information
                                                </h2>
                                                <i style="cursor: pointer;" class="fa fa-print" @click="printWindow"></i>
                                            </div>
                                            <hr style="margin-bottom: 0;">
                                        </div>

                                        <div class="card" id="workerList">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-5">
                                                        <div class="row">
                                                            <div class="col-12 text-center mb-2">
                                                                <img :src="baseUrl + '' + image"
                                                                    style="width: 150px;height:150px; border-bottom: 1px solid gray;"
                                                                    alt="worker-img">
                                                            </div>
                                                            <div class="col-12" style="border: 1px solid gray;">
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-6 text-center">
                                                                        <p class="m-0">NID Front Image</p>
                                                                        <a :href="baseUrl + '' + nid_front_img" download>
                                                                            <img :src="baseUrl + '' + nid_front_img"
                                                                                style="width: 100px;height: 100px;"
                                                                                alt="worker-nid-front">
                                                                            <br>
                                                                            <span class="download">Download</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 text-center">
                                                                        <p class="m-0">NID Back Image</p>
                                                                        <a :href="baseUrl + '' + nid_back_img" download>
                                                                            <img :src="baseUrl + '' + nid_back_img"
                                                                                style="width: 100px;height: 100px;"
                                                                                alt="worker-nid-back">

                                                                            <br>
                                                                            <span class="download">Download</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 col-12">
                                                        <div class="text-start d-block btn-top-txt"
                                                            style="letter-spacing: .7px;">
                                                            <strong>Code :</strong> {{ singleWorker.worker_code }}
                                                            <br>
                                                            <strong>Name :</strong> {{ singleWorker.name }} <br>
                                                            <strong>Phone :</strong> {{ singleWorker.mobile }}
                                                            <br>
                                                            <strong>Father Name :</strong> {{ singleWorker.father_name }}
                                                            <br>
                                                            <strong>Mother Name :</strong> {{ singleWorker.mother_name }}
                                                            <br>
                                                            <strong>Commission :</strong> {{ singleWorker.commission }}%
                                                            <br>
                                                            <strong>Present Address :</strong> {{
                                                                singleWorker.present_address }}
                                                            <br>
                                                            <strong>Permanent Address :</strong> {{
                                                                singleWorker.permanent_address }}
                                                            <br>
                                                            <strong>Thana :</strong> {{
                                                                singleWorker.thana ? singleWorker.thana.name : 'n/a' }}
                                                            <br>
                                                            <strong>District :</strong> {{
                                                                singleWorker.district ? singleWorker.district.name : 'n/a' }}
                                                            <br>
                                                            <strong>NID :</strong> {{ singleWorker.nid }}
                                                            <br>
                                                            <strong>Reference :</strong> {{ singleWorker.reference }}
                                                            <br>
                                                            <strong>Description :</strong> {{ singleWorker.description }}
                                                            <br>
                                                            <strong>Categories :</strong>
                                                            <span class="badge bg-success" style="margin-right: 3px;"
                                                                v-if="singleWorker.categories.length > 0"
                                                                v-for="(item, index) in singleWorker.categories">{{
                                                                    item.name }} &nbsp;</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </slot>
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>

            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-3 col-md-3">
                            <div class="d-flex">
                                <label for="findWorker" class="pe-0 mt-1" style="float: right; width: 100px;">Status</label>
                                <select v-model="status" class="form-control" @change="statusOnChange">
                                    <option value="">All</option>
                                    <option value="p">Active</option>
                                    <option value="d">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2">
                            <label for="findWorker" class="pe-0 mt-1" style="float: right;">Find Worker</label>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group mb-1">
                                <input type="text" id="findWorker" v-model="search" v-on:input="findWorker($event)"
                                    placeholder="By Name Or Phone" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 text-end">
                            <a href="" @click.prevent="print" style="color: #3e5569;">
                                <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                                Print
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0" id="reportContent">
                    <table v-if="workers.length > 0" class="table table-bordered m-0 record-table">
                        <thead style="background: gray">
                            <tr>
                                <th class="text-white" style="font-weight: bold; width: 5%">
                                    Sl
                                </th>
                                <th class="text-white" style="font-weight: bold; width: 5%" title="Worker ID">
                                    ID
                                </th>
                                <th class="text-white no-print" style="font-weight: bold">
                                    Image
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Name
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Phone
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Area
                                </th>

                                <th class="text-white text-center" style="font-weight: bold">
                                    Father Name
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Mother Name
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Status
                                </th>
                                <!-- <th class="text-white text-center" style="font-weight: bold">
                                    NID
                                </th> -->
                                <th class="text-white text-end" style="font-weight: bold">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in workers" :key="item.id">
                                <td>{{ ++index }}</td>
                                <td>{{ item.worker_code }}</td>
                                <td v-if="item.image != null" class="no-print">
                                    <img :src="baseUrl + '/' + item.image" alt="image" style="height: 30px;">
                                </td>
                                <td class="no-print" v-else>
                                    <img :src="imageSrc" alt="image" style="height: 30px;">
                                </td>

                                <td>{{ item.name }} </td>
                                <td>{{ item.mobile }} </td>
                                <td>{{ item.thana.name }}, {{ item.thana.district.name }} </td>
                                <td>{{ item.father_name }} </td>
                                <td>{{ item.mother_name }} </td>
                                <td>
                                    <span v-if="item.status == 'p'" class="badge bg-success"> Active</span>
                                    <span v-else class="badge bg-danger"> Inactive </span>
                                </td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" @click="workerHistory(item.id)" class="shadow-none"
                                        title="View Worker Report">
                                        <i class="fas fa-file"></i>
                                    </a>
                                    <a href="javascript:void(0)" @click="workerView(item.id)" id="show-modal"
                                        class="shadow-none" title="View Worker Information">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center">Not Found Data</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            workers: [],
            workers1: [],
            search: '',
            imageSrc: "/noImage.jpg",
            nameOrphone: '',
            show: false,
            baseUrl: window.location.origin,
            singleWorker: {
                name: '',
                mobile: '',
                permanent_address: '',
                present_address: '',
                reference: '',
                father_name: '',
                mother_name: '',
                nid_front_img: '',
                nid_back_img: '',
                image: '',
                commission: '',
            },
            imageSrc: "/noImage.jpg",
            image: "",
            nid_front_img: "",
            nid_back_img: "",
            status: "",
            baseUrl: window.location.origin
        };
    },

    created() {
        this.getWorker();
    },

    methods: {
        getWorker() {
            axios.post("/admin/get_active_worker", { status: this.status }).then((res) => {
                this.workers1 = res.data.workers.map(c => {
                    c.img = c.image == null ? '<img src="/noImage.jpg" width="40px">' : '<img src="/' + c.image + '" width="40px">'
                    return c;
                })
                this.workers = this.workers1;
            });
        },

        statusOnChange() {
            this.getWorker();
        },

        closeRoom() {
            this.show = false;
        },

        findWorker(event) {
            if (event.target.value.length > 0) {
                this.workers = this.workers1.filter(item => {
                    return item.name.toLowerCase().startsWith(event.target.value.toLowerCase()) || item.mobile.toLowerCase().startsWith(event.target.value.toLowerCase())
                })
            } else {
                this.workers = this.workers1;
            }
        },

        workerHistory(data) {
            window.open('/admin/worker/wise/report/' + data, '_blank');
        },

        workerView(id) {
            this.show = true;
            this.singleWorker = this.workers.find(e => e.id === id);
            this.nid_front_img = this.singleWorker.nid_front_img != null ? "/" + this.singleWorker.nid_front_img : "/noImage.jpg";
            this.nid_back_img = this.singleWorker.nid_back_img != null ? "/" + this.singleWorker.nid_back_img : "/noImage.jpg";
            this.image = this.singleWorker.image != null ? "/" + this.singleWorker.image : "/noImage.jpg";
        },

        async print() {
            let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Workers List
                                </h3>
							</div>
							<div class="col-sm-12">
								${document.querySelector('#reportContent').innerHTML}
							</div>
						</div>
					</div>
				`;
            var reportWindow = window.open('', 'PRINT', `height=${screen.height}, width=${screen.width}`);
            reportWindow.document.write(`
                    <table>
                        <tr>
                            <td><img src="/uploads/logo/6524546_6517fde95908b.png"></td>
                            <td>
                                <strong style="padding:0;"> A2Z Services<strong>
                                <p style="text-transform:capitalize;padding:0;margin:0;">
                                    18/4 d bagomgonj line narinda Dhaka 1100
                                </p>
                            </td>
                        </tr>
                    </table>
				`);

            reportWindow.document.head.innerHTML += `
                    <style>
                        @media print
                        {
                            .no-print, .no-print *
                            {
                                display: none !important;
                            }
                        }
						.record-table{
							width: 100%;
							border-collapse: collapse;
						}
						.record-table thead{
							background-color: #0097df;
							color:white;
						}
						.record-table th, .record-table td{
							padding: 3px;
							border: 1px solid #454545;
						}
						.record-table th{
							text-align: center;
						}
					</style>
				`;
            reportWindow.document.body.innerHTML += reportContent;

            let rows = reportWindow.document.querySelectorAll('.record-table tr');
            rows.forEach(row => {
                row.lastChild.remove();
            })

            reportWindow.focus();
            await new Promise(resolve => setTimeout(resolve, 1000));
            reportWindow.print();
            reportWindow.close();
        },
        async printWindow() {
            let reportContent = `
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Workers List
                                </h3>
							</div>
							<div class="col-12">
                                <div class="card">
                                    ${document.querySelector('#workerList').innerHTML}
                                </div>
							</div>
						</div>
					</div>
				`;
            var reportWindow = window.open('', 'PRINT', `height=${screen.height}, width=${screen.width}`);
            reportWindow.document.write(`
                    <table>
                        <tr>
                            <td><img src="/uploads/logo/6524546_6517fde95908b.png"></td>
                            <td>
                                <strong style="padding:0;"> A2Z Services<strong>
                                <p style="text-transform:capitalize;padding:0;margin:0;">
                                    18/4 d bagomgonj line narinda Dhaka 1100
                                </p>
                            </td>
                        </tr>
                    </table>
				`);

            reportWindow.document.head.innerHTML += `
                    <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
                    <style>
                        @media print
                        {
                            .no-print, .no-print *
                            {
                                display: none !important;
                            }
                            .download{
                                visibility: hidden !important;
                            }
                        }
					</style>
				`;
            reportWindow.document.body.innerHTML += reportContent;

            reportWindow.focus();
            await new Promise(resolve => setTimeout(resolve, 1000));
            reportWindow.print();
            reportWindow.close();
        }

    },
};
</script>
