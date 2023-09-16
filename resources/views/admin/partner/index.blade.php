@extends("layouts.backend_master")

@section("title", "Admin Corporate Partner")
@section("breadcrumb_title", "Corporate Partner")
@section("breadcrumb_item", "Corporate Partner Create")

@section("content")
<div class="col-12 col-lg-4">
    <div class="card">
        <div class="card-body">
            <form onsubmit="Store(event)">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="title">Corporate Partner Title</label>
                    <input type="text" name="title" id="title" autocomplete="off" class="form-control shadow-none">
                    <span class="text-danger error error-title"></span>
                </div>
                <div class="form-group">
                    <label for="url">Corporate Partner Url</label>
                    <input type="url" name="url" id="url" autocomplete="off" class="form-control shadow-none">
                    <span class="text-danger error error-url"></span>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" autocomplete="off" class="form-control shadow-none" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                    <span class="text-danger error error-image"></span>
                    <div class="text-left">
                        <img src="{{asset('noImage.jpg')}}" class="img" style="width: 30%;height: 85px;border: 1px solid #c1c1c1;margin-top: 5px;">
                    </div>
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
            <h5 class="card-title">Corporate Partner List</h5>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Image</th>
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
        ajax: location.origin + "/admin/partner/fetch",
        order: [[ 0, "desc" ]],
        columns: [{
                data: 'id',
            },
            {
                data: 'name',
            },
            {
                data: 'slug',
            },
            {
                data: null,
                render: data => {
                    return `<img src='${data.image ? location.origin+'/'+data.image:location.origin+"/noImage.jpg"}' width='50' />`
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
            url: location.origin + "/admin/partner",
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
                    document.querySelector('.img').src = location.origin + "/noImage.jpg"
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
            url: location.origin + "/admin/partner/fetch/" + id,
            method: "GET",
            dataType: "JSON",
            success: res => {
                $.each(res.data, (index, value) => {
                    $("form").find("#" + index).val(value);
                })
                if (res.data.image != null) {
                    document.querySelector('.img').src = location.origin + "/" + res.data.image
                } else {
                    document.querySelector('.img').src = location.origin + "/noImage.jpg"
                }
            }
        })
    }

    function Delete(id) {
        if (confirm("Are you sure want delete this !")) {
            $.ajax({
                url: location.origin + "/admin/partner/delete/",
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