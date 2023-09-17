<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        // $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
        //     ->pluck('permissions')
        //     ->toArray();
        // if (!in_array("userEntry", $access)) {
        //     return view("admin.unauthorize");
        // }
        return view("admin.user.create");
    }

    public function index($id = null)
    {
        if ($id == null) {
            $data = Admin::where("id", "!=", 1)->get();
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
                'msg' => 'Yea! A News User Added Successfully'
            ]);
        } catch (Exception $e) {
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
                'msg' => 'Yea! A News User Updated Successfully'
            ]);
        } catch (Exception $e) {
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
        // $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
        //     ->pluck('permissions')
        //     ->toArray();
        // if (!in_array("userAccess", $access)) {
        //     return view("admin.unauthorize");
        // }

        $user = Admin::find($id);
        $userAccess = AdminAccess::where('admin_id', $id)->pluck('permissions')->toArray();
        $group_name = Permission::pluck('group_name')->unique();
        $permissions = Permission::all();
        return view('admin.user.access', compact('user', 'userAccess', 'group_name', 'permissions'));
    }

    public function permissionStore(Request $request)
    {
        try {
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
            return redirect()->route('admin.user.create')->with('success', 'Permissions added successfullly');
        } catch (\Throwable $e) {
            return redirect()->route('admin.user.create');
        }
    }
}
