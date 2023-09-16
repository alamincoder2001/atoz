@extends("layouts.fronted_master")
@section("title", " - Technician Details")
@section("content")
<nav class="breadcrumb-section section-py bg-light2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="bread-crumb-title">Technician Details</h3>
            </div>
        </div>
    </div>
</nav>
<section class="bg-light" style="padding-bottom: 25px;">
    <div class="container">
        <div class="main-body">
            <hr style="margin:0px 0px 10px 0;">
            <div class="row gutters-sm">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{asset($technician->image != null ? $technician->image: 'nouser.png')}}" alt="{{$technician->name}}" class="rounded-circle" style="width: 150px;height:130px;">
                                <div class="mt-3">
                                    <h4>{{$technician->name}}</h4>
                                    <p class="text-secondary mb-1">{{$technician->technician_code}}</p>
                                    <p class="font-size-sm">{{$technician->upazila->name}}, {{$technician->district->name}}</p>
                                    <!-- <button class="btn btn-primary">Follow</button>
                                    <button class="btn btn-outline-primary">Message</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$technician->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$technician->email}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$technician->mobile}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$technician->address}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Rating</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <fieldset class="rating">
                                        <input onchange="Rating(event, {{$technician->id}})" id="demo-1" type="radio" name="demo" value="1">
                                        <label for="demo-1">1 star</label>
                                        <input onchange="Rating(event, {{$technician->id}})" id="demo-2" type="radio" name="demo" value="2">
                                        <label for="demo-2">2 stars</label>
                                        <input onchange="Rating(event, {{$technician->id}})" id="demo-3" type="radio" name="demo" value="3">
                                        <label for="demo-3">3 stars</label>
                                        <input onchange="Rating(event, {{$technician->id}})" id="demo-4" type="radio" name="demo" value="4">
                                        <label for="demo-4">4 stars</label>
                                        <input onchange="Rating(event, {{$technician->id}})" id="demo-5" type="radio" name="demo" value="5">
                                        <label for="demo-5">5 stars</label>

                                        @php
                                        $avg = ($technician->admin_rating+$technician->customer_rating)/2;
                                        $average = (int)$avg;
                                        @endphp

                                        @if($technician->admin_rating != 0 && $technician->customer_rating != 0)
                                        <div class="stars">
                                            <label for="demo-1" aria-label="1 star" title="1 star" style="color:{{$average == 1 || $average == 2 || $average == 3 || $average == 4 || $average == 5 ? 'orange':''}}"></label>
                                            <label for="demo-2" aria-label="2 stars" title="2 stars" style="color:{{$average == 2 || $average == 3 || $average == 4 || $average == 5 ? 'orange':''}}"></label>
                                            <label for="demo-3" aria-label="3 stars" title="3 stars" style="color:{{$average == 3 || $average == 4 || $average == 5 ? 'orange':''}}"></label>
                                            <label for="demo-4" aria-label="4 stars" title="4 stars" style="color:{{$average == 4 || $average == 5 ? 'orange':''}}"></label>
                                            <label for="demo-5" aria-label="5 stars" title="5 stars" style="color:{{$average == 5 ? 'orange':''}}"></label>
                                        </div>
                                        @elseif($technician->admin_rating != 0)
                                        <div class="stars">
                                            <label for="demo-1" aria-label="1 star" title="1 star" style="color:{{$technician->admin_rating == 1 || $technician->admin_rating == 2 || $technician->admin_rating == 3 || $technician->admin_rating == 4 || $technician->admin_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-2" aria-label="2 stars" title="2 stars" style="color:{{$technician->admin_rating == 2 || $technician->admin_rating == 3 || $technician->admin_rating == 4 || $technician->admin_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-3" aria-label="3 stars" title="3 stars" style="color:{{$technician->admin_rating == 3 || $technician->admin_rating == 4 || $technician->admin_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-4" aria-label="4 stars" title="4 stars" style="color:{{$technician->admin_rating == 4 || $technician->admin_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-5" aria-label="5 stars" title="5 stars" style="color:{{$technician->admin_rating == 5 ? 'orange':''}}"></label>
                                        </div>
                                        @elseif($technician->customer_rating != 0)
                                        <div class="stars">
                                            <label for="demo-1" aria-label="1 star" title="1 star" style="color:{{$technician->customer_rating == 1 || $technician->customer_rating == 2 || $technician->customer_rating == 3 || $technician->customer_rating == 4 || $technician->customer_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-2" aria-label="2 stars" title="2 stars" style="color:{{$technician->customer_rating == 2 || $technician->customer_rating == 3 || $technician->customer_rating == 4 || $technician->customer_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-3" aria-label="3 stars" title="3 stars" style="color:{{$technician->customer_rating == 3 || $technician->customer_rating == 4 || $technician->customer_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-4" aria-label="4 stars" title="4 stars" style="color:{{$technician->customer_rating == 4 || $technician->customer_rating == 5 ? 'orange':''}}"></label>
                                            <label for="demo-5" aria-label="5 stars" title="5 stars" style="color:{{$technician->customer_rating == 5 ? 'orange':''}}"></label>
                                        </div>
                                        @else
                                        <div class="stars">
                                            <label for="demo-1" aria-label="1 star" title="1 star"></label>
                                            <label for="demo-2" aria-label="2 stars" title="2 stars"></label>
                                            <label for="demo-3" aria-label="3 stars" title="3 stars"></label>
                                            <label for="demo-4" aria-label="4 stars" title="4 stars"></label>
                                            <label for="demo-5" aria-label="5 stars" title="5 stars"></label>
                                        </div>
                                        @endif

                                    </fieldset>
                                </div>
                            </div>
                            <!-- <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-info shadow-none">Update</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("webjs")
<script>
    function Rating(event, id) {
        $.ajax({
            url: location.origin + "/customer-rating",
            method: 'POST',
            data: {
                id: id,
                rating: event.target.value
            },
            success: res => {
                if (res.error) {
                    $.notify(res.error, "error")
                    setTimeout(() => {
                        location.href = "/login"
                    }, 500)
                } else {
                    $.notify(res, "success")
                    setTimeout(() => {
                        location.reload()
                    }, 500)
                }
            }
        })
    }
</script>
@endpush