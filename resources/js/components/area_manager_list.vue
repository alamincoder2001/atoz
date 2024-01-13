<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <a href="" @click.prevent="print" style="color: #3e5569;" v-if="managers.length > 0" >
                                <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                                Print
                            </a>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <label for="findManager" class="pe-0 mt-1" style="float: right;">Find Manager</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group mb-1">
                                <input type="text" id="findManager" v-model="search" v-on:input="findManager($event)" placeholder="By Name Or Email" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h4 class="page-title" style="float: right;color: #3e5569;">Area Manager List</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="reportContent">
                    <table v-if="managers.length > 0" class="table table-bordered m-0 record-table">
                        <thead style="background: gray">
                            <tr>
                                <th class="text-white" style="font-weight: bold; width: 5%">
                                    Sl
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Image
                                </th>
                                <th class="text-white" style="font-weight: bold">
                                    Name
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Email
                                </th>
                                <th class="text-white text-center" style="font-weight: bold">
                                    Commision
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
                            <tr v-for="(item, index) in managers" :key="item.id">
                                <td>{{ ++index }}</td>
                                <td v-if="item.image != null">
                                    <img :src="baseUrl+'/'+ item.image" alt="image" style="height: 30px;">
                                </td>
                                <td v-else>
                                    <img :src="imageSrc" alt="image" style="height: 30px;">
                                </td>
                                <td>{{ item.name }} </td>
                                <td>{{ item.email }} </td>
                                <td>{{ item.commission }}% </td>
                                <td>{{ item.thana.name }}, {{ item.thana.district.name }}</td>
                                <td>{{ item.father_name }} </td>
                                <td>{{ item.mother_name }} </td>

                                <td class="text-end">
                                    <a href="javascript:void(0)" @click="workerHistory(item.id)" class="btn shadow-none" title="View Area Manager wise worker Report">
                                        <i class="fas fa-file"></i>
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
            managers: [],
            managers1: [],
            search: '',
            imageSrc: "/noImage.jpg",
            baseUrl :window.location.origin
        };
    },

    created() {
        this.getWorker();
    },

    methods: {

        getWorker() {
            axios.get("/admin/get-manager").then((res) => {
                this.managers1 = res.data.manager.map(c => {
                    c.img = c.image == null ? '<img src="/noImage.jpg" width="40px">' : '<img src="/' + c.image + '" width="40px">'
                    return c;
                })
                this.managers = this.managers1;
            });
        },

        findManager(event)
        {
            if (event.target.value.length > 0) {
                this.managers = this.managers1.filter(item => {
                    return item.name.toLowerCase().startsWith(event.target.value.toLowerCase()) || item.email.toLowerCase().startsWith(event.target.value.toLowerCase())
                })
            }else{
                this.managers = this.managers1;
            }
        },

        workerHistory(data){
            window.open('/admin/manager/wise/worker/report/'+data);
        },

        async print() {
				let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Area Manager Record
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
				await new Promise(resolve => setTimeout(resolve, 3000));
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
