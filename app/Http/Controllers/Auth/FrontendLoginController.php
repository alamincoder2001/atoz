<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontendLoginController extends Controller
{

    public function showSignInForm()
    {
        return view("auth.frontend.signin");
    }

    public function showSignUpForm()
    {
        return view("auth.frontend.signup");
    }

    //credentials checkb
    public function credentials($username, $password)
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $username, 'password' => $password];
        } elseif (is_numeric($username) == 1) {
            return ['mobile' => $username, 'password' => $password];
        } else {
            return ['username' => $username, 'password' => $password];
        }
    }

    public function CustomerLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "mobile" => "required",
                "password" => "required"
            ], ["mobile.required" => "Mobile number is required"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            // login successfull
            if (Auth::guard('web')->attempt($this->credentials($request->mobile, $request->password))) {
                return response()->json(["success" => "Successfully Login", "content" => Cart::content()->count()]);
            } else {
                return response()->json(["errors" => "Password or Email Not Match"]);
            }
        } catch (\Throwable $e) {
            return "Opps! something went wrong" . $e->getMessage();
        }
    }

    public function CustomerRegister(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name"             => "required",
                "mobile"           => "required",
                "district_id"      => "required",
                "thana_id"         => "required",
                "area_id"          => "required",
                "password"         => "required",
                "confirm_password" => "required_with:password|same:password",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data                = new User();
            $data->customer_code = $this->generateCode("User", "C");
            $data->name          = $request->name;
            $data->mobile        = $request->mobile;
            $data->district_id   = $request->district_id;
            $data->thana_id      = $request->thana_id;
            $data->area_id      = $request->area_id;
            $data->password      = Hash::make($request->password);
            $data->save();

            if (Auth::guard('web')->attempt($this->credentials($request->username, $request->password))) {
                return response()->json(["msg" => "Successfully Register", "content" => Cart::content()->count()]);
            }
        } catch (\Throwable $e) {
            return "Opps something went wrong";
        }
    }

    public function WorkerLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "mobile" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()->first()]);
            }
            $worker = Worker::where('mobile', $request->mobile)->first();
            if (!empty($worker)) {
                if ($worker->status == 'd') {
                    return response()->json(["error" => "আপনার একাউন্টটি অচলবস্থায় আছে, অনুগ্রহ করে অফিসে যোগাযোগ করুন।"]);
                }
                // login successfull
                if (Auth::guard('worker')->attempt(['mobile' => $request->mobile, 'password' => $request->mobile])) {
                    return response()->json("Successfully Login");
                } else {
                    return response()->json(["errors" => "Mobile number not match"]);
                }
            } else {
                return response()->json(["error" => "Worker not found"]);
            }
        } catch (\Throwable $e) {
            return "Opps! something went wrong" . $e->getMessage();
        }
    }
}
