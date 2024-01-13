<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\AdminAccess;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (Auth::guard('admin')->user()->role != 'SuperAdmin') {
            $access = AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
                ->pluck('permissions')
                ->toArray();
            if (!in_array("categoryEntry", $access)) {
                return view("admin.unauthorize");
            }
        }
        return view("admin.category.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Category::find($id);
        } else {
            $data = Category::get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:categories,name," . $request->id,
                    "image" => "dimensions:width=150,height=150'"
                ], ["image.dimensions" => "Image dimension must be 150 X 150"]);

                $data = Category::find($request->id);
                $old = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required|unique:categories",
                    "image" => "dimensions:width=150,height=150'"
                ], ["image.dimensions" => "Image dimension must be 150 X 150"]);
                $data = new Category();
                $data->created_at = Carbon::now();
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data->name = $request->name;
            $data->is_website = $request->isWebsite == 'yes' ? 'true' : 'false';
            $data->slug = Str::slug($request->name);
            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/categories') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return "Category updated successfully";
            } else {
                return "Category insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Category::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return "Category Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
