<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TechnicianController extends Controller
{
    public function index()
    {
        if (Auth::guard('technician')->check()) {
            return view("dashboard.technician-dashboard");
        } else {
            return redirect("/login");
        }
    }

    public function update(Request $request)
    {
        try {
            $technician = Auth::guard('technician')->user();
            if (!empty($request->old_password) || !empty($request->new_password) || !empty($request->confrim_password)) {
                $validator = Validator::make($request->all(), [
                    "name"             => "required",
                    "username"         => "required|unique:technicians,username," . $technician->id,
                    "email"            => "required|unique:technicians,email," . $technician->id,
                    "mobile"           => "required",
                    "gender"           => "required",
                    "district_id"      => "required",
                    "thana_id"         => "required",
                    "address"          => "required",
                    "old_password"     => "required",
                    "new_password"     => "required",
                    'confirm_password' => 'required_with:new_password|same:new_password'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "name"        => "required",
                    "username"    => "required|unique:technicians,username," . $technician->id,
                    "email"       => "required|unique:technicians,email," . $technician->id,
                    "mobile"      => "required",
                    "gender"      => "required",
                    "district_id" => "required",
                    "thana_id"    => "required",
                    "address"     => "required",
                ]);
            }
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data = Technician::find($technician->id);
            if (!empty($request->old_password) || !empty($request->new_password) || !empty($request->confrim_password)) {
                if (Hash::check($request->old_password, $technician->password)) {
                    $data->password = Hash::make($request->new_password);
                } else {
                    return response()->json(["errors" => "Old password does not match"]);
                }
            }
            $data->name        = $request->name;
            $data->username    = $request->username;
            $data->email       = $request->email;
            $data->mobile      = $request->mobile;
            $data->gender      = $request->gender;
            $data->district_id = $request->district_id;
            $data->thana_id    = $request->thana_id;
            $data->address     = $request->address;
            $data->save();
            return "Technician Profile Updated";
        } catch (\Throwable $e) {
            return "Opps! Something went wrong";
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
            $data = Technician::find(Auth::guard('technician')->user()->id);
            if ($request->hasFile('image')) {
                $old = $data->image;
                if (File::exists($old)) {
                    File::delete($old);
                }
                $data->image = $this->imageUpload($request, "image", "uploads/technicians");
            }
            $data->save();
            return "Image upload successfully";
        } catch (\Throwable $e) {
            return "Opps! something went wrong";
        }
    }

    public function logout()
    {
        if (Auth::guard("technician")->check()) {
            Auth::guard("technician")->logout();
            return redirect("/");
        }
    }

    public function filterTechnician(Request $request)
    {
        try{
            $data = Technician::with('district', 'upazila')->where("thana_id", $request->thana_id)->where('status', '!=' ,'p')->get();
            return $data;
        }catch(\Throwable $e){
            return "Opps! something went wrong";
        }
    }
}
