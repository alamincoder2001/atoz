@extends("layouts.backend_master")

@section("title", "Admin Area")
@section("breadcrumb_title", "Area")
@section("breadcrumb_item", "Area Create")

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css">
<style>
    .selectize-input {
        padding: 0.35rem 0.45rem !important;
    }
    .selectize-control.single .selectize-input {
        box-shadow: none !important;
        background-image: none !important;
        background-color: #fff !important;
    }
</style>
@endpush

@section("content")
<div class="col-12 col-lg-4">
    <div class="card">
        <div class="card-body">
            <form onsubmit="Store(event)">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="name">Area Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" class="form-control shadow-none shadow-none">
                    <span class="text-danger error error-name"></span>
                </div>
                <div class="form-group">
                    <label for="upazila_id">Upazila Name</label>
                    <select name="upazila_id" id="upazila_id">
                        <option value="">Select Upazila</option>
                        @php
                        $thanas = App\Thana::get();
                        @endphp
                        @foreach($thanas as $th)
                        <option value="{{$th->id}}">{{$th->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error error-upazila_id"></span>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success shadow-none px-4 text-white changeBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-12 col-lg-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Area List</h5>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Area Name</th>
                            <th>Upazila</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script>
    $("select").selectize();
    //get Data
    var table = $('#datatable').DataTable({
        ajax: location.origin + "/admin/area/fetch",
        order: [
            [0, "desc"]
        ],
        columns: [{
                data: 'id',
            },
            {
                data: 'name',
            },
            {
                data: null,
                render: data => {
                    return data.upazila.name
                }
            },
            {
                data: null,
                render: data => {
                    return `
                            ${'<button type="button" onclick="Edit('+data.id+')" class="btn btn-primary shadow-none btn-sm">Edit</button>'}            
                            ${'<button type="button" onclick="Delete('+data.id+')" class="btn btn-danger shadow-none btn-sm">Delete</button>'}
                        `;
                }
            }
        ],
    });

    function Store(event) {
        event.preventDefault();
        var formdata = new FormData(event.target)
        $.ajax({
            url: location.origin + "/admin/area",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".error").text("")
            },
            success: res => {
                if (!res.error) {
                    $.notify(res, "success");
                    $("form").trigger("reset")
                    $("#id").val("");
                    $(".changeBtn").text("Save").addClass("btn-success").removeClass("btn-primary");
                    $("select")[0].selectize.clear();
                    table.ajax.reload()
                } else {
                    $.each(res.error, (index, value) => {
                        $(".error-" + index).text(value);
                    })
                }
            }

        })
    }

    function Edit(id) {
        $(".changeBtn").text("Update").removeClass("btn-success").addClass("btn-primary");
        $.ajax({
            url: location.origin + "/admin/area/fetch/" + id,
            method: "GET",
            dataType: "JSON",
            success: res => {
                $.each(res.data, (index, value) => {
                    $("form").find("#" + index).val(value);
                })
                $("select")[0].selectize.addItem(res.data.upazila_id, true);
            }
        })
    }

    function Delete(id) {
        if (confirm("Are you sure want delete this !")) {
            $.ajax({
                url: location.origin + "/admin/area/delete/",
                method: "POST",
                data: {
                    id: id
                },
                success: res => {
                    $.notify(res, "success");
                    table.ajax.reload()
                }
            })
        }
    }
</script>
@endpush