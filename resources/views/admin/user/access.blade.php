@extends("layouts.backend_master")

@section("title", "Admin Access")
@section("breadcrumb_title", "Admin Access")
@section("breadcrumb_item", "Admin Access")

@section("content")
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary
                            d-flex justify-content-between py-1">
                <h4 class="card-title m-0 pt-2">User Permission</h4>
                <a href="{{ route('admin.user.create') }}" class="btn btn-info shadow-none px-3">
                    Users List
                </a>
            </div>
            <div class="card-body">

                @if (session('message'))
                <div class="alert alert-{{ session('type') }}">{{ session('message') }}</div>
                @endif

                <form action="{{ route('admin.store.permission') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">User Name: <?= $user->name ?> | Role:
                                <?= $user->role ?></label>
                        </div>
                    </div>
                    <input type="hidden" name="admin_id" value="<?= $user->id ?>">
                    <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr>
                                <th class="text-white" style="font-weight: 900;">Group Name</th>
                                <th class="text-white" style="font-weight: 900;">Permission Name</th>
                            </tr>
                        </thead>
                        <tr class="border-bottom:1px solid gray;">
                            <td colspan="2">
                                <input type="checkbox" onchange="selectAll(event)" id="all" {{\App\Models\Admin::checkAll($access) ? 'checked' : ''}} >
                                <label for="all">All</label>
                            </td>
                        </tr>
                        @foreach ($groups as $group)
                        <tr>
                            <td class="group">
                                <input type="checkbox" id="role-{{ $group->group_name }}" value="{{ $group->group_name }}" onclick="selectGroup({{$group}})" {{\App\Models\Admin::checkGroupName($group->group_name, $access) ? 'checked' : ''}} />
                                <label for="role-{{ $group->group_name }}">{{ $group->group_name }}</label>
                            </td>
                            <td class="role-{{ $group->group_name }}">
                                @foreach ($group->permissionArr as $item)
                                <input type="checkbox" name="permissions[]" onclick="singlePermission({{$group}})" id="{{ $item->permissions }}" value="{{ $item->id }}" {{ in_array($item->permissions, $userAccess) ? 'checked' : '' }} />
                                <label for="{{ $item->permissions }}">{{ $item->permissions }}</label><br>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-success shadow-none text-white">Save Permissions</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
<script>
    function selectAll(event) {
        if (event.target.checked) {
            $('input[type="checkbox"]').prop('checked', true);
        } else {
            $('input[type="checkbox"]').prop('checked', false);
        }
    }

    function selectGroup(group) {
        const checkbox = $('.role-'+group.group_name + ' input');
        if ($('#role-'+group.group_name).is(':checked')) {
            checkbox.prop('checked', true);
        } else {
            checkbox.prop('checked', false);
        }

        singlePermission(group)
    }

    function singlePermission(group){
        var totalCheck = $(".role-"+group.group_name+" input:checkbox:checked").length
        var totalUnCheck = $(".role-"+group.group_name+" input:checkbox").length
        
        if (totalCheck == totalUnCheck) {
            $("#role-"+group.group_name).prop("checked", true);
        }else{
            $("#role-"+group.group_name).prop("checked", false);
        }

        var totalgroupcheck = $(".group input:checkbox:checked").length
        var totalgroupuncheck = $(".group input:checkbox").length

        if(totalgroupcheck >= totalgroupuncheck){
            $("#all").prop("checked", true);
        }else{
            $("#all").prop("checked", false);
        }
    }
</script>
@endpush