<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
        if (Auth::guard('admin')->user()->role != 'superadmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("userEntry", $access)) {
                return view("admin.unauthorize");
            }
        }

        return view("admin.user.create");
    }

    public function index($id = null)
    {
        if ($id == null) {
            $data = Admin::where('role', '!=', 'manager')->where("id", "!=", 1)->get();
        } else {
            $data = Admin::find($id);
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
            $data = new Admin();
            $data->name     = $request->name;
            $data->username = $request->username;
            $data->email    = $request->email;
            $data->role     = $request->role;
            $data->password = Hash::make($request->password);
            if ($request->hasFile('image')) {
                $data->image    = $this->imageUpload($request, 'image', 'uploads/admins');
            }
            $data->save();


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

            $data->name     = $request->name;
            $data->username = $request->username;
            $data->email    = $request->email;
            $data->role     = $request->role;
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

    // permission edit
    public function permissionEdit($id)
    {
        $user = Admin::find($id);

        if (Auth::guard('admin')->user()->role != 'superadmin') {

            if (empty($user)) {
                return back();
            } else if ($user->id == 1 || $user->role == 'manager') {
                return back();
            }

            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("userAccess", $access)) {
                return view("admin.unauthorize");
            }
        }

        $userAccess = AdminAccess::where('admin_id', $id)->pluck('permissions')->toArray();
        $access = AdminAccess::where('admin_id', $id)->get();
        $groups = Permission::groupBy('group_name')->orderBy('id', 'asc')->get();
        foreach ($groups as $key => $item) {
            $item->permissionArr = Permission::where('group_name', $item->group_name)->get();
        }
        return view('admin.user.access', compact('user', 'access', 'userAccess', 'groups'));
    }

    public function permissionStore(Request $request)
    {
        try {
            $admin = Admin::find($request->admin_id);
            AdminAccess::where('admin_id', $request->admin_id)->delete();
            $permissions = Permission::all();

            foreach ($permissions as $value) {
                if (in_array($value->id, $request->permissions)) {
                    AdminAccess::create([
                        'admin_id'    => $request->admin_id,
                        'group_name'  => $value->group_name,
                        'permissions' => $value->permissions,
                    ]);
                }
            }
            if ($admin->role == 'manager') {
                return redirect()->route('admin.manager.create')->with('success', 'Permissions added successfullly');
            } else {
                return redirect()->route('admin.user.create')->with('success', 'Permissions added successfullly');
            }
        } catch (\Throwable $e) {
            return redirect()->route('admin.user.create');
        }
    }
}
