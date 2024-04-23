@extends("layouts.backend_master")

@section("title", "Admin District")
@section("breadcrumb_title", "District")
@section("breadcrumb_item", "District Create")

@section("content")
<div class="col-12 col-lg-4">
    <div class="card">
        <div class="card-body">
            <form onsubmit="Store(event)">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="name">District Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" class="form-control shadow-none shadow-none">
                    <span class="text-danger error error-name"></span>
                </div>
                <div class="form-group">
                    <label for="division_id">Division Name</label>
                    <select name="division_id" id="division_id" autocomplete="off" class="form-select shadow-none shadow-none">
                        <option value="">Select Division</option>
                        @php
                        $division = App\Division::get();
                        @endphp
                        @foreach($division as $d)
                        <option value="{{$d->id}}">{{$d->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error error-division_id"></span>
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
            <h5 class="card-title">District List</h5>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>District Name</th>
                            <th>Division</th>
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
<script>
    //get Data
    var table = $('#datatable').DataTable({
        ajax: location.origin + "/admin/district/fetch",
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
                    return data.division.name
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
            url: location.origin + "/admin/district",
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
            url: location.origin + "/admin/district/fetch/" + id,
            method: "GET",
            dataType: "JSON",
            success: res => {
                $.each(res.data, (index, value) => {
                    $("form").find("#" + index).val(value);
                })
            }
        })
    }

    function Delete(id) {
        if (confirm("Are you sure want delete this !")) {
            $.ajax({
                url: location.origin + "/admin/district/delete",
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