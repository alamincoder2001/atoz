<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view("cart");
    }

    public function addCart(Request $request)
    {
        try {
            $product = Product::find($request->id);
            Cart::add([
                'id'      => $request->id,
                'name'    => $product->name,
                'qty'     => $request->quantity,
                'price'   => Auth::guard("web")->check() && Auth::guard("web")->user()->customer_type != 'Retail' ? $product->wholesale_rate : $product->selling_rate,
                'weight'  => 0,
                'options' => ['image' => $product->image]
            ]);

            return response()->json(["msg" => "Successfully Product Added to Cart", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
        } catch (\Throwable $e) {
            return "Opps! something went wrong ";
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
