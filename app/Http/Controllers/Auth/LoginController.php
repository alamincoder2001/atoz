<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:technician')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showSignUpForm()
    {
        return view("auth.frontend.login");
    }

    public function showAdminLoginForm()
    {
        return view("auth.backend.login");
    }

    public function AdminLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "username" => "required",
                "password" => "required"
            ], ["username.required" => "Username or Email required"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            if (Auth::guard('admin')->attempt($this->credentials($request->username, $request->password))) {
                return response()->json("Successfully Login");
            } else {
                return response()->json(["errors" => "Password or Email Not Match"]);
            }
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    //credentials check
    public function credentials($username, $password)
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $username, 'password' => $password];
        } else {
            return ['username' => $username, 'password' => $password];
        }
    }
}
