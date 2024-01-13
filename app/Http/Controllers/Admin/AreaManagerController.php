<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function list()
    {
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("areaManagerEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.manager.manager_list");
    }

    public function getManagerWiseWorkerReport($id)
    {
        $manager = Admin::where("role", "manager")->where('id', $id)->first();

        try {
            $input = request()->all();
            $from_date = $input['fromDate'];
            $to_date = $input['toDate'];
            $m_id = $input['id'];
        } catch (\Throwable $th) {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d');
            $m_id = $manager->id;
        }

        $workers = DB::table('workers as w')
            ->join('admins as manager', 'w.manager_id', '=', 'manager.id')
            ->leftJoin('order_details as od', 'w.id', '=', 'od.worker_id')
            ->leftJoin('orders as or', 'od.order_id', '=', 'or.id')
            ->select('w.id as w_id','w.name','manager.name as manager_name', 'or.*')
            ->where('w.manager_id', $m_id)
            ->whereBetween('or.date', [$from_date, $to_date])
            ->groupBy('od.order_id')
            ->get();

        return view('admin.manager.manager_wise_worker_order_list', compact('workers','manager','input'));
    }

    public function index()
    {
        $authUser = Auth::guard('admin')->user();
        if ($authUser->role == 'manager') {
            $data = Admin::with('thana')->where("role", "manager")->where('id', $authUser->id)->latest()->get();
        } else {
            $data = Admin::with('thana')->where("role", "manager")->latest()->get();
        }

        return response()->json(["manager" => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:30',
            'father_name'     => 'required|string|min:3|max:30',
            'mother_name'     => 'required|string|min:3|max:30',
            'permanent_address'    => 'required|string|min:5|max:255',
            'present_address'    => 'required|string|min:5|max:255',
            'username' => 'required|string|min:3|max:20|unique:admins',
            'email'    => 'required|email:rfc,dns|unique:admins',
            'role'     => 'required|string',
            'nid_front_img'    => 'required|mimes:jpeg,png,jpg,gif',
            'nid_back_img'    => 'required|mimes:jpeg,png,jpg,gif',
            'image'    => 'nullable|mimes:jpeg,png,jpg,gif',
            'password' => 'required|min:5|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()->first()
            ]);
        }

        try {

            $input = $request->all();

            if($request->file('nid_front_img')){
                $nidFront = rand().date('YmdHis').'.'.$request->nid_front_img->extension();
                $request->nid_front_img->move(public_path('uploads/manager/nid'), $nidFront);
                $input['nid_front_img'] = 'uploads/manager/nid/'.$nidFront;
            }else{
                unset($input['nid_front_img']);
            }

            if($request->file('nid_back_img')){
                $nidBack = rand().date('YmdHis').'.'.$request->nid_back_img->extension();
                $request->nid_back_img->move(public_path('uploads/manager/nid'), $nidBack);
                $input['nid_back_img'] = 'uploads/manager/nid/'.$nidBack;
            }else{
                unset($input['nid_back_img']);
            }

            $input['role']        = 'manager';
            $input['password']    = Hash::make($request->password);

            if($request->file('image')){
                $imgName = rand().date('YmdHis').'.'.$request->image->extension();
                $request->image->move(public_path('uploads/manager'), $imgName);
                $input['image'] = 'uploads/manager/'.$imgName;
            }else{
                unset($input['image']);
            }

            $manager = Admin::create($input);

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
                        'admin_id'    => $manager->id,
                        'group_name'  => $permission['group_name'],
                        'permissions' => $permissionName,
                    ]);
                }
            }

            return response()->json([
                'status'  => 'success',
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
            'name'     => 'required|string|min:3|max:30',
            'father_name'     => 'required|string|min:3|max:30',
            'mother_name'     => 'required|string|min:3|max:30',
            'permanent_address'    => 'required|string|min:5|max:255',
            'present_address'    => 'required|string|min:5|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()->first()
            ]);
        }

        try {
            $input = $request->all();

            $manager = Admin::findOrFail($request->id);
            // dd($input, $manager);

            if($request->file('nid_front_img')){
                $nidFront = rand().date('YmdHis').'.'.$request->nid_front_img->extension();
                $request->nid_front_img->move(public_path('uploads/manager/nid'), $nidFront);
                $input['nid_front_img'] = 'uploads/manager/nid/'.$nidFront;

                 // remove old image
                 $image_path = public_path($manager->nid_front_img);
                 if(file_exists($image_path)){
                    unlink($image_path);
                }
            }else{
                unset($input['nid_front_img']);
            }

            if($request->file('nid_back_img')){
                $nidBack = rand().date('YmdHis').'.'.$request->nid_back_img->extension();
                $request->nid_back_img->move(public_path('uploads/manager/nid'), $nidBack);
                $input['nid_back_img'] = 'uploads/manager/nid/'.$nidBack;

                // remove old image
                $image_path = public_path($manager->nid_back_img);
                if(file_exists($image_path)){
                   unlink($image_path);
               }
            }else{
                unset($input['nid_back_img']);
            }

            if($request->file('image')){
                $imgName = rand().date('YmdHis').'.'.$request->image->extension();
                $request->image->move(public_path('uploads/manager'), $imgName);
                $input['image'] = 'uploads/manager/'.$imgName;

                // remove old image
                $image_path = public_path($manager->nid_back_img);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }else{
                unset($input['image']);
            }

            if (!empty($request->password)) {
                $input['password'] = Hash::make($request->password);
            }else {
                unset($input['password']);
            }

            $manager->update($input);

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
                            'admin_id'    => $manager->id,
                            'group_name'  => $permission['group_name'],
                            'permissions' => $permissionName,
                        ]);
                    }
                }
            }

            return response()->json([
                'status'  => 'success',
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
