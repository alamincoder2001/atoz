@extends("layouts.fronted_master")
@section("title", " - Blog Page")
@section("content")
<nav class="breadcrumb-section section-py bg-light2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">Blog Page</h3>
            </div>
        </div>
    </div>
</nav>

<section class="section-py bg-light">
    <div class="container">
        <div class="row mb-n7 blog-5-column">
            @if($blog->count() > 0)
            @foreach($blog as $item)
            <!-- single-blog Start -->
            <div class="col-xl-3 col-lg-4 col-sm-6 col-md-6 mb-7">
                <div class="blog-card">
                    <div class="thumb">
                        <a href="#">
                            <img src="{{asset($item->image != null ? $item->image : 'noImage.jpg')}}" alt="img" />
                        </a>
                    </div>
                    <div class="blog-content">
                        <h3 class="title">
                            <a href="blog-details.html">{{$item->title}}</a>
                        </h3>
                        <a href="#"><span class="blog-meta">{{date("M d, Y", strtotime($item->date))}}</span></a>
                    </div>
                </div>
            </div>
            <!-- single-blog End -->
            @endforeach
            @else
                <div class="text-center">
                    Not found Data
                </div>
            @endif
        </div>
    </div>
    <!-- pagination start -->
    <div class="section-py">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{$blog->links('vendor.pagination.bootstrap-4')}}
            </ul>
        </nav>
    </div>
</section>
@endsection