<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AreaManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("areaManagerEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.manager.create");
    }

    public function index()
    {
        $authId = Auth::guard('admin')->user();
        if ($authId->role == 'manager') {
            $data = Admin::with('thana')->where("role", "manager")->where('id', $authId->id)->get();
        } else {
            $data = Admin::with('thana')->where("role", "manager")->get();
        }

        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:30',
            'username' => 'required|string|min:3|max:20|unique:admins',
            'email'    => 'required|email:rfc,dns|unique:admins',
            'role'     => 'required|string',
            'image'    => 'nullable|mimes:jpeg,png,jpg,gif',
            'password' => 'required|min:5|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()
            ]);
        }

        try {
            $data              = new Admin();
            $data->name        = $request->name;
            $data->username    = $request->username;
            $data->email       = $request->email;
            $data->district_id = $request->district_id;
            $data->thana_id    = $request->thana_id;
            $data->address     = $request->address;
            $data->commission  = $request->commission;
            $data->role        = 'manager';
            $data->password    = Hash::make($request->password);
            if ($request->hasFile('image')) {
                $data->image    = $this->imageUpload($request, 'image', 'uploads/admins');
            }
            $data->save();

            $permissions = [
                [
                    'group_name' => 'Dashboard',
                    'permission_name' => [
                        'Dashboard',
                    ]
                ],
                [
                    'group_name' => 'Worker',
                    'permission_name' => [
                        'workerEntry',
                        'assignWorkerService',
                    ]
                ],
                [
                    'group_name' => 'Order',
                    'permission_name' => [
                        'orderList',
                        'orderAssign',
                        'orderComplete',
                        'orderCancel',
                    ]
                ],
            ];

            foreach ($permissions as $permission) {
                foreach ($permission['permission_name'] as $permissionName) {
                    AdminAccess::create([
                        'admin_id'    => $data->id,
                        'group_name'  => $permission['group_name'],
                        'permissions' => $permissionName,
                    ]);
                }
            }


            return response()->json([
                'status'  => true,
                'msg' => 'Yea! User Added Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:30',
            'username' => 'required|string|min:3|max:20|unique:admins,username,' . $request->id,
            'email'    => 'required|email:rfc,dns|unique:admins,email,' . $request->id,
            'role'     => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()
            ]);
        }

        try {
            $data = Admin::find($request->id);

            $data->name        = $request->name;
            $data->username    = $request->username;
            $data->email       = $request->email;
            $data->district_id = $request->district_id;
            $data->thana_id    = $request->thana_id;
            $data->address     = $request->address;
            $data->commission  = $request->commission;
            if (!empty($request->password)) {
                $data->password = Hash::make($request->password);
            }
            if ($request->hasFile('image')) {
                if (File::exists($data->image)) {
                    File::delete($data->image);
                }
                $data->image    = $this->imageUpload($request, 'image', 'uploads/admins');
            }
            $data->update();

            $checkaccess = AdminAccess::where('admin_id', $request->id)->get();

            if (count($checkaccess) == 0) {
                $permissions = [
                    [
                        'group_name' => 'Dashboard',
                        'permission_name' => [
                            'Dashboard',
                        ]
                    ],
                    [
                        'group_name' => 'Worker',
                        'permission_name' => [
                            'workerEntry',
                            'assignWorkerService',
                        ]
                    ],
                    [
                        'group_name' => 'Order',
                        'permission_name' => [
                            'orderList',
                            'orderAssign',
                            'orderComplete',
                            'orderCancel',
                        ]
                    ],
                ];

                foreach ($permissions as $permission) {
                    foreach ($permission['permission_name'] as $permissionName) {
                        AdminAccess::create([
                            'admin_id'    => $data->id,
                            'group_name'  => $permission['group_name'],
                            'permissions' => $permissionName,
                        ]);
                    }
                }
            }


            return response()->json([
                'status'  => true,
                'msg' => 'Yea! User Updated Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $admin_id = Admin::find($request->id);

            $admin_id->delete();
            return response()->json([
                'status'  => true,
                'msg' => 'User Delete successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
