<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        } else {
            return ['username' => $username, 'password' => $password];
        }
    }

    public function CustomerLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "username" => "required",
                "password" => "required"
            ], ["username.required" => "Username or Email required"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            // login successfull
            if (Auth::guard('web')->attempt($this->credentials($request->username, $request->password))) {
                return response()->json("Successfully Login");
            } else {
                return response()->json(["errors" => "Password or Email Not Match"]);
            }
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function CustomerRegister(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name"             => "required",
                "username"         => "required",
                "email"            => "required",
                "mobile"           => "required",
                "district_id"      => "required",
                "thana_id"         => "required",
                "password"         => "required",
                "confirm_password" => "required_with:password|same:password",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data                = new User();
            $data->customer_code = $this->generateCode("User", "C");
            $data->name          = $request->name;
            $data->username      = $request->username;
            $data->email         = $request->email;
            $data->mobile        = $request->mobile;
            $data->district_id   = $request->district_id;
            $data->thana_id      = $request->thana_id;
            $data->password      = Hash::make($request->password);
            $data->save();

            if (Auth::guard('web')->attempt($this->credentials($request->username, $request->password))) {
                return response()->json(["msg" => "Successfully Register"]);
            }
        } catch (\Throwable $e) {
            return "Opps something went wrong";
        }
    }

    // public function TechnicianRegister(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             "name"             => "required",
    //             "username"         => "required",
    //             "email"            => "required",
    //             "mobile"           => "required",
    //             "district_id"      => "required",
    //             "thana_id"         => "required",
    //             "password"         => "required",
    //             "confirm_password" => "required_with:password|same:password",
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json(["error" => $validator->errors()]);
    //         }

    //         $data                  = new Technician();
    //         $data->technician_code = $this->generateCode("Technician", "T");
    //         $data->name            = $request->name;
    //         $data->username        = $request->username;
    //         $data->email           = $request->email;
    //         $data->mobile          = $request->mobile;
    //         $data->district_id     = $request->district_id;
    //         $data->thana_id        = $request->thana_id;
    //         $data->password        = Hash::make($request->password);
    //         $data->save();
    //         return response()->json(["msg" => "Successfully Register"]);
    //     } catch (\Throwable $e) {
    //         return "Opps something went wrong";
    //     }
    // }

    public function WorkerLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "mobile" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            // login successfull
            if (Auth::guard('worker')->attempt(['mobile' => $request->mobile, 'password' => $request->mobile])) {
                return response()->json("Successfully Login");
            } else {
                return response()->json(["errors" => "Mobile number not match"]);
            }
        } catch (\Throwable $e) {
            return "Opps! something went wrong" . $e->getMessage();
        }
    }
}
