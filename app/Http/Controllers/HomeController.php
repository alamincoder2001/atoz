<?php

namespace App\Http\Controllers;

use App\Thana;
use App\Models\Blog;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Service;
use App\Models\Technician;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $newarrival_product = DB::select("SELECT s.*, c.name as category_name FROM services s LEFT JOIN categories c ON c.id = s.category_id where s.is_arrival = 1");
        $feature_product    = DB::select("SELECT s.*, c.name as category_name FROM services s LEFT JOIN categories c ON c.id = s.category_id where s.is_feature = 1");
        $popular_product    = DB::select("SELECT s.*, c.name as category_name FROM services s LEFT JOIN categories c ON c.id = s.category_id where s.is_popular = 1");
        $topsold_product    = DB::select("SELECT s.*, c.name as category_name FROM services s LEFT JOIN categories c ON c.id = s.category_id where s.is_topsold = 1");
        $banner             = DB::select("SELECT b.* FROM banners b ORDER BY b.id DESC");
        $blog               = Blog::all();
        $slider             = Slider::latest()->get();
        $categories         = Category::with('product')->orderBy("name", "ASC")->get();
        $technician         = Technician::where('status', '!=' ,'p')->orderBy('id', "DESC")->get();
        $isWebsiteCategoryProduct = Category::with('subcategory')->where('is_website', 'true')->get();
        return view('website', compact("isWebsiteCategoryProduct", "technician", "categories", "blog", "newarrival_product", "feature_product", "popular_product", "topsold_product", "banner", "slider"));
    }

    // Product
    public function ProductShow()
    {
        if (isset($_GET['sortBy']) && $_GET['sortBy'] == "ascending") {
            $product = Service::orderBy('name', 'ASC')->paginate(25);
        } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "descending") {
            $product = Service::orderBy('name', 'DESC')->paginate(25);
        } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "low-high") {
            $product = Service::orderBy('selling_rate', 'ASC')->paginate(25);
        } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "high-low") {
            $product = Service::orderBy('selling_rate', 'DESC')->paginate(25);
        } else {
            $product = Service::paginate(25);
        }

        $categories = Category::with('product')->get();
        return view("product", compact('product', 'categories'));
    }

    // single product
    public function singleProductShow($slug = null)
    {
        $product = Service::where("slug", $slug)->first();
        return view("single-product", compact('product'));
    }

    public function blog()
    {
        $blog = Blog::orderBy('id', "DESC")->paginate(24);
        return view('blog', compact("blog"));
    }

    public function technician()
    {
        $technician = Technician::where('status', '!=' ,'p')->orderBy('id', "DESC")->paginate(24);
        return view('technician', compact("technician"));
    }

    public function technicianDetails($id)
    {
        $technician = Technician::with('district', 'upazila')->find($id);
        return view('technician-details', compact("technician"));
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
}
