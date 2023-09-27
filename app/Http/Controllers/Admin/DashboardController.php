<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Worker;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
            ->pluck('permissions')
            ->toArray();
        if (!in_array("Dashboard", $access)) {
            return view("admin.unauthorize");
        }
        return view("admin.dashboard");
    }

    public function getProfit()
    {
        $month = date("m");
        $year = date("Y");
        $today = date('Y-m-d');
        // $dayNumber = date('t', mktime(0, 0, 0, $month, 1, $year));

        $clauses = "";
        $managerId = "";
        $areaId = Auth::guard('admin')->user();
        if ($areaId->role == 'manager') {
            $clauses .= "AND c.thana_id = '$areaId->thana_id'";
            $managerId .= "AND cm.manager_id = '$areaId->id'";
        }

        $todayOrder = DB::select("SELECT sm.*,
        c.district_id,
        c.thana_id
        FROM orders sm
        LEFT JOIN users c ON c.id = sm.customer_id
        WHERE sm.date = '$today' AND sm.status = 'pending'
        $clauses
        ");
        $pendingOrder = DB::select("SELECT sm.*,
        c.district_id,
        c.thana_id
        FROM orders sm
        LEFT JOIN users c ON c.id = sm.customer_id
        WHERE sm.status = 'pending'
        $clauses
        ");
        $yearOrder = DB::select("SELECT sm.*,
        c.district_id,
        c.thana_id
        FROM orders sm
        LEFT JOIN users c ON c.id = sm.customer_id
        WHERE YEAR(sm.date) = '$year' AND sm.status = 'pending'
        $clauses
        ");
        $complete = DB::select("SELECT sm.*,
            c.district_id,
            c.thana_id
            FROM orders sm
            LEFT JOIN users c ON c.id = sm.customer_id
            WHERE sm.status = 'complete'
            $clauses
        ");
        $orderDetail = DB::select("SELECT
                    od.*
                FROM order_details od
                LEFT JOIN orders o ON o.id = od.order_id
                LEFT JOIN users c ON c.id = o.customer_id
                WHERE od.status != 'cancel'
            $clauses
        ");

        $commission = DB::select("SELECT ifnull(sum(cm.amount), 0) as total FROM commissions cm WHERE 1 = 1 $managerId");

        $worker = '';
        if (Auth::guard('admin')->user()->role == 'manager') {
            $worker = Worker::where("thana_id", Auth::guard('admin')->user()->thana_id)->get();
        }
        if ((Auth::guard('admin')->user()->role == 'admin') || (Auth::guard('admin')->user()->role == 'superadmin')) {
            $worker = Worker::get();
        }
        $customer = '';
        if (Auth::guard('admin')->user()->role == 'manager') {
            $customer = User::where("thana_id", Auth::guard('admin')->user()->thana_id)->get();
        }
        if ((Auth::guard('admin')->user()->role == 'admin') || (Auth::guard('admin')->user()->role == 'superadmin')) {
            $customer = User::get();
        }

        return response()->json([
            'today_order'   => $todayOrder,
            'pending_order' => $pendingOrder,
            'year_order'    => $yearOrder,
            'completed'     => $complete,
            'order_detail'  => $orderDetail,
            'commission'    => $commission[0]->total,
            'manager'       => Admin::where('role', 'manager')->get(),
            'worker'        => $worker,
            'customer'      => $customer,
        ]);
    }


    // admin profile updated
    public function profileIndex()
    {
        $data = Auth::guard('admin')->user();
        return view("admin.profile", compact('data'));
    }

    public function profileUpdate(Request $request)
    {
        try {
            $admin = Auth::guard('admin')->user();
            if (!empty($request->old_password) || !empty($request->new_password) || !empty($request->confrim_password)) {
                $validator = Validator::make($request->all(), [
                    "name"             => "required",
                    "username"         => "required|unique:admins,username," . $admin->id,
                    "email"            => "required|unique:admins,email," . $admin->id,
                    "old_password"     => "required",
                    "new_password"     => "required",
                    'confirm_password' => 'required_with:new_password|same:new_password'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "name"     => "required",
                    "username" => "required|unique:admins,username," . $admin->id,
                    "email"    => "required|unique:admins,email," . $admin->id,
                ]);
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data = Admin::find($admin->id);
            if (!empty($request->old_password) || !empty($request->new_password) || !empty($request->confrim_password)) {
                if (Hash::check($request->old_password, $admin->password)) {
                    $data->password = Hash::make($request->new_password);
                } else {
                    return response()->json(["errors" => "Old password does not match"]);
                }
            }
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->save();
            return "Admin Profile Updated";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function imageUpdate(Request $request)
    {
        try {

            $admin = Auth::guard('admin')->user();

            $validator = Validator::make($request->all(), [
                "image" => "mimes:jpg,png,jpeg|dimensions:width=200,height=200"
            ], ["image.dimensions" => "Image dimension must be (200 x 200)"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            $data = Admin::find($admin->id);
            $old = $data->image;

            if (!empty($old) && isset($old)) {
                if (File::exists($old)) {
                    File::delete($old);
                }
            }
            $data->image = $this->imageUpload($request, 'image', 'uploads/admins') ?? '';

            $data->save();
            return "Image Upload successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function AdminLogout()
    {
        Auth::guard("admin")->logout();
        return redirect("/admin");
    }
}
