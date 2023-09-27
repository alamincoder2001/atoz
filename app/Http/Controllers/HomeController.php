<?php

namespace App\Http\Controllers;

use App\Thana;
use App\Models\Blog;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data['services']                 = Service::with('category')->latest()->get();
        $data['banner']                   = DB::select("SELECT b.* FROM banners b ORDER BY b.id DESC");
        $data['blog']                     = Blog::all();
        $data['slider']                   = Slider::latest()->get();
        $data['categories']               = Category::with('service')->orderBy("name", "ASC")->get();
        $data['worker']                   = Worker::with('thana')->orderBy('id', "DESC")->get();
        $data['isWebsiteCategoryProduct'] = Category::with('subcategory')->where('is_website', 'true')->get();
        return view('website', $data);
    }

    // Product
    public function ServiceShow()
    {
        if (isset($_GET['sortBy']) && $_GET['sortBy'] == "ascending") {
            $service = Service::orderBy('name', 'ASC')->paginate(25);
        } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "descending") {
            $service = Service::orderBy('name', 'DESC')->paginate(25);
        } else {
            $service = Service::paginate(25);
        }

        $categories = Category::with('service')->get();
        return view("service", compact('service', 'categories'));
    }

    // single service
    public function singleServiceShow($slug = null)
    {
        $service = Service::where("slug", $slug)->first();
        return view("single-service", compact('service'));
    }

    public function blog()
    {
        $blog = Blog::orderBy('id', "DESC")->paginate(24);
        return view('blog', compact("blog"));
    }

    public function worker()
    {
        $worker = Worker::with('thana')->orderBy('id', "DESC")->paginate(24);
        return view('worker', compact("worker"));
    }

    public function workerDetails($id)
    {
        $worker = Worker::with('thana')->find($id);
        return view('worker-details', compact("worker"));
    }

    public function contact()
    {
        return view('contact');
    }


    public function getUpazila($id)
    {
        return Thana::where("district_id", $id)->orderBy("name", "ASC")->get();
    }

    public function fetch()
    {
        return Setting::first();
    }


    // searchService
    public function searchService(Request $request)
    {
        try {
            $data = DB::select("SELECT s.* FROM services s WHERE s.name LIKE '%$request->serviceName%'");
            return response()->json($data);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
