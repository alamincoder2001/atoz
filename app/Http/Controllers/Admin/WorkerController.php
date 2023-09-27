<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Worker;
use App\Models\AdminAccess;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
        $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
            ->pluck('permissions')
            ->toArray();
        if (!in_array("workerEntry", $access)) {
            return view("admin.unauthorize");
        }
        return view("admin.worker.create");
    }

    public function index()
    {
        if (Auth::guard('admin')->user()->role == 'manager') {
            $workers = Worker::with('thana', 'manager', 'category')->where('thana_id', Auth::guard('admin')->user()->thana_id)->latest()->get();
        } else {
            $workers = Worker::with('thana', 'manager', 'category')->latest()->get();
        }
        $worker_code = $this->generateCode("Worker", "W");

        return response()->json(["workers" => $workers, "worker_code" => $worker_code]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|min:3|max:30',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()
            ]);
        }

        try {
            $data              = new Worker();
            $data->worker_code = $request->worker_code;
            $data->name        = $request->name;
            $data->mobile      = $request->mobile;
            $data->password    = Hash::make($request->mobile);
            $data->nid         = $request->nid;
            $data->commission  = $request->commission;
            $data->father_name = $request->father_name;
            $data->mother_name = $request->mother_name;
            $data->category_id = $request->category_id;
            $data->manager_id  = $request->manager_id;
            $data->district_id = $request->district_id;
            $data->thana_id    = $request->thana_id;
            $data->address     = $request->address;
            $data->reference   = $request->reference;
            if ($request->hasFile('image')) {
                $data->image    = $this->imageUpload($request, 'image', 'uploads/admins');
            }
            $data->save();


            return response()->json([
                'status'  => true,
                'msg' => 'Yea! Worker Added Successfully'
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
            'name'   => 'required|string|min:3|max:30',
            'mobile' => 'required|unique:workers,mobile,' . $request->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()
            ]);
        }

        try {
            $data = Worker::find($request->id);

            $data->worker_code = $request->worker_code;
            $data->name        = $request->name;
            $data->mobile      = $request->mobile;
            $data->password    = Hash::make($request->mobile);
            $data->nid         = $request->nid;
            $data->commission  = $request->commission;
            $data->father_name = $request->father_name;
            $data->mother_name = $request->mother_name;
            $data->category_id = $request->category_id;
            $data->manager_id  = $request->manager_id;
            $data->district_id = $request->district_id;
            $data->thana_id    = $request->thana_id;
            $data->address     = $request->address;
            $data->reference   = $request->reference;
            if ($request->hasFile('image')) {
                if (File::exists($data->image)) {
                    File::delete($data->image);
                }
                $data->image    = $this->imageUpload($request, 'image', 'uploads/workers');
            }
            $data->update();

            return response()->json([
                'status'  => true,
                'msg' => 'Yea! Worker Updated Successfully'
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
            $worker_id = Worker::find($request->id);

            $worker_id->delete();
            return response()->json([
                'status'  => true,
                'msg' => 'Worker Delete successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    //assign work
    public function assignService()
    {
        $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
            ->pluck('permissions')
            ->toArray();
        if (!in_array("assignWorkerService", $access)) {
            return view("admin.unauthorize");
        }
        return view('admin.worker.assign');
    }


    public function statusChange(Request $request)
    {
        try {
            $data = OrderDetail::where('id', $request->id)->first();
            $orderId = $data->order_id;

            if ($request->status == 'complete') {
                $data->bill_amount = $request->billAmount;
                $data->paid_amount = $request->paidAmount;
                $data->due         = $request->dueAmount;
            }
            $data->status = $request->status;
            $data->update();

            $msg = "";
            if ($request->status == 'proccess') {
                $msg = 'Service proccessing successfully';
            }
            if ($request->status == 'complete') {
                $msg = 'Service complete successfully';
            }
            $orderdetail = OrderDetail::where('order_id', $orderId)->get();
            $ordercomplete = OrderDetail::where('order_id', $orderId)->where('status', 'complete')->get();
            if (count($orderdetail) == count($ordercomplete)) {
                $order = Order::where('id', $orderId)->first();
                $order->subtotal = array_sum(array_column($ordercomplete->toArray(), 'bill_amount'));
                $order->total = array_sum(array_column($ordercomplete->toArray(), 'paid_amount'));
                $order->due = array_sum(array_column($ordercomplete->toArray(), 'due'));
                $order->status = 'complete';
                $order->update();
            }

            return response()->json(['status' => false, 'msg' => $msg]);
        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}
