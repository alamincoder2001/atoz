<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\AdminAccess;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
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
        if (!in_array("newsandeventEntry", $access)) {
            return view("admin.unauthorize");
        }
        return view("admin.blog.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Blog::find($id);
        } else {
            $data = Blog::get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "title" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            if (!empty($request->id)) {
                $data = Blog::find($request->id);
                $old = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $data = new Blog();
                $data->created_at = Carbon::now();
            }

            $data->title       = $request->title;
            $data->date        = $request->date;
            $data->slug        = Str::slug($request->title);
            $data->description = $request->description;
            $data->added_by    = Auth::guard("admin")->user()->id;
            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/blogs') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return "Blog updated successfully";
            } else {
                return "Blog insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Blog::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return "Blog Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
