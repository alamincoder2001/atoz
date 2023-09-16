<template>
    <div>
        <div class="col-12 col-lg-12" style="overflow-x: auto">
            <vue-good-table :columns="columns" :rows="technicians" :fixed-header="true" :pagination-options="{
                enabled: true,
                perPage: 15,
            }" :search-options="{ enabled: true }" :line-numbers="true" styleClass="vgt-table" max-height="550px">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'before'">
                        <button class="btn btn-sm text-white shadow-none"
                            :class="props.row.status == 'p' ? 'btn-warning' : 'btn-success'" @click="editRow(props.row, 'a')">
                            {{ props.row.status == 'p' ? 'Pending' : 'Approved' }}
                        </button>
                        <button class="btn btn-sm text-white shadow-none"
                            :class="props.row.status == 'p' || props.row.status == 'a' ? 'btn-warning' : 'btn-success'" @click="editRow(props.row, props.row.status == 'v' ? 'a':'v')">
                            {{ props.row.status == 'p' || props.row.status == 'a' ? 'Verify' : 'Verified' }}
                        </button>
                        <button class="btn btn-sm btn-outline-success shadow-none" @click="Show(props.row)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger shadow-none" @click="deleteRow(props.row.id)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </span>
                </template>
            </vue-good-table>
        </div>

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body" style="padding: 45px;">
                        <showTechnician :technician-row="technicianData"></showTechnician>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import showTechnician from "../components/showTechnician.vue"
export default {
    components: { 'showTechnician': showTechnician },
    data() {
        return {
            columns: [
                {
                    label: "Technician Code",
                    field: "technician_code",
                },
                {
                    label: "Name",
                    field: "name",
                },
                {
                    label: "Username",
                    field: "username",
                },
                {
                    label: "Mobile",
                    field: "mobile",
                },
                {
                    label: "Email",
                    field: "email",
                },
                {
                    label: "Action",
                    field: "before",
                },
            ],
            technicians: [],
            technicianData: {},
        };
    },

    created() {
        this.getTechnician();
    },

    methods: {
        getTechnician() {
            axios.get(location.origin + "/admin/technician/fetch")
                .then(res => {
                    this.technicians = res.data
                })
        },

        editRow(rowData, status) {
            rowData.setStatus = status
            if (confirm("Are you sure want to approved this")) {
                axios.post(location.origin + "/admin/technician/status", rowData)
                    .then(res => {
                        $.notify(res.data, "success");
                        this.getTechnician();
                    })
            }
        },

        deleteRow(rowId){
            if (confirm("Are you sure want to delete this")) {
                axios.get(location.origin + "/admin/technician/delete/" + rowId)
                    .then(res => {
                        $.notify(res.data, "success");
                        this.getTechnician();
                    })
            }
        },

        Show(row) {
            this.technicianData = row
            $("#staticBackdrop").modal("show");
        },

    },
};
</script>
