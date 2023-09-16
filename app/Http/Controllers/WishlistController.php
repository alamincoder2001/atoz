<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addWishlist(Request $request)
    {
        try {
            if (Auth::guard('web')->check()) {
                $check = Wishlist::where('ipAddress', request()->ip())->where("customer_id", Auth::guard('web')->user()->id)->where("product_id", $request->id)->first();
                if (!empty($check)) {
                    return ["msg" => "This product already exits wishlist", "status" => "warn"];
                } else {
                    Wishlist::create([
                        "customer_id" => Auth::guard('web')->user()->id,
                        "product_id"  => $request->id,
                        "ipAddress"   => request()->ip()
                    ]);
                    return ["msg" => "Product added to wishlist successfully", "status" => "success"];
                }
            } else {
                return response()->json(["login" => "Login First"]);
            }
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function deleteWishlist(Request $request)
    {
        try{
            $data = Wishlist::where("product_id", $request->product_id)->where("customer_id", Auth::guard("web")->user()->id)->first();
            $data->delete();
            $content = Wishlist::where('ipAddress', request()->ip())->where("customer_id", Auth::guard("web")->user()->id)->get();
            return response()->json(["msg" => "Product delete from wishlist", "content" => count($content)]);
        }catch(\Throwable $e){
            return "Opps! something went wrong";
        }
    }
}
