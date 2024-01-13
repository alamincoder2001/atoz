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
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function list()
    {
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("workerEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.worker.list");
    }

    public function pendingWorker()
    {
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("workerEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.worker.pending_list");
    }

    public function getPendingWorker()
    {
        if (Auth::guard('admin')->user()->role == 'manager') {
            $workers = Worker::with('thana', 'manager', 'category')->where('status', 'd')->where('manager_id', Auth::guard('admin')->user()->id)->latest()->get();
        } else {
            $workers = Worker::with('thana', 'manager', 'category')->where('status', 'd')->latest()->get();
        }
        return response()->json(["workers" => $workers]);
    }

    public function workerWiseReport($id)
    {
        $worker = Worker::findOrFail($id);
        try {
            $input = request()->all();
            $from_date = $input['fromDate'];
            $to_date = $input['toDate'];
            $w_id = $input['id'];
        } catch (\Throwable $th) {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d');
            $w_id = $worker->id;
        }

        $orders = DB::table('orders as or')
        ->leftJoin('order_details as od', 'or.id', '=', 'od.order_id')
        ->select('or.*')
        ->where('od.worker_id', $w_id)
        ->whereBetween('or.date', [$from_date, $to_date])
        ->groupBy('od.order_id')
        ->get();

        return view('admin.worker.worker_wise_order_list', compact('worker','orders','input'));
    }

    public function create()
    {
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("workerEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.worker.create");
    }

    public function getActiveWorker(Request $request)
    {
        $workers = Worker::with('thana', 'manager', 'category')->latest();

        if (Auth::guard('admin')->user()->role == 'manager') {
            $workers = $workers->where('manager_id', Auth::guard('admin')->user()->id);
        } 

        if(isset($request->status) && $request->status != '') {
            $workers = $workers->where('status',  $request->status);
        }

        $workers = $workers->get();

        return response()->json(["workers" => $workers]);
    }

    public function workerAssignOrder()
    {
        if (Auth::guard('admin')->user()->role == 'manager') {
            $workers = Worker::with('thana', 'manager', 'category')->where('status', 'p')->where('payment_receive', 0)->where('manager_id', Auth::guard('admin')->user()->id)->latest()->get();
        } else {
            $workers = Worker::with('thana', 'manager', 'category')->where('status', 'p')->where('payment_receive', 0)->latest()->get();
        }
        return response()->json(["workers" => $workers]);
    }

    public function index()
    {
        if (Auth::guard('admin')->user()->role == 'manager') {
            $workers = Worker::with('thana', 'manager', 'category')->where('manager_id', Auth::guard('admin')->user()->id)->latest()->get();
            // $workers = Worker::with('thana', 'manager', 'category')->where('thana_id', Auth::guard('admin')->user()->thana_id)->latest()->get();
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
            'mobile' => 'required|numeric|min:11|regex:/^01[13-9][\d]{8}$/|unique:workers',
            'nid' => 'required',
            'father_name'     => 'required|string|min:3|max:30',
            'mother_name'     => 'required|string|min:3|max:30',
            'permanent_address'    => 'required|string|min:5|max:255',
            'present_address'    => 'required|string|min:5|max:255',
            'nid_front_img'    => 'required',
            'nid_back_img'    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()->first()
            ]);
        }

        try {
            $input = $request->all();

            if ($request->category_id && $request->category_id != null) {
                $input['category_id'] = json_encode($request->category_id);
            }

            // if($request->password != null)
            // {
                $input['password'] = Hash::make($request->mobile);
            // }else{
            //     unset($input['password']);
            // }

            if ($request->hasFile('image')) {
                $input['image']    = $this->imageUpload($request, 'image', 'uploads/worker');
            }

            if($request->file('nid_front_img')){
                $input['nid_front_img'] = $this->imageUpload($request, 'nid_front_img', 'uploads/worker/nid');
            }else{
                unset($input['nid_front_img']);
            }

            if($request->file('nid_back_img')){
                $input['nid_back_img'] = $this->imageUpload($request, 'nid_back_img', 'uploads/worker/nid');
            }else{
                unset($input['nid_back_img']);
            }

            Worker::create($input);

            return response()->json([
                'status'  => 'success',
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
            'mobile' => 'required|numeric|min:11|regex:/^01[13-9][\d]{8}$/|unique:workers,mobile,'.$request->id,
            'nid' => 'required',
            'father_name'     => 'required|string|min:3|max:30',
            'mother_name'     => 'required|string|min:3|max:30',
            'permanent_address'    => 'required|string|min:5|max:255',
            'present_address'    => 'required|string|min:5|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'msg' => $validator->errors()->first()
            ]);
        }

        try {
            $data = Worker::findOrFail($request->id);

            $input = $request->all();

            // if($request->password != null)
            // {
                $input['password'] = Hash::make($request->mobile);
            // }else{
            //     unset($input['password']);
            // }

            if ($request->hasFile('image')) {
                if (File::exists($data->image)) {
                    File::delete($data->image);
                }
                $input['image']    = $this->imageUpload($request, 'image', 'uploads/workers');
            }

            if($request->file('nid_front_img')){
                $input['nid_front_img'] = $this->imageUpload($request, 'nid_front_img', 'uploads/worker/nid');

                 // remove old image
                try {
                    $image_path = public_path($data->nid_front_img);
                    if(file_exists($image_path)){
                       unlink($image_path);
                   }
                } catch (\Throwable $th) {  }
            }else{
                unset($input['nid_front_img']);
            }

            if($request->file('nid_back_img')){
                $input['nid_back_img'] = $this->imageUpload($request, 'nid_back_img', 'uploads/worker/nid');

                // remove old image
                try {
                    $image_path = public_path($data->nid_back_img);
                    if(file_exists($image_path)){
                    unlink($image_path);
                }
                } catch (\Throwable $th) {  }

            }else{
                unset($input['nid_back_img']);
            }

            $data->update($input);

            return response()->json([
                'status'  => 'success',
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

    // worker status-change
    public function workerStatus(Request $request)
    {
        try {
            $worker = Worker::findOrFail($request->id);
            if ($worker->status == 'p') {
                $status = 'd'; //disable
            }else {
                $status = 'p'; // approve/active
            }

            $worker->update(['status' => $status]);
            return response()->json([
                'status'  => true,
                'msg' => 'Worker Status Updated Successfully'
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
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("assignWorkerService", $access)) {
                return view("admin.unauthorize");
            }
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
