<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Worker;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\PaymentCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    public function index()
    {
        if (Auth::guard('worker')->check()) {
            $data['paymentCollections'] = PaymentCollection::with('receiveBy')->where('worker_id', Auth::guard('worker')->user()->id)->get();
            $data['orders'] = OrderDetail::with('service', 'order')->where('worker_id', Auth::guard('worker')->user()->id)->latest()->get();
            return view("dashboard.worker-dashboard", $data);
        } else {
            return redirect()->back()->with('error', 'You do not have any access to enter there!');
        }
    }

    public function viewWorkerOrder($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return view("dashboard.worker-orderDetails", compact('orderDetail'));
    }

    public function update(Request $request)
    {
        try {
            $technician = Auth::guard('worker')->user();

            $validator = Validator::make($request->all(), [
                "name"             => "required",
                "mobile"           => "required",
                "district_id"      => "required",
                "thana_id"         => "required",
                "present_address"  => "required",
            ]);
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()->first()]);
            }

            $input = $request->all();

            Worker::find($technician->id)->update($input);

            return "Worker Profile Updated";
        } catch (\Throwable $e) {
            return "Opps! Something went wrong" . $e->getMessage();
        }
    }

    public function imageUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "image" => "mimes:jpg,png,jpeg,PNG,JPEG"
            ]);
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            $data = Worker::find(Auth::guard('worker')->user()->id);
            if ($request->hasFile('image')) {
                $old = $data->image;
                if (File::exists($old)) {
                    File::delete($old);
                }
                $data->image = $this->imageUpload($request, "image", "uploads/workers");
            }
            $data->save();
            return "Image upload successfully";
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function logout()
    {
        if (Auth::guard("worker")->check()) {
            Auth::guard("worker")->logout();
            return redirect("/");
        }
    }

    public function filterWorker(Request $request)
    {
        try {
            $data = Worker::with('thana')->where('status', 'p')->where("thana_id", $request->thana_id)->get();
            return $data;
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function statusUpdate(Request $request)
    {
        try {
            $data = OrderDetail::where('id', $request->id)->first();
            $orderId = $data->order_id;

            $data->bill_amount       = $request->billAmount;
            $data->paid_amount       = $request->status == 'complete' ? $request->billAmount - ($data->discount + $data->due) : 0;
            $data->commission_amount = $request->status == 'complete' ? $request->commissionAmount : 0;
            $data->status            = $request->status;

            $data->update();

            $msg = "";
            if ($request->status == 'bill') {
                $msg = 'Service billing successfully';
            }
            if ($request->status == 'complete') {
                $msg = 'Service complete successfully';
            }
            $orderdetail = OrderDetail::where('order_id', $orderId)->get();
            $ordercomplete = OrderDetail::where('order_id', $orderId)->where('status', 'complete')->get();
            if (count($orderdetail) == count($ordercomplete)) {
                $order           = Order::where('id', $orderId)->first();
                $order->subtotal = array_sum(array_column($ordercomplete->toArray(), 'bill_amount'));
                $order->discount = array_sum(array_column($ordercomplete->toArray(), 'discount'));
                $order->total    = $order->subtotal - $order->discount;
                $order->due      = array_sum(array_column($ordercomplete->toArray(), 'due'));
                $order->paid     = $order->total - $order->due;
                $order->status   = 'complete';
                $order->update();
            }
            return response()->json(['status' => true, 'msg' => $msg]);
        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}
