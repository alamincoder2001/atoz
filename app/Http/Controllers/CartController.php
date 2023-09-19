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
            $product = Service::find($request->id);
            foreach (Cart::content() as $key => $item) {
                if ($item->id == $request->id) {
                    return response()->json(["status" => false, "msg" => "Already added on cart", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
                }
            }
            Cart::add([
                'id'      => $request->id,
                'name'    => $product->name,
                'qty'     => $request->quantity,
                'price'   => 0,
                'weight'  => 0,
                'options' => ['image' => $product->image]
            ]);

            return response()->json(["status" => true, "msg" => "Product Added to Cart", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function updateCart(Request $request)
    {
        try {
            Cart::update($request->rowId, $request->quantity);
            return response()->json(["msg" => "Product quantity update successfully", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function removeCart(Request $request)
    {
        try {
            Cart::remove($request->rowId);
            return response()->json(["msg" => "Cart product remove successfully", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }
}
