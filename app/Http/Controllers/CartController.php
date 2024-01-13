<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view("cart");
    }

    public function getCartItems()
    {
        return response()->json([
            "content" => Cart::content(),
            "subtotal" => Cart::subtotal(),
            "cartCount" => Cart::content()->count()
        ]);
    }

    public function addCart(Request $request)
    {
        try {
            $service = Service::find($request->id);

            foreach (Cart::content() as $item) {
                if ($item->id == $request->id) {
                    return response()->json(["status" => false, "msg" => "Already added on cart", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
                }
            }
            Cart::add([
                'id'      => $service->id,
                'name'    => $service->name,
                'qty'     => 1,
                'price'   => 0,
                'weight'  => 0,
                'options' => ['image' => $service->image]
            ]);

            return response()->json(["status" => true, "msg" => "Service Added Into Cart", "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
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

    // for modal cart
    public function cartModalData(Request $request)
    {
        try {
            $service = Service::find($request->id);
            $category = Category::findOrFail($service->category_id);
            $services = $category->service;

            // check service already exist or not
            foreach (Cart::content() as $item) {
                if ($item->id == $request->id) {
                    return response()->json(["status" => false, "warning" => "This item already added on cart", 'services' => $services, "content" => Cart::content(), "subtotal" => Cart::subtotal(), "cartCount" => Cart::content()->count()]);
                }
            }
            // add to cart
            Cart::add([
                'id'      => $service->id,
                'name'    => $service->name,
                'qty'     => 1,
                'price'   => 0,
                'weight'  => 0,
                'options' => ['image' => $service->image]
            ]);

            return response()->json(['services' => $services,"content" => Cart::content()]);
        } catch (\Throwable $th) {
            return response()->json('error', 'Opps! something went wrong');
        }

    }
}
