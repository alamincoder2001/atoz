<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
            ->pluck('permissions')
            ->toArray();
        if (!in_array("settingUpdate", $access)) {
            return view("admin.unauthorize");
        }
        $data = Setting::first();
        return view("admin.setting", compact("data"));
    }

    public function updateSetting(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "company_name" => "required",
                "mobile"       => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data                   = Setting::first();
            $data->company_name     = $request->company_name;
            $data->ownername        = $request->ownername;
            $data->ownerdesignation = $request->ownerdesignation;
            $data->mobile           = $request->mobile;
            $data->email            = $request->email;
            $data->address          = $request->address;
            $data->mobile_second    = $request->mobile_second;
            $data->email_second     = $request->email_second;
            $data->address_second   = $request->address_second;
            $data->facebook         = $request->facebook;
            $data->instagram        = $request->instagram;
            $data->twitter          = $request->twitter;
            $data->linkedin         = $request->linkedin;
            $data->youtube          = $request->youtube;

            $data->save();
            return "Setting updated successfully";
        } catch (\Throwable $e) {
            return "Something went wrong".$e->getMessage();
        }
    }

    public function logoUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "logo" => "mimes:jpg,png,jpeg|dimensions:width=150,height=55"
            ], ["logo.dimensions" => "Image dimension must be (150px x 55px)"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            $data        = Setting::first();
            $old_logo    = $data->logo;

            if (!empty($old_logo) && isset($old_logo)) {
                if (File::exists($old_logo)) {
                    File::delete($old_logo);
                }
            }
            $data->logo    = $this->imageUpload($request, 'logo', 'uploads/logo') ?? '';

            $data->save();
            return "Logo Image Upload successfully";
        } catch (\Throwable $e) {
            return "Something went wrong ";
        }
    }
    public function naviconUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "navicon" => "mimes:jpg,png,jpeg|dimensions:width=80,height=80"
            ], ["navicon.dimensions" => "Image dimension must be (80px x 80px)"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            $data        = Setting::first();
            $old_navicon    = $data->navicon;

            if (!empty($old_navicon) && isset($old_navicon)) {
                if (File::exists($old_navicon)) {
                    File::delete($old_navicon);
                }
            }

            $data->navicon    = $this->imageUpload($request, 'navicon', 'uploads/navicon') ?? '';

            $data->save();
            return "Navicon Image Upload successfully";
        } catch (\Throwable $e) {
            return "Something went wrong ";
        }
    }
    public function ownerimageUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "ownerimage" => "mimes:jpg,png,jpeg|dimensions:width=200,height=200"
            ], ["ownerimage.dimensions" => "Image dimension must be (200px x 200px)"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            $data        = Setting::first();
            $old_ownerimage    = $data->ownerimage;

            if (!empty($old_ownerimage) && isset($old_ownerimage)) {
                if (File::exists($old_ownerimage)) {
                    File::delete($old_ownerimage);
                }
            }

            $data->ownerimage    = $this->imageUpload($request, 'ownerimage', 'uploads/ownerimage') ?? '';

            $data->save();
            return "Navicon Image Upload successfully";
        } catch (\Throwable $e) {
            return "Something went wrong ";
        }
    }
}
