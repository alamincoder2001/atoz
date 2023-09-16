<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.partner.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Partner::find($id);
        } else {
            $data = Partner::get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "url" => "required",
                "image" => "mimes:jpg,png,jpeg|dimensions:width=180,height=75"
            ], ["image.dimensions" => "Image dimension must be (180 x 75)"]);
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            if (!empty($request->id)) {
                $data = Partner::find($request->id);
                $old = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $data = new Partner();
                $data->created_at = Carbon::now();
            }

            $data->title = $request->title;
            $data->url = $request->url;
            
            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/partners') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return "Partner updated successfully";
            } else {
                return "Partner insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Partner::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return "Partner Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}