<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view("cart");
    }

    public function addCart(Request $request)
    {
        try {
            $service = Service::find($request->id);
            foreach (Cart::content() as $key => $item) {
                if ($item->id == $request->id) {
                    return response()->json(["status" => false, "msg" => "Already added on cart", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
                }
            }
            Cart::add([
                'id'      => $request->id,
                'name'    => $service->name,
                'qty'     => $request->quantity,
                'price'   => 0,
                'weight'  => 0,
                'options' => ['image' => $service->image]
            ]);

            return response()->json(["status" => true, "msg" => "Service Added to Cart", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function updateCart(Request $request)
    {
        try {
            Cart::update($request->rowId, $request->quantity);
            return response()->json(["msg" => "Service quantity update successfully", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function removeCart(Request $request)
    {
        try {
            Cart::remove($request->rowId);
            return response()->json(["msg" => "Cart service remove successfully", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }
}
