<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::guard("web")->check()) {
            if (Cart::content()->count() > 0) {
                return view("checkout");
            } else {
                return redirect("/product");
            }
        } else {
            return redirect("/login");
        }
    }

    public function CheckOut(Request $request)
    {
        try {
            // return $request->all();
            if (isset($request->is_shipping)) {
                $shipping_charge = Thana::where('id', Auth::guard('web')->user()->thana_id)->first()->charge;
            } else {
                $shipping_charge = Thana::where('id', $request->shipping_thana)->first()->charge;
            }
            DB::beginTransaction();
            if (Cart::content()->count() > 0) {
                if (!isset($request->is_shipping) && $request->is_shipping == 1) {
                    $validator = Validator::make($request->all(), [
                        "shipping_district" => "required",
                        "shipping_thana" => "required",
                        "shipping_address" => "required",
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        "address" => "required",
                    ]);
                }

                if ($validator->fails()) {
                    return response()->json(["error" => $validator->errors()->first()]);
                }

                $data                    = new Order();
                $data->invoice           = $this->invoiceGenerate("Order", "AZ");
                $data->date              = date("Y-m-d");
                $data->customer_id       = Auth::guard('web')->user()->id;
                $data->is_shipping       = !isset($request->is_shipping) ? 1 : 0;
                $data->shipping_thana    = !isset($request->is_shipping) ? $request->shipping_thana : Auth::guard('web')->user()->thana_id;
                $data->shipping_area    = !isset($request->is_shipping) ? $request->shipping_area : Auth::guard('web')->user()->area_id;
                $data->shipping_mobile   = Auth::guard('web')->user()->mobile;
                $data->shipping_address  = !isset($request->is_shipping) ? $request->shipping_address : $request->address;
                $data->shipping_postcode = $request->postcode;
                $data->subtotal          = str_replace(",", "", Cart::subtotal());
                $data->shipping_charge   = $shipping_charge;
                $data->total             = $data->subtotal + $data->shipping_charge;
                $data->due               = 0;
                $data->payment_type      = $request->payment_type;
                $data->note              = $request->note;
                $data->save();

                // order Details
                foreach (Cart::content() as $item) {
                    $detail              = new OrderDetail();
                    $detail->order_id    = $data->id;
                    $detail->service_id  = $item->id;
                    $detail->quantity    = $item->qty;
                    $detail->bill_amount = 0;
                    $detail->paid_amount = 0;
                    $detail->due         = 0;
                    $detail->save();
                }
                Cart::destroy();
                DB::commit();
                return response()->json(["msg" => "Order place successfully"]);
            } else {
                return response()->json(["errors" => "Cart is empty"]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return "Opps! something went wrong " . $e->getMessage();
        }
    }
}
