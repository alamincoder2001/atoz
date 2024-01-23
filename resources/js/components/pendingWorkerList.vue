<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <!-- <a href="javascript:void(0)"  class="page-title">Print</a> -->
                            <a href="" @click.prevent="print" style="color: #3e5569;">
                                <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                                Print
                            </a>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <label for="findWorker" class="pe-0 mt-1" style="float: right;">Find Worker</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group mb-1">
                                <input type="text" id="findWorker" v-model="search" v-on:keyup="findWorker" placeholder="By Name Or Phone" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h4 class="page-title" style="float: right;color: #3e5569;">Worker List</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="reportContent">
                    <table v-if="workers.length > 0" class="table table-bordered m-0 record-table">
                        <thead style="background: gray">
                            <tr>
                                <th class="text-white" style="font-weight: bold; width: 5%">
                                    Sl
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
                                <td v-if="item.image != null" class="no-print">
                                    <img :src="baseUrl+'/'+ item.image" alt="image" style="height: 30px;">
                                </td>
                                <td class="no-print" v-else>
                                    <img :src="imageSrc" alt="image" style="height: 30px;">
                                </td>

                                <td>{{ item.name }} </td>
                                <td>{{ item.mobile }} </td>
                                <td>{{ item.thana.name }}, {{ item.thana.district.name }} </td>
                                <td>{{ item.father_name }} </td>
                                <td>{{ item.mother_name }} </td>

                                <td class="text-end">
                                    <a href="" @click.prevent="statusRow(item.id)">
                                        <span>
                                            <i class="fas fa-arrow-down text-warning" title="Worker Status Deactive. Click To Change"></i>
                                        </span>
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
import moment from "moment";

export default {
    data() {
        return {
            workers: [],
            search: '',
            imageSrc: "/noImage.jpg",
            nameOrphone: '',
            baseUrl :window.location.origin
        };
    },

    created() {
        this.getWorker();
    },

    methods: {
        getWorker() {
            axios.get("/admin/get_pending_worker").then((res) => {
                this.workers = res.data.workers.map(c => {
                    c.img = c.image == null ? '<img src="/noImage.jpg" width="40px">' : '<img src="/' + c.image + '" width="40px">'
                    return c;
                })
            });
        },

        findWorker()
        {
            let workerList = this.workers.filter( todo => {
                return todo.name.toLowerCase().indexOf(this.search.toLowerCase())>-1 || todo.mobile.toLowerCase().indexOf(this.search.toLowerCase())>-1;
            })
            if (this.search.length > 0) {
                this.workers = workerList;
            }else{
                this.getWorker();
            }
        },

        statusRow(id) {
            if (confirm("Are you sure want to change status!")) {
                axios.post("/admin/worker/change_status", { id: id }).then((res) => {
                    $.notify(res.data.msg, "success");
                    this.getWorker();
                });
            }
        },

        workerHistory(data){
            window.open('/admin/worker/wise/report/'+data,'_blank');
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
				await new Promise(resolve => setTimeout(resolve, 5000));
				reportWindow.print();
				reportWindow.close();
			}

    },
};
</script>

<style>
#vs1__combobox {
    padding: 0;
}
</style>
