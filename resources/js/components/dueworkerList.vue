<style scoped></style>

<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="text-end pt-2 pe-1">
                    <a href="" @click.prevent="print" style="color: #3e5569;">
                        <i class="fas fa-print" style="color: gray; font-size: 12px; padding: 0;"></i>
                        Print
                    </a>
                </div>
                <div class="card-header">
                    <div class="card-body pt-0" id="reportContent">
                        <table v-if="workers.length > 0" class="table table-bordered m-0 record-table">
                            <thead style="background: gray">
                                <tr>
                                    <th class="text-white" style="font-weight: bold; width: 5%">
                                        Sl
                                    </th>
                                    <th class="text-white" style="font-weight: bold">
                                        Name
                                    </th>
                                    <th class="text-white" style="font-weight: bold">
                                        Mobile
                                    </th>
                                    <th class="text-white text-end" style="font-weight: bold">
                                        Due Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in workers" :key="item.id">
                                    <td>{{ ++index }}</td>

                                    <td>{{ item.name }} </td>
                                    <td>{{ item.mobile }} </td>
                                    <td class="text-end">{{ item.dueAmount }} </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="text-center">Not Found Data</div>
                    </div>
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
        };
    },

    created() {
        this.getWorkers();
    },

    methods: {
        getWorkers() {
            axios.get("/admin/get-workers-withDueAmount")
                .then(res => {
                    this.workers = res.data.workers.filter(item => item.dueAmount > 0);
                })
        },

        async print() {
            let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h3 style="text-align:center; border-top: 1px dashed gray; border-bottom: 1px dashed gray; padding:3px; color:gray;">
                                    Worker Due List
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

            reportWindow.focus();
            await new Promise(resolve => setTimeout(resolve, 1000));
            reportWindow.print();
            reportWindow.close();
        },

    },
};
</script>
