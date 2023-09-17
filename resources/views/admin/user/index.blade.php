@extends("layouts.backend_master")

@section("title", "Admin Create")
@section("breadcrumb_title", "Admin Create")
@section("breadcrumb_item", "Admin Create")

@section("content")
<div class="col-12 col-md-12 col-lg-12">
    <div class="row">
        <!-- user list -->
        <div class="col-lg-9 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User List</h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>UserName</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
        <!-- user create form -->
        <div class="col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <form id="addUser" onsubmit="addUser(event)">
                        <input type="hidden" name="admin_id" id="admin_id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" autocomplete="off" placeholder="Name">
                            <span class="error-name error text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="User Name" autocomplete="off">
                            <span class="error-username error text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
                            <span class="error-email error text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" class="form-select shadow-none">
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                            <span class="error-role error text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                            <span class="error-password error text-danger"></span>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success px-3 shadow-none changeBtn">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    //get Data
    var table = $('#datatable').DataTable({
        ajax: location.origin + "/admin/user-fetch",
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
                data: 'username',
            },
            {
                data: 'email',
            },
            {
                data: 'role',
            },
            {
                data: null,
                render: data => {
                    return `
                            ${'<a href="/admin/user/permission/'+data.id+'" class="btn btn-warning shadow-none btn-sm"><i class="mdi mdi-account-settings-variant"></i></a>'}
                            ${'<button type="button" onclick="Edit('+data.id+')" class="btn btn-primary shadow-none btn-sm"><i class="mdi mdi-account-edit"></i></button>'}            
                            ${'<button type="button" onclick="Delete('+data.id+')" class="btn btn-danger shadow-none btn-sm"><i class="mdi mdi-account-remove"></i></button>'}
                        `;
                }
            }
        ],
    });

    // store user
    function addUser(event) {
        event.preventDefault();

        var formdata = new FormData(event.target)
        $.ajax({
            url: location.origin + "/admin/user",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $("#addUser").find(".error").text("");
            },
            success: res => {
                if (res.error) {
                    $.each(res.error, (index, value) => {
                        $("#addUser").find(".error-" + index).text(value);
                    })
                } else {
                    table.ajax.reload()
                    $("#addUser").trigger('reset')
                    $("#addUser").find("#admin_id").val('')
                    $(".changeBtn").text("Save User").removeClass("btn-primary").addClass("btn-success");
                    $.notify(res, "success");
                }
            }
        })
    }

    // edit fetch data
    function Edit(id) {
        $(".changeBtn").text("Update User").removeClass("btn-success").addClass("btn-primary");
        $.ajax({
            url: location.origin + "/admin/user-fetch/" + id,
            method: "GET",
            dataType: "JSON",
            success: res => {
                $.each(res.data, (index, value) => {
                    $("#addUser").find("#" + index).val(value);
                })
                $("#addUser").find("#admin_id").val(res.data.id);
                if (res.data.image != null) {
                    document.querySelector('.img').src = location.origin + "/" + res.data.image
                } else {
                    document.querySelector('.img').src = location.origin + "/noImage.jpg"
                }
            }
        })
    }

    // delete department
    function Delete(id) {
        if (confirm("Are you sure want to delete this data!")) {
            $.ajax({
                url: location.origin + "/admin/user/delete",
                method: "POST",
                data: {
                    id: id
                },
                success: (response) => {
                    $.notify(response, "success");
                    table.ajax.reload();
                }
            })
        }
    }
</script>
@endpush