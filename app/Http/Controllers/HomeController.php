<?php

namespace App\Http\Controllers;

use App\Division;
use App\Models\Area;
use App\Thana;
use App\Models\Blog;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Category;
use App\Models\HowToOrder;
use App\Models\Review;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data['services']                 = Service::with('category')->latest()->get();
        $data['services_trending']        = Service::with('category')->get();
        $data['banner']                   = DB::select("SELECT b.* FROM banners b ORDER BY b.id DESC");
        $data['blog']                     = Blog::all();
        $data['reviews']                  = Review::latest()->get();
        $data['slider']                   = Slider::latest()->get();
        $data['categories']               = Category::with('service')->orderBy("name", "ASC")->get();
        $data['worker']                   = Worker::with('thana')->orderBy('id', "DESC")->get();
        $data['isWebsiteCategoryProduct'] = Category::with('service')->where('is_website', 'true')->get();
        return view('websites.home', $data);
    }

    public function checkoutPage()
    {
        try {
            $items = Cart::content();
                if (Auth::guard('web')->user()) {
                    return view('websites.checkoutPage',compact('items'));
                }else {
                    return redirect()->back()->with('error', 'Please Login/Register First');
                }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    // get division wise district
    public function getDistrict(Request $request)
    {
        $division = Division::findOrFail($request->id);
        $district = $division->districts;
        return response()->json(['district' => $district]);
    }

    // Product
    public function ServiceShow()
    {
        // if (isset($_GET['sortBy']) && $_GET['sortBy'] == "ascending") {
        //     $service = Service::orderBy('name', 'ASC')->paginate(25);
        // } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "descending") {
        //     $service = Service::orderBy('name', 'DESC')->paginate(25);
        // } else {
        //     $service = Service::paginate(25);
        // }

        $categories = Category::with('service')->where('status', 'a')->get();
        // $service  = Service::with('category')->get();
        return view("websites.services", compact('categories'));
    }

    // single service
    public function singleServiceShow($slug = null)
    {
        $service = Service::where("slug", $slug)->first();
        return view("websites.service_single",compact('service'));
    }

    // single service
    public function categoryWiseServiceShow($slug = null)
    {
        try {
            $category = Category::where("slug", $slug)->first();
            $categories = Category::where('status', 'a')->latest()->get();
            // dd($category->service);
            return view("websites.category_wise_service",compact('category', 'categories'));
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function blog()
    {
        $blog = Blog::orderBy('id', "DESC")->paginate(24);
        return view('blog', compact("blog"));
    }

    public function worker()
    {
        $worker = Worker::with('thana')->where('status', 'p')->orderBy('id', "DESC")->paginate(24);
        // return view('worker', compact("worker"));
        return view('websites.worker',compact("worker"));
    }

    public function workerDetails($id)
    {
        $worker = Worker::with('thana')->find($id);
        return response()->json(['worker' => $worker]);
        // return view('worker-details', compact("worker"));
    }

    public function contact()
    {
        // return view('contact');
        return view('websites.contact');
    }

    public function getUpazila(Request $request)
    {
        $thanas = Thana::where("district_id", $request->id)->orderBy("name", "ASC")->get();
        return response()->json($thanas);
    }
    public function getArea(Request $request)
    {
        $areas = Area::where("upazila_id", $request->id)->orderBy("name", "ASC")->get();
        return response()->json($areas);
    }

    public function fetch()
    {
        return Setting::first();
    }

    // searchService
    public function searchService(Request $request)
    {
        try {
            $data = Service::where('name', 'LIKE',  "%{$request->serviceName}%")
                            ->orWhere('slug', 'LIKE', "%{$request->serviceName}%")
                            ->orWhere('service_code', 'LIKE', "%{$request->serviceName}%")->get();

            // $data = DB::select("SELECT s.* FROM services s WHERE s.name LIKE '%$request->serviceName%'");
            return response()->json($data);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function customerRegister()
    {
        return view('websites.customer_register');
    }
}
